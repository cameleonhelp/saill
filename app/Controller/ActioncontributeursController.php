<?php
App::uses('AppController', 'Controller');
/**
 * Actioncontributeurs Controller
 *
 * @property Actioncontributeur $Actioncontributeur
 * @property PaginatorComponent $Paginator
 */
class ActioncontributeursController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array(
        'limit' => 25
        );

	public $components = array('History','Common');
        
        public function beforeRender() {             
            parent::beforeRender();
        }

/**
 * add method
 *
 * @return void
 */
	public function add($record) {
		if ($this->request->is('post')) {
			$this->Actioncontributeur->create();
			if ($this->Actioncontributeur->save($record)) {
				$this->Session->setFlash(__('The actioncontributeur has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The actioncontributeur could not be saved. Please, try again.'));
			}
		}
		$utilisateurs = $this->Actioncontributeur->Utilisateur->find('list');
		$actions = $this->Actioncontributeur->Action->find('list');
		$this->set(compact('utilisateurs', 'actions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Actioncontributeur->id = $id;
		if (!$this->Actioncontributeur->exists()) {
			throw new NotFoundException(__('Invalid actioncontributeur'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Actioncontributeur->delete()) {
			$this->Session->setFlash(__('The actioncontributeur has been deleted.'));
		} else {
			$this->Session->setFlash(__('The actioncontributeur could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        /**
         * getarray_contributeurs_for_action method
         * 
         * @param type $action_id
         * return array()
         */
        public function getarray_contributeurs_for_action($action_id){
            //return array of utilisateur_id
            $values = $this->Actioncontributeur->find('all',array('fields'=>array('Actioncontributeur.utilisateur_id'),'condition'=>array('Actioncontributeur.action_id'=>$action_id),'recursive'=>0));
            return $values;
        }
        
        /**
         * getlist_contributeurs_for_action method
         * 
         * @param type $action_id
         * @return string separate with ,
         */
        public function getlist_contributeurs_for_action($action_id){
            //return string with , seperator of utilisateur_id
            return implode(",",$this->getarray_contributeurs_for_action($action_id));
        }    
        
        /**
         * save method
         * 
         * save record from the modal window
         */
        public function save(){
            $old = getarray_contributeurs_for_action($this->data['Actioncontributeur']['action_id']);
            $new = explode(',',$this->data['Actioncontributeur']['new_ids']);
            //compare oldvalue with new to delete
            $ids_todel = array_diff($old, $new);
            foreach($ids_todel as $id):
                $this->delete($id);
            endforeach;
            //compare newvalue with oldvalue to add
            $ids_tosave = array_diff($new, $old);
            foreach($ids_tosave as $id): 
                $record['Actioncontributeur']['action_id'] = $this->data['Actioncontributeur']['action_id'];
                $record['Actioncontributeur']['utilisateur_id'] = $id;
                $this->add($record);
            endforeach;
            $this->Session->setFlash(__('Contributeurs sauvegardés',true),'flash_success');
        }
}
