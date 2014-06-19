<?php
App::uses('AppController', 'Controller');
App::uses('Vendor', 'ping', array('file'=>'class.ping.php'));
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Typemateriels');
App::import('Controller', 'Sections');
App::import('Controller', 'Assistances');
App::import('Controller', 'Dotations');
/**
 * Materielinformatiques Controller
 *
 * @property Materielinformatique $Materielinformatique
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class MaterielinformatiquesController extends AppController {
    /**
     * variables gloabels utilisées au niveau du controller
     */
    public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Materielinformatique.NOM' => 'asc'),
        );
                
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Postes informatiques" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }          
    
    /**
     * permet en autre d'autoriser l'utilisation de méthodes sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_list_all','json_list_stock'));
        parent::beforeFilter();
    }  

    /**
     * calcul le périmètre de visibilité
     * 
     * @return null
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return$ObjAssoentiteutilisateurs->find_all_section(userAuth('id'));
        endif;
    }

    /**
     * filtre le matériel en fonction de l'état
     * 
     * @param string $id
     * @return string
     */
    public function get_materiel_etat_filter($id){
        $result = array();
        $id = $id==null ? 'En stock': $id;
        switch($id):
            case 'tous':  
                $result['condition']="1=1";
                $result['filter'] = "de tous les états";
                break;
            default :
                $result['condition']="Materielinformatique.ETAT='".$id."'";
                $result['filter'] = "étant '".$id."'"; 
                break;
        endswitch;
        return $result;
    }    

    /**
     * filtre le matériel en fonction du type
     * 
     * @param string $id
     * @return string
     */
    public function get_materiel_type_filter($id){
        $result = array();
        switch($id):
                case 'tous':
                case null:    
                    $result['condition']="1=1";
                    $result['filter'] = "tous les types de matériel";
                    break;
                default :
                    $result['condition']="Typemateriel.NOM='".$id."'";
                    $result['filter'] = "type de matériel '".$id."'";  
                break;
        endswitch;
        return $result;
    }       

    /**
     * filtre le matériel par section 
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_materiel_section_filter($id,$visibility){
        $result = array();
        switch($id):
            case 'toutes':
            case null:    
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    if (userAuth('WIDEAREA')==0) :
                        $result['condition']='Section.id ='.userAuth('section_id');
                    else:
                        $result['condition']='Section.id IN ('.$visibility.')';
                    endif;
                else:
                    $result['condition']='Section.id ='.userAuth('section_id');
                endif;                     
                $result['filter'] = "toutes les sections";
                break;
            default :
                $result['condition']="Section.id='".$id."'";
                $nomsection = $this->Materielinformatique->Section->find('first',array('conditions'=>array('Section.id'=>$id),'recursive'=>-1));
                $result['filter'] = "la section ".$nomsection['Section']['NOM'];   
                break;
        endswitch;
        return $result;
    }      

    /**
     * met en variable de session les données de l'export
     * 
     * @param array $conditions
     */
    public function get_export($conditions){
        $this->Session->delete('xls_export');
        $export = $this->Materielinformatique->find('all',array('conditions'=>$conditions,'order' => array('Materielinformatique.NOM' => 'asc'),'recursive'=>0));
        $this->Session->write('xls_export',$export);   
    }

    /**
     * renvois la liste des utilisateur
     * 
     * @param string $visibility
     * @return array
     */
    public function get_list_utiliseoutil_utilisateur($visibility){
        if($visibility == null):
            $conditions =array('1=1');
        elseif ($visibility!=''):
            $conditions = array('Utilisateur.id > 1','Utilisateur.profil_id > 0','Utilisateur.section_id IN ('.$visibility.')');
        else:
            $conditions =array('Utilisateur.id > 1','Utilisateur.profil_id > 0','Utilisateur.section_id ='.userAuth('section_id'));
        endif;                      
        $utilisateurs = $this->Materielinformatique->Dotation->Utilisateur->find('list',array('fields' => array('id','NOMLONG'),'conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc'),'group'=>'Utilisateur.id','recursive'=>-1));
        return $utilisateurs;
    }   

    /**
     * renvois la liste du matériel en stock
     * 
     * @return array
     */
    public function get_list_stock(){
        $conditions = array('Materielinformatique.ETAT ='=>'En stock');
        return $this->Materielinformatique->find('list',array('fields'=>array('id','NOM'),'conditions'=>$conditions,'order'=>array('Materielinformatique.NOM'=>'asc'),'recursive'=>-1));
    }

    /**
     * renvois la liste du matériel en stock
     * 
     * @return json
     */
    public function json_list_stock(){
        $this->autoRender = false;
        $conditions = array('Materielinformatique.ETAT ='=>'En stock');
        $result = $this->Materielinformatique->find('list',array('fields'=>array('NOM','id'),'conditions'=>$conditions,'order'=>array('Materielinformatique.NOM'=>'asc'),'recursive'=>-1));
        return json_encode($result);
    }  

    /**
     * renvois la liste de tout le matériel
     * 
     * @return json
     */
    public function json_list_all(){
        $this->autoRender = false;
        $conditions = array("1=1");
        $result = $this->Materielinformatique->find('list',array('fields'=>array('NOM','id'),'conditions'=>$conditions,'order'=>array('Materielinformatique.NOM'=>'asc'),'recursive'=>-1));
        return json_encode($result);
    }         

    /**
     * liste le matériel
     * 
     * @param string $filtreetat
     * @param string $filtretype
     * @param string $filtresection
     * @throws UnauthorizedException
     */
    public function index($filtreetat=null,$filtretype=null,$filtresection=null) {
        $this->set_title();
        if (isAuthorized('materielinformatiques', 'index')) :
            $visibility = $this->get_visibility();
            $getetat = $this->get_materiel_etat_filter($filtreetat);
            $gettype = $this->get_materiel_type_filter($filtretype);
            $getsection = $this->get_materiel_section_filter($filtresection, $visibility);
            $this->set('fetat',$getetat['filter']); 
            $this->set('ftype',$gettype['filter']); 
            $this->set('fsection',$getsection['filter']);                 
            $newconditions = array($getetat['condition'],$gettype['condition'],$getsection['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                
            $this->set('materielinformatiques', $this->paginate());
            $this->get_export($newconditions);
            $etats = Configure::read('etatMaterielInformatique');
            $ObjTypemateriels = new TypematerielsController();
            $ObjSections = new SectionsController();
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            $types = $ObjTypemateriels->get_all_uc();
            $sections = $ObjSections->get_all($visibility);
            $utilisateurs= $ObjAssoentiteutilisateurs->get_list_utilisateur(userAuth('id'));
            $this->set(compact('etats','types','sections','utilisateurs')); 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * ajoute un nouveau matériel
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('materielinformatiques', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Materielinformatique->validate = array();
                    $this->History->goBack(1);
                else:                     
                    $this->Materielinformatique->create();
                    if ($this->Materielinformatique->save($this->request->data)) {
                            $this->Session->setFlash(__('Postes informatique sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Postes informatique incorrect, veuillez corriger le poste informatique',true),'flash_failure');
                    }
                endif;
            endif;
            $visibility = $this->get_visibility();
            $ObjTypemateriels = new TypematerielsController();
            $ObjSections = new SectionsController();
            $ObjAssistances = new AssistancesController();  
            $peripherique =$ObjTypemateriels->get_list_uc();
            $section = $ObjSections->get_list($visibility);
            $etat = Configure::read('etatMaterielInformatique');
            $assistance = $ObjAssistances->get_list();
            $this->set(compact('peripherique','section','etat','assistance'));                 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * met à jour le matériel
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('materielinformatiques', 'edit')) :
            if (!$this->Materielinformatique->exists($id)) {
                    throw new NotFoundException(__('Postes informatique incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Materielinformatique->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Materielinformatique->save($this->request->data)) {
                        if ($this->request->data['Materielinformatique']['ETAT']=='En stock'):
                            $dotations = $this->Materielinformatique->Dotation->find('all',array('conditions'=>array('Dotation.materielinformatiques_id'=>$id),'recursive'=>0));
                            foreach($dotations as $dotation):
                                $ObjDotations = new DotationsController();	
                                $ObjDotations->reception($dotation['Dotation']['id'],$dotation['Dotation']['utilisateur_id']);
                            endforeach;    
                        endif;
                            $this->Session->setFlash(__('Postes informatique sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Postes informatique incorrect, veuillez corriger le poste informatique',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Materielinformatique.' . $this->Materielinformatique->primaryKey => $id),'recursive'=>0);
                $this->request->data = $this->Materielinformatique->find('first', $options);
                $this->set('materielinformatique',$this->request->data);
                $visibility = $this->get_visibility();
                $ObjTypemateriels = new TypematerielsController();
                $ObjSections = new SectionsController();	
                $ObjAssistances = new AssistancesController();  	
                $peripherique = $ObjTypemateriels->get_list_uc();
                $section = $ObjSections->get_list($visibility);
                $etat = Configure::read('etatMaterielInformatique');
                $assistance = $ObjAssistances->get_list();
                $this->set(compact('peripherique','section','etat','assistance'));                         
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * supprime le matériel
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('materielinformatiques', 'delete')) :
            $this->Materielinformatique->id = $id;
            if (!$this->Materielinformatique->exists()) {
                    throw new NotFoundException(__('Postes informatique incorrect'));
            }
            if ($this->Materielinformatique->delete()) {
                    $this->Session->setFlash(__('Postes informatique supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Postes informatique <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * recherche de matériel
     * 
     * @param string $filtreetat
     * @param string $filtretype
     * @param string $filtresection
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($filtreetat=null,$filtretype=null,$filtresection=null,$keywords=null) {
        $this->set_title();
        if (isAuthorized('materielinformatiques', 'index')) :
            if(isset($this->params->data['Materielinformatique']['SEARCH'])):
                $keywords = $this->params->data['Materielinformatique']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                $visibility = $this->get_visibility();
                $getetat = $this->get_materiel_etat_filter($filtreetat);
                $gettype = $this->get_materiel_type_filter($filtretype);
                $getsection = $this->get_materiel_section_filter($filtresection, $visibility);
                $this->set('fetat',$getetat['filter']); 
                $this->set('ftype',$gettype['filter']); 
                $this->set('fsection',$getsection['filter']);                 
                $newconditions = array($getetat['condition'],$gettype['condition'],$getsection['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Materielinformatique.NOM LIKE '%".$value."%'","Materielinformatique.ETAT LIKE '%".$value."%'","Materielinformatique.COMMENTAIRE LIKE '%".$value."%'","Assistance.NOM LIKE '%".$value."%'","Section.NOM LIKE '%".$value."%'","Typemateriel.NOM LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('materielinformatiques', $this->paginate());
                $this->get_export($newconditions);
                $etats = Configure::read('etatMaterielInformatique');
                $ObjTypemateriels = new TypematerielsController();	
                $ObjSections = new SectionsController();	
                $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
                $types = $ObjTypemateriels->get_all_uc();
                $sections = $ObjSections->get_all($visibility);
                $utilisateurs= $ObjAssoentiteutilisateurs->get_list_utilisateur(userAuth('id'));
                $this->set(compact('etats','types','sections','utilisateurs'));                    
            else:
                $this->redirect(array('action'=>'index',$filtreetat,$filtretype,$filtresection));
            endif;   
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }   

    /**
     * export des données au format Excel
     */
    function export_xls() {
            $data = $this->Session->read('xls_export');
            $this->Session->delete('xls_export');
            $this->set('rows',$data);
            $this->render('export_xls','export_xls');
    }  

    /**
     * duplique un matériel
     * 
     * @param string $id
     * @throws UnauthorizedException
     */
    public function dupliquer($id = null) {
        if (isAuthorized('materielinformatiques', 'duplicate')) :
            $this->Materielinformatique->id = $id;
            $record = $this->Materielinformatique->read();
            unset($record['Materielinformatique']['id']);
            $record['Materielinformatique']['NOM']='_nouveau nom_';
            $record['Materielinformatique']['ETAT']='En stock';
            unset($record['Materielinformatique']['created']);                
            unset($record['Materielinformatique']['modified']);
            $record['Materielinformatique']['created'] = date('Y-m-d');
            $record['Materielinformatique']['modified'] = date('Y-m-d');
            $this->Materielinformatique->create();
            if ($this->Materielinformatique->save($record)) {
                    $this->Session->setFlash(__('Poste informatique dupliqué',true),'flash_success');
                    $this->History->goBack(1);
            } 
            $this->Session->setFlash(__('Poste informatique <b>NON</b> dupliqué',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }     

    /**
     * ping un poste informatique
     * 
     * @param string $host
     * @return type
     */
    public function pinghost($host) {
        $this->autoRender = false;
        $ip = gethostbyname($host);
        if($ip != NULL):
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') :
                exec("ping -n 2 " . $ip, $output, $result);
            else:
                exec("ping -c 2 " . $ip, $output, $result);
            endif;
            if ($result == 0):
              $retour = true;
            else :
              $retour = false;
            endif; 
        else:
            $retour = false;  
            $result = false;
        endif;
        $poste['IP']=$ip;
        $poste['RETOUR']=$retour;
        $poste['HOST']=$host;
        $poste['LATENCE']=$result;
        $result = json_encode($poste);
        return $result;
    }

    /**
     * affecte un matériel à un utilisateur
     */
    public function assignto(){
        $this->autoRender = false;
        $old = $this->Materielinformatique->Dotation->find('first',array('conditions'=>array('Dotation.materielinformatiques_id'=>$this->request->data['Materielinformatique']['id'])));
        $delete = true;
        $ObjDotations = new DotationsController();
        if($old['Dotation']['id']):	
            $delete = $ObjDotations->ajaxdelete($old['Dotation']['id']);
        endif;
        if($this->request->data['Materielinformatique']['utilisateur_id']!=''):
            if($ObjDotations->ajaxadd($this->request->data)):
                $this->Materielinformatique->id = $this->request->data['Materielinformatique']['id'];
                $this->Materielinformatique->saveField('ETAT', 'En dotation');
                $this->Session->setFlash(__('Poste informatique affecté à l\'utilisateur',true),'flash_success');
            else:
                $this->Session->setFlash(__('Poste informatique <b>NON</b> affecté à l\'utilisateur',true),'flash_failure');
            endif;
        else:
            $this->Materielinformatique->id = $this->request->data['Materielinformatique']['id'];
            if($this->Materielinformatique->saveField('ETAT', 'En stock') && $delete):
                $this->Session->setFlash(__('Poste informatique de nouveau disponible',true),'flash_success');
            else:
                $this->Session->setFlash(__('Poste informatique <b>NON</b> retiré à l\'utilisateur',true),'flash_failure');
            endif;                
        endif;
        $this->History->goBack(1);
    }
}
