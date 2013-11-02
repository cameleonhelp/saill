<?php  
/** 
 * Maximum size of the array containing the user navigation history 
 */ 
define('STUDIOSIPAK_MAX_HISTORY', 10); 
/* 
 * HistoryComponent: User navigation history 
 * @author: Jacques LEVAVASSEUR
 * @license: MIT 
 * @version: 0.2 
 * */ 
class HistoryComponent extends Component { 
    /**
     * Initialisation des variables
     * @var type 
     */
    var $goback = false;
    var $data = array(); 
    var $started = false; 
    var $controller = true; 
    /**
     * actions qui ne sont pas prises en compte pour l'ajout
     * Ajouter toutes les méthode dont on fait $this->History->goBack()
     * @var type 
     */
    var $exception = array('delete','openmaintenance','closemaintenance','ajax_install','saveColor','pinghost','budgetisactif','ajaxedit','ajax_actif','json_get_logiciel_info','json_get_version_info','json_get_version_for','ajaxdelete','ajaxadd','notifier','addnewpc','sendmailgestannuaire','newactivite','dupliquer','search','export_doc','export_xls','incra','parseICS','progressduree','progressavancement','progressstatut','progressstate','autoduplicate','errorfacturation','deverouiller','soumettre','deleteall','autoprogressState','addIndisponibilite');

    /**
     * action initialisant l'historique
     * @var type 
     */
    var $initpage = array('index','display','last7days','risques','home','profil', 'rapport','absences','login','listebackup');

    function initialize(Controller $controller){
    }
    
    /**
     * Permet de débugguer l'historique
     */
    function beforeRender(Controller $controller){
        //debug($this->show());   
        //debug($this->goback);
        //debug($this->lastURL());
        //debug($this->controller->params['action']);
    }
    
    function shutdown(Controller $controller){ 
       
    }
    
    /**
     * Au chargement de la vue, enregistre ou non l'url dans l'historique
     * @param type $controller
     */
    public function startup(Controller $controller) { 
        // This test will prevent it from running twice. 
        if(!$this->started) { 
            $this->started = true; 
            $this->controller = $controller; 
            $this->data = SessionComponent::read('User.history'); 
            $this->goback = SessionComponent::check('User.goback') ? SessionComponent::read('User.goback') : false; 
            if($controller->params['bare'] == 0) {    
                /**
                 * Si l'action est dans les pages d'origine on vide l'historique
                 */
                if(in_array($controller->params['action'],$this->initpage)):
                    $this->_destroy(); 
                endif;
                $lastpos = $this->lastIndex();
                /**
                 * Ajout de l'url dans l'history
                 */
                if ($lastpos != 0  && $this->goback!=false):
                    /**
                     * En cas de retour arrière si l'url existe dans l'history on nettoie l'history
                     */
                    $this->urlexists();                
                    $lasthistory = isset($this->data[$lastpos]) ? $this->data[$lastpos] : '';
                    if($lasthistory!=FULL_BASE_URL.$controller->params->here && !$this->isexception()):
                        $this->_addUrl(FULL_BASE_URL.$controller->params->here); 
                    endif;
                else:
                    $this->_addUrl(FULL_BASE_URL.$controller->params->here); 
                    SessionComponent::write('User.goback', false);
                endif;   
            } 
            SessionComponent::write('User.history', $this->data); 
        } 
    } 

    /**
     * Retour arrière
     * @param type $step
     */
    public function goBack($step = 0) {  
        //$this->urlexists($step+1); 
        //$this->params['form']['cancel']=null;
        $pos = $this->lastIndex() - $step < 0 ? 0 : $this->lastIndex() - $step;  
        $sessiongobak = $step = 0 ? '' : true;
        SessionComponent::write('User.goback', $sessiongobak);
        $this->controller->redirect($this->data[$pos]); 
        exit();      
    } 

    /**
     * Retour arrière
     * @param type $step
     */
    public function goPrevious() { 
        $pos = $this->lastIndex();  
        SessionComponent::write('User.goback', true);
        $this->controller->redirect($this->data[$pos]);
        exit(); 
    }   
    
    public function notmove(){
        SessionComponent::write('User.goback', '');
        $this->_deleteUrl($this->lastIndex()); 
        $this->controller->redirect($this->lastURL());
        exit();         
    }
    
    /**
     * Montre la liste de l'historique
     * @return type
     */
    function show() { 
        return SessionComponent::read('User.history');
    } 

    /**
     * Dernier index
     * @return type
     */
    function lastIndex() { 
        $count = SessionComponent::read('User.history');
        $count = count($count)-1 > 0 ? count($count)-1 : 0;
        return $count;
    } 
    
    /**
     * Ajout de l'url sans dépasser la limite max
     * @param type $params
     */
    function _addUrl($params) { 
        $url = $params; 
        if(count($this->data) == STUDIOSIPAK_MAX_HISTORY) { 
            $this->_deleteUrl(); 
        } 
        if($url != $this->lastURL()):
            $this->data[] = $url; 
        endif;
    } 

    function lastURL(){
        $count = count($this->data)-1 > 0 ? count($this->data)-1 : 0;  
        $url = isset($this->data[$count]) ? $this->data[$count] : '';
        return $url;
    }
    
    /**
     * suppression de l'item 
     * @param type $position
     */
    function _deleteUrl($position = 0) { 
        if($position == 0) { 
            array_shift($this->data); 
        } 
        else { 
            array_splice($this->data, $position, 1); 
        } 
    } 
    
    /**
     * vidage de l'historique
     */
    function _destroy(){
        $this->data = array();
        SessionComponent::write('User.history', $this->data); 
    }

    
    function exceptioninlasturl(){
        if($this->lastIndex()>0):
        $lasturl = $this->lastURL();
        foreach($this->exception as $exception):
            if(strpos($lasturl, $exception)!==false):
                $this->_deleteUrl($this->lastIndex());
            endif;
        endforeach;
        endif;
    }
    
    function isexception(){
        $return = false;
        foreach($this->exception as $exception):
            if(in_array($this->controller->params['action'],$this->exception)):
                $return = true;
                break;
            endif;
        endforeach;        
        return $return;
    }
    
    function urlexists(){
        // recherche l'url courante dans l'historique
        if(!$this->isexception()):
            $isback = SessionComponent::check('User.goback') ? SessionComponent::read('User.goback') : false;
            $count = $isback ? 1 : null;
            $pos = !$isback ? array_search(FULL_BASE_URL.$this->controller->params->here,$this->data) : null;
            if(($pos || $count) && $isback):
                // recherche le nombre de lignes à supprimer pour atteindre l'url courante
                $count = $count == null ?(count($this->data)-$pos)+1 : $count;
                for ($i=0; $i<$count; $i++):
                    // la première ligne doit toujours rester pour retrouner à la liste
                    if (count($this->data) > 1):
                        array_pop($this->data);
                    endif;
                endfor; 
                if($isback):
                    SessionComponent::write('User.goback', false);
                endif;
            endif;
        else:
            $this->_deleteUrl($this->lastIndex());
            SessionComponent::write('User.goback', '');
        endif;
    }
} 
?>