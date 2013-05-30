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
    var $data = array(); 
    var $started = false; 
    var $controller = true; 
    /**
     * actions qui ne sont pas prises en compte pour l'ajout
     * Ajouter toutes les méthode dont on fait $this->History->goBack()
     * @var type 
     */
    var $exception = array('delete','dupliquer','search','export_doc','export_xls','incra','parseICS','progressduree','progressavancement','progressstatut','progressstate','autoduplicate','errorfacturation','deverouiller','soumettre','deleteall','autoprogressState','addIndisponibilite');

    /**
     * action initialisant l'historique
     * @var type 
     */
    var $initpage = array('index','display','home','profil', 'rapport','absences','login','listebackup');

    function initialize(){
    }
    
    /**
     * Permet de débugguer l'historique
     */
    function beforeRender(){
        //debug($this->show());   
        //debug($this->lastIndex());
        //debug($this->controller->params['action']);
    }
    
    function shutdown(){ 
       
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
            if($controller->params['bare'] == 0) {    
                /**
                 * Si l'action est dans les pages d'origine on vide l'historique
                 */
                if(in_array($controller->params['action'],$this->initpage)):
                    $this->_destroy(); 
                endif;
                $lastpos = $this->lastIndex();
                $lasthistory = isset($this->data[$lastpos]) ? $this->data[$lastpos] : '';
                /**
                 * Ajout de l'url dans l'history
                 */
                if ($lastpos != 0):
                    /**
                     * si l'action n'est pas une exception et que la dernière valeur est différente de l'url active
                     */
                    if(!in_array($controller->params['action'],$this->exception) && $lasthistory!=FULL_BASE_URL.$controller->params->here):
                        $this->_addUrl(FULL_BASE_URL.$controller->params->here); 
                    endif;
                else:
                    $this->_addUrl(FULL_BASE_URL.$controller->params->here); 
                endif;
                /**
                 * En cas de retour arrière compare le dernier et l'antépenultième élément du tableau
                 * Si égaux alors suppression des deux dernières valeurs
                 */
                if($this->lastIndex()>1 && !in_array($controller->params['action'],$this->exception)):
                    if ($this->data[$this->lastIndex()]==$this->data[$this->lastIndex()-2]):
                        array_pop($this->data);
                        array_pop($this->data);
                    endif;
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
        $pos = $this->lastIndex() - ($step + 1) < 0 ? 0 : $this->lastIndex() - ($step + 1);  
        $this->controller->redirect($this->data[$pos]); 
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
        return count($count)-1;
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
        $this->data[] = $url; 
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

} 
?>