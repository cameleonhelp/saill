<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Entites');
/**
 * Domaines Controller
 *
 * @property Domaine $Domaine
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class DomainesController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $components = array('History','Common');
    public $paginate = array(
    'limit' => 25,
    'order' => array('Domaine.NOM' => 'asc'),
    );

    /**
     * donne le périmètre de visibilité de l'utilisateur
     * 
     * @return string
     */
    public function get_visibilty(){
        if(userAuth('profil_id')==1):
            return "1=1";
        else:
            return array('OR'=>array('Domaine.entite_id IS NULL','Domaine.entite_id'=>userAuth('entite_id')));
        endif;
    }        

    /**
     * retourne la liste des cercles
     * 
     * @return type
     */
    public function get_cercles(){
        $ObjEntites = new EntitesController();	
        if(userAuth('profil_id')==1):
            return $ObjEntites->find_list_all_actif_cercle();
        else:
            return $ObjEntites->find_list_cercle();
        endif;
    }        

    /**
     * liste les domaines
     * 
     * @throws UnauthorizedException
     */
    public function index() {
        //$this->Session->delete('history');
        if (isAuthorized('domaines', 'index')) :
            $newconditions[]= $this->get_visibilty();
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));  
            $this->set('domaines', $this->paginate());
            $ObjEntites = new EntitesController();	
            $cercles = $ObjEntites->get_all();
            $this->set(compact('cercles'));                   
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * ajoute un domaine
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('domaines', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Domaine->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->Domaine->create();
                    if ($this->Domaine->save($this->request->data)) {
                            $this->Session->setFlash(__('Domaine sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine',true),'flash_failure');
                    }
                endif;
            endif;
            $cercles = $this->get_cercles();
            $this->set(compact('cercles'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * modifie un domaine
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('domaines', 'edit')) :
            if (!$this->Domaine->exists($id)) {
                    throw new NotFoundException(__('Domaine incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Domaine->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Domaine->save($this->request->data)) {
                            $this->Session->setFlash(__('Domaine sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine',true),'flash_failure');
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Domaine.' . $this->Domaine->primaryKey => $id));
                    $this->request->data = $this->Domaine->find('first', $options);
                    $cercles = $this->get_cercles();
                    $this->set(compact('cercles'));                        
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * supprime un domaine
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('domaines', 'delete')) :
            $this->Domaine->id = $id;
            if (!$this->Domaine->exists()) {
                    throw new NotFoundException(__('Domaine incorrect'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->Domaine->delete()) {
                    $this->Session->setFlash(__('Domaine supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Domaine NON supprimé',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }
      
    /**
     * recheche de domaines
     * 
     * @throws UnauthorizedException
     */
    public function search() {
        if (isAuthorized('domaines', 'index')) :
            if(isset($this->params->data['Domaine']['SEARCH'])):
                $keywords = $this->params->data['Domaine']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Domaine.NOM LIKE '%".$value."%'","Domaine.DESCRIPTION LIKE '%".$value."%'"));
                endforeach;
                $newconditions[]= $this->get_visibilty();                  
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                
                $this->set('domaines', $this->paginate());               
            else:
                $this->redirect(array('action'=>'index'));
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }    

    /**
     * retourne le liste des domaines pour un select
     * 
     * @return type
     */
    public function get_list(){
        return $this->Domaine->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc'),'recursive'=>0));
    }

    /**
     * retourne la lioste des domaine pour un menu par exemple
     * 
     * @return type
     */
    public function get_all(){
        return $this->Domaine->find('all',array('order'=>array('NOM'=>'asc'),'recursive'=>0));
    }           
}
