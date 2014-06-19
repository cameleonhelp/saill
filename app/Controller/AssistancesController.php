<?php
App::uses('AppController', 'Controller');
/**
 * Assistances Controller
 *
 * @property Assistance $Assistance
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class AssistancesController extends AppController {
    
    /**
     * Déclaration des variables 
     */
    public $components = array('History','Common');
    public $paginate = array(
    'limit' => 25,
    'order' => array('Assistance.NOM' => 'asc'),
    );

    /**
     * liste des assistances
     * 
     * @throws UnauthorizedException
     * @return array
     */
    public function index() {
        //$this->Session->delete('history');
        if (isAuthorized('assistances', 'index')) :
            $this->Assistance->recursive = 0;
            $this->set('assistances', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * 
     * 
     * @param type $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
//    public function view($id = null) {
//        if (isAuthorized('assistances', 'view')) :
//            if (!$this->Assistance->exists($id)) {
//                    throw new NotFoundException(__('Assistance incorrecte'));
//            }
//            $options = array('conditions' => array('Assistance.' . $this->Assistance->primaryKey => $id));
//            $this->set('assistance', $this->Assistance->find('first', $options));
//        else :
//            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
//            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
//        endif;                  
//    }

    /**
     * ajout d'une assisatnce
     * 
     * @throws UnauthorizedException
     * @return void
     */
    public function add() {
        if (isAuthorized('assistances', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Assistance->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->Assistance->create();
                    if ($this->Assistance->save($this->request->data)) {
                            $this->Session->setFlash(__('Assistance sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Assistance incorrecte, veuillez corriger l\'assistance',true),'flash_failure');
                    }
                endif;    
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * modification de l'assistance
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @return void
     */
    public function edit($id = null) {
        if (isAuthorized('assistances', 'edit')) :
            if (!$this->Assistance->exists($id)) {
                    throw new NotFoundException(__('Assistance incorrectee'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Assistance->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Assistance->save($this->request->data)) {
                            $this->Session->setFlash(__('Assistance sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Assistance incorrecte, veuillez corriger l\'assistance',true),'flash_failure');
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Assistance.' . $this->Assistance->primaryKey => $id));
                    $this->request->data = $this->Assistance->find('first', $options);
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * Suppression de l'assistance
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @return void
     */
    public function delete($id = null) {
        if (isAuthorized('assistances', 'delete')) :
            $this->Assistance->id = $id;
            if (!$this->Assistance->exists()) {
                    throw new NotFoundException(__('Assistance incorrecte'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->Assistance->delete()) {
                    $this->Session->setFlash(__('Assistance supprimée',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Assistance NON supprimée',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * recherche des assisatnces en fonction du $keywords
     * 
     * @param string $keywords
     * @throws UnauthorizedException
     * @return array
     */
    public function search($keywords=null) {
        if (isAuthorized('assistances', 'index')) :
            if(isset($this->params->data['Assistance']['SEARCH'])):
                $keywords = $this->params->data['Assistance']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Assistance.NOM LIKE '%".$value."%'","Assistance.DESCRIPTION LIKE '%".$value."%'"));
                endforeach;
                $conditions = array('OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions));
                $this->Assistance->recursive = 0;
                $this->set('assistances', $this->paginate());           
            else:
                $this->redirect(array('action'=>'index'));
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }       

    /**
     * retourne la liste des assisatnce pour les selects
     * 
     * @return array
     */
    public function get_list(){
        return $this->Assistance->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc'),'recursive'=>0));
    }

    /**
     * liste toutes les assistances
     * 
     * @return array
     */
    public function get_all(){
        return $this->Assistance->find('all',array('order'=>array('NOM'=>'asc'),'recursive'=>0));
    }        
}
