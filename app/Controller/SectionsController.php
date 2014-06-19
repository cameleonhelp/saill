<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Utilisateurs');
/**
 * Sections Controller
 *
 * @property Section $Section
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class SectionsController extends AppController {
    /**
     * Variable globales utilisées au niveau du controller
     */
    public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Section.NOM' => 'asc') );

    /**
     * liste les sections
     * 
     * @throws UnauthorizedException
     */
    public function index() {
        if (isAuthorized('sections', 'index')) :
            $this->Section->recursive = 0;
            $this->set('sections', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * ajoute une section
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('sections', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Section->validate = array();
                    $this->History->goBack(1);
                else:                     
                    $this->Section->create();
                    if ($this->Section->save($this->request->data)) {
                            $this->Session->setFlash(__('Section sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Section incorrecte, veuillez corriger la section',true),'flash_failure');
                    }
                endif;
            endif;
            $ObjUtilisateurs = new UtilisateursController();
            $responsable = $ObjUtilisateurs->get_list_hierarchique();
            $this->set(compact('responsable'));                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * test si la section fait partie de mes cercles de visibilité
     * 
     * @param string $section
     * @return boolean
     */
    public function is_in_my_entite($section){
        if(userAuth('profil_id') != 1):
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            $listsection = $ObjAssoentiteutilisateurs->find_array_section(userAuth('id'));
            return in_array($section,$listsection);
        else:
            return true;
        endif;
    }

    /**
     * met à jour la section
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('sections', 'edit')) :	
            if (!$this->Section->exists($id)) {
                    throw new NotFoundException(__('Section incorrecte'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Section->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Section->save($this->request->data)) {
                            $this->Session->setFlash(__('Section sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Section incorrecte, veuillez corriger la section',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Section.' . $this->Section->primaryKey => $id),'recursive'=>0);
                $this->request->data = $this->Section->find('first', $options);
                $ObjUtilisateurs = new UtilisateursController();
                $responsable = $ObjUtilisateurs->get_list_hierarchique();
                $this->set(compact('responsable'));                        
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * supprime la section
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('sections', 'delete')) :            
            $this->Section->id = $id;
            if (!$this->Section->exists()) {
                    throw new NotFoundException(__('Section incorrecte'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->Section->delete()) {
                    $this->Session->setFlash(__('Section supprimée',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Section <b>NON</b> supprimée',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * recherche des sections
     * 
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($keywords=null) {
        if (isAuthorized('sections', 'index')) :
            if(isset($this->params->data['Section']['SEARCH'])):
                $keywords = $this->params->data['Section']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                $newcondition = array();
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Section.NOM LIKE '%".$value."%'","Section.DESCRIPTION LIKE '%".$value."%'","(CONCAT(Utilisateur.NOM, ' ', Utilisateur.PRENOM)) LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('sections', $this->paginate());     
            else:
                $this->redirect(array('action'=>'index'));
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }      

    /**
     * renvois la liste des sections pour les selects
     * 
     * @return array
     */
    public function getList(){
        $sections = $this->Section->find('list', array('fields'=>array('id','NOM'),'order'=>array('NOM'=>'asc'),'recursive'=>-1));
        return $sections;
    }

    /**
     * renvois toutes les sections
     * 
     * @param string $visibility
     * @return array
     */
    public function get_all($visibility=null) {
        if($visibility==null):
            $conditions[] = "1=1";
        elseif ($visibility != '' && userAuth('WIDEAREA')==0):
            $conditions[] = 'Section.id = '.userAuth('section_id');
        elseif ($visibility != '' && userAuth('WIDEAREA')!=0):
            $ObjUtilisateurs = new UtilisateursController();
            $sections = $ObjUtilisateurs->get_str_section_utilisateurs();
            $conditions[] = "Section.id IN (".$sections.")";            
        else:
            $conditions[] = 'Section.id = '.userAuth('section_id');
        endif;
        return $this->Section->find('all',array('conditions'=>$conditions,'order'=>array('NOM'=>'asc'),'recursive'=>-1));
    }

    /**
     * renvois la liste des sections pour les selects
     * 
     * @param string $visibility
     * @return array
     */
    public function get_list($visibility=null) {
        if($visibility==null):
            $conditions[] = "1=1";
        elseif ($visibility != '' && $visibility != '0' && userAuth('WIDEAREA')== 0):
            $conditions[] = 'Section.id = '.userAuth('section_id');
        elseif ($visibility != '' && $visibility != '0' && userAuth('WIDEAREA')!= 0):
            $ObjUtilisateurs = new UtilisateursController();
            $sections = $ObjUtilisateurs->get_str_section_utilisateurs();
            $conditions[] = "Section.id IN (".$sections.")";            
        else:
            $conditions[] = 'Section.id = '.userAuth('section_id');
        endif;
        return $this->Section->find('list',array('fields'=>array('id','NOM'),'conditions'=>$conditions,'order'=>array('NOM'=>'asc'),'recursive'=>-1));
    }        

    /**
     * renvois le mail du valideur pour une section
     * 
     * @param string $id
     * @return string
     */
    public function get_valideur($id){
        $obj = $this->Section->find('first',array('conditions'=>array('Section.id'=>$id),'recursive'=>0));
        return $obj['Section']['MAILVALIDEUR'];
    }

    /**
     * renvois le mail du gestionnaire d'annuaire de la section
     * 
     * @param string $id
     * @return string
     */
    public function get_gestionnaire_annuaire($id){
        $obj = $this->Section->find('first',array('conditions'=>array('Section.id'=>$id),'recursive'=>0));
        return $obj['Section']['MAILGESTANNUAIRE'];
    }        
}
