<?php
App::uses('AppController', 'Controller');
/**
 * Assocdcprojets Controller
 *
 * @property Assocdcprojet1 $Assocdcprojet1
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class AssocdcprojetsController extends AppController {

    /**
     * variables globales utilisées dans ce controller
     */
    public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
//	public function index() {
//		$this->Assocdcprojet->recursive = 0;
//		$this->set('assocdcprojets', $this->Paginator->paginate());
//	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function view($id = null) {
//		if (!$this->Assocdcprojet->exists($id)) {
//			throw new NotFoundException(__('Invalid assocdcprojet'));
//		}
//		$options = array('conditions' => array('Assocdcprojet.' . $this->Assocdcprojet->primaryKey => $id));
//		$this->set('assocdcprojet', $this->Assocdcprojet->find('first', $options));
//	}

/**
 * add method
 *
 * @return void
 */
//	public function add() {
//		if ($this->request->is('post')) {
//			$this->Assocdcprojet->create();
//			if ($this->Assocdcprojet->save($this->request->data)) {
//				$this->Session->setFlash(__('The assocdcprojet has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The assocdcprojet could not be saved. Please, try again.'));
//			}
//		}
//		$centrecouts = $this->Assocdcprojet->Centrecout->find('list');
//		$projets = $this->Assocdcprojet->Projet->find('list');
//		$this->set(compact('centrecouts', 'projets'));
//	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function edit($id = null) {
//		if (!$this->Assocdcprojet->exists($id)) {
//			throw new NotFoundException(__('Invalid assocdcprojet'));
//		}
//		if ($this->request->is(array('post', 'put'))) {
//			if ($this->Assocdcprojet->save($this->request->data)) {
//				$this->Session->setFlash(__('The assocdcprojet has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The assocdcprojet could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('Assocdcprojet.' . $this->Assocdcprojet->primaryKey => $id));
//			$this->request->data = $this->Assocdcprojet->find('first', $options);
//		}
//		$centrecouts = $this->Assocdcprojet->Centrecout->find('list');
//		$projets = $this->Assocdcprojet->Projet->find('list');
//		$this->set(compact('centrecouts', 'projets'));
//	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function delete($id = null) {
//		$this->Assocdcprojet->id = $id;
//		if (!$this->Assocdcprojet->exists()) {
//			throw new NotFoundException(__('Invalid assocdcprojet'));
//		}
//		$this->request->onlyAllow('post', 'delete');
//		if ($this->Assocdcprojet->delete()) {
//			$this->Session->setFlash(__('The assocdcprojet has been deleted.'));
//		} else {
//			$this->Session->setFlash(__('The assocdcprojet could not be deleted. Please, try again.'));
//		}
//		return $this->redirect(array('action' => 'index'));
//	}

    /**
     * Autorise l'utilisation de méthode sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_info','json_get_assoid'));
        parent::beforeFilter();
    }   

    /**
     * donne les informations du centre de coût
     * 
     * @param int $cdc_id du centre de coût
     * @return json
     */
    public function json_get_info($cdc_id=null){
        $this->autoRender = false;
        $obj = $this->Assocdcprojet->find('first', array('fields'=>array('Assocdcprojet.id','Assocdcprojet.projet_id'),'conditions' => array('Assocdcprojet.centrecout_id' => $cdc_id),'recursive'=>0));
        $result[] = isset($obj['Assocdcprojet']['projet_id']) ? $obj['Assocdcprojet']['projet_id'] : 'null';
        return json_encode($result);
        //exit();
    }

    /**
     * donne l'identifiant de l'asosciation pour le centre de coût
     * 
     * @param int $cdc_id centre de coût
     * @return json
     */
    public function json_get_assoid($cdc_id=null){
        $this->autoRender = false;
        $obj = $this->Assocdcprojet->find('first', array('fields'=>array('Assocdcprojet.id','Assocdcprojet.projet_id'),'conditions' => array('Assocdcprojet.centrecout_id' => $cdc_id),'recursive'=>0));
        $result[] = isset($obj['Assocdcprojet']['id']) ? $obj['Assocdcprojet']['id'] : 'null';
        return json_encode($result);
        //exit();
    }        

    /**
     * mise à jour dynamique de l'association (création ou modification) (Ajax)
     */
    public function ajaxupdate(){
        $this->autoRender = false;
        $msg  = $this->Session->setFlash(__('Liste des projets associés au centre de coût incorrecte, veuillez corriger la liste',true),'flash_failure');
        if($this->request->data('assoid')!=''):
            $this->Assocdcprojet->id = $this->request->data('assoid');
            if ($this->Assocdcprojet->saveField('projet_id',$this->request->data('projet_id'))) :
                    $msg = $this->Session->setFlash(__('Liste des projets associés au centre de coût sauvegardée',true),'flash_success');
            endif;          
        else:
            $this->Assocdcprojet->create();
            $record['Assocdcprojet']['projet_id'] = $this->request->data('projet_id');
            $record['Assocdcprojet']['centrecout_id'] = $this->request->data('cdc');
            $record['Assocdcprojet']['created'] = date('Y-m-d');
            $record['Assocdcprojet']['modified'] = date('Y-m-d');
            if ($this->Assocdcprojet->save($record)) :
                    $msg = $this->Session->setFlash(__('Liste des projets associés au centre de coût sauvegardée',true),'flash_success');
            endif;                    
        endif;
        $msg;
    }    

}
