<?php
App::uses('AppController', 'Controller');
/**
 * Assobienlogiciels Controller
 *
 * @property Assobienlogiciel $Assobienlogiciel
 * @property PaginatorComponent $Paginator
 */
class AssobienlogicielsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25);
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Assobienlogiciel->recursive = 0;
		$this->set('assobienlogiciels', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Assobienlogiciel->exists($id)) {
			throw new NotFoundException(__('Invalid assobienlogiciel'));
		}
		$options = array('conditions' => array('Assobienlogiciel.' . $this->Assobienlogiciel->primaryKey => $id));
		$this->set('assobienlogiciel', $this->Assobienlogiciel->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Assobienlogiciel->create();
			if ($this->Assobienlogiciel->save($this->request->data)) {
				$this->Session->setFlash(__('The assobienlogiciel has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assobienlogiciel could not be saved. Please, try again.'));
			}
		}
		$biens = $this->Assobienlogiciel->Bien->find('list');
		$logiciels = $this->Assobienlogiciel->Logiciel->find('list');
		$this->set(compact('biens', 'logiciels'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Assobienlogiciel->exists($id)) {
			throw new NotFoundException(__('Invalid assobienlogiciel'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Assobienlogiciel->save($this->request->data)) {
				$this->Session->setFlash(__('The assobienlogiciel has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assobienlogiciel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Assobienlogiciel.' . $this->Assobienlogiciel->primaryKey => $id));
			$this->request->data = $this->Assobienlogiciel->find('first', $options);
		}
		$biens = $this->Assobienlogiciel->Bien->find('list');
		$logiciels = $this->Assobienlogiciel->Logiciel->find('list');
		$this->set(compact('biens', 'logiciels'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Assobienlogiciel->id = $id;
		if (!$this->Assobienlogiciel->exists()) {
			throw new NotFoundException(__('Invalid assobienlogiciel'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Assobienlogiciel->delete()) {
			$this->Session->setFlash(__('The assobienlogiciel has been deleted.'));
		} else {
			$this->Session->setFlash(__('The assobienlogiciel could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function get_list($id){
            $list = $this->Assobienlogiciel->find('all',array('conditions'=>array('Assobienlogiciel.bien_id'=>$id),'recursive'=>0));
            return $list;
        }     
        
        public function get_biens_for_outil($id=null){
            if($id!=null):
                $list = $this->Assobienlogiciel->find('all',array('conditions'=>array('Assobienlogiciel.logiciel_id'=>$id),'order'=>array('Bien.NOM'=>'asc'),'recursive'=>0));
                return $list;
            else:
                return array();
            endif;
        }
        
        public function get_id_for_outil($id=null){
            if($id!=null):
                $list = $this->Assobienlogiciel->find('all',array('fields'=>array('Assobienlogiciel.id'),'conditions'=>array('Assobienlogiciel.logiciel_id'=>$id),'order'=>array('Bien.NOM'=>'asc'),'recursive'=>0));
                $result = "";
                foreach($list as $obj):
                    if ($result == ""):
                        $result = $obj['Assobienlogiciel']['id'];
                    else :
                        $result .= ','.$obj['Assobienlogiciel']['id'];
                    endif;
                endforeach;
                return $result;
            else:
                return array();
            endif;
        }        
        
        public function get_outils_for_bien($id=null){
            if($id!=null):
                $list = $this->Assobienlogiciel->find('all',array('conditions'=>array('Assobienlogiciel.bien_id'=>$id),'order'=>array('Logiciel.NOM'=>'asc'),'recursive'=>2));
                return $list;
            else:
                return array();
            endif;
        }  
        
        public function save_logiciel_applicationid($id,$application_id){
            $this->Assobienlogiciel->Logiciel->id = $id;
            //tester si le logiciel exist
            $this->Assobienlogiciel->Logiciel->saveField('application_id', $application_id);
        }
                
	public function ajaxadd() {
            $this->autoRender = false;
            if (isAuthorized('biens', 'add') || isAuthorized('logiciels', 'add')) :
		if ($this->request->is('post')) :
			$this->Assobienlogiciel->create();
			if ($this->Assobienlogiciel->save($this->request->data)) {
                                $id = $this->Assobienlogiciel->getLastInsertID();
                                $this->add_date_install($id);
                                $this->save_logiciel_applicationid($this->request->data['Assobienlogiciel']['logiciel_id'], $this->request->data['Assobienlogiciel']['application_id']);
				$this->Session->setFlash(__('Ajout sauvegardé',true),'flash_success');
                        } else {
				$this->Session->setFlash(__('Objet incorrect, veuillez corriger l\'objet',true),'flash_failure');
			}
			$this->History->goBack(0);                       
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}   
        
	public function ajaxupdate() {
            $this->autoRender = false;
            if (isAuthorized('biens', 'add') || isAuthorized('logiciels', 'add')) :
		if ($this->request->is('post')) :
                    $lists = explode(',',$this->request->data['Assobienlogiciel']['id']);
                    foreach($lists as $id):
			$this->Assobienlogiciel->id = $id;
                        if ($this->Assobienlogiciel->saveField("logiciel_id",$this->request->data['Assobienlogiciel']['logiciel_id'])&& $this->Assobienlogiciel->saveField("INSTALL",1) && $this->Assobienlogiciel->saveField("DATEINSTALL",date('Y-m-d H:i:s'))) { // && $this->Assobienlogiciel->saveField("ENVDSIT",$this->request->data['Assobienlogiciel']['ENVDSIT']) && $this->Assobienlogiciel->saveField("INSTALL",$this->request->data['Assobienlogiciel']['INSTALL'])) {
                                //D$this->add_date_install($list['Assobienlogiciel']['id']);
				$this->Session->setFlash(__('Migration sauvegardée',true),'flash_success');
                        } else {
				$this->Session->setFlash(__('Objet incorrect, veuillez corriger l\'objet',true),'flash_failure');
			}
                     endforeach;
                     //delete du logiciel
                     $this->requestAction('logiciels/erase/'.$this->request->data['Assobienlogiciel']['old_logiciel_id']);
                     $this->History->goFirst();                       
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}  
        
	public function ajaxedit() {
            $this->autoRender = false;
            if (isAuthorized('biens', 'edit') || isAuthorized('logiciels', 'edit')) :
		if ($this->request->is('post') || $this->request->is('put')) :
                        $id = $this->request->data['Assobienlogiciel']['id'];
                        if ($this->Assobienlogiciel->exists($id)) {
                            $this->Assobienlogiciel->id = $id;
                            if ($this->Assobienlogiciel->save($this->request->data)) {
                                    $this->add_date_install($id);
                                    //tester si logiciel exist
                                    $logiciel = $this->requestAction('logiciels/get_info/'.$this->request->data['Assobienlogiciel']['logiciel_id']);
                                    if($logiciel['Logiciel']['application_id'] != $this->request->data['Assobienlogiciel']['application_id']):
                                        App::import('Controller', 'Logiciels');
                                        $thislogiciel = new LogicielsController();
                                        $envoutil_id = $logiciel['Logiciel']['envoutil_id'];
                                        $envversion_id = $logiciel['Logiciel']['envversion_id'];
                                        $application_id = $this->request->data['Assobienlogiciel']['application_id'];
                                        $lot_id = $logiciel['Logiciel']['lot_id'];
                                        if(!$thislogiciel->isExist($envoutil_id, $envversion_id, $application_id, $lot_id)):
                                            $this->save_logiciel_applicationid($this->request->data['Assobienlogiciel']['logiciel_id'], $this->request->data['Assobienlogiciel']['application_id']);
                                            $this->Session->setFlash(__('Modification sauvegardée',true),'flash_success');
                                        // si exist message erreur ou changer l'association ? opter pour changer l'association
                                        else:
                                            $logiciel_id = $thislogiciel->get_id_exist($envoutil_id, $envversion_id, $application_id, $lot_id);
                                            $this->Assobienlogiciel->id = $id;
                                            if($this->Assobienlogiciel->saveField('logiciel_id', $logiciel_id)):
                                                $this->Session->setFlash(__('Remplacement du logiciel dans l\'association sauvegardé',true),'flash_success');
                                            else:
                                                $this->Session->setFlash(__('Remplacement du logiciel impossible dans l\'association',true),'flash_failure');
                                            endif;
                                        endif;
                                    endif;
                            } else {
                                    $this->Session->setFlash(__('Objet incorrect, veuillez corriger l\'objet',true),'flash_failure');
                            }
                        }
                        $this->History->goBack(1);                        
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}  
        
	public function ajaxdelete($id) {
            $this->autoRender = false;
            if (isAuthorized('biens', 'delete') || isAuthorized('logiciels', 'delete')) :
		if ($this->request->is('post') || $this->request->is('put')) :
                        $this->Assobienlogiciel->id = $id;
			if ($this->Assobienlogiciel->delete()) {
				$this->Session->setFlash(__('Objet supprimé',true),'flash_success');
			} else {
				$this->Session->setFlash(__('Objet incorrect, veuillez corriger l\'objet',true),'flash_failure');
			}
                        $this->History->notmove();                        
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}         
        
        public function json_get_logiciel_info($id){
            $this->autoRender = false;
            $conditions[] = 'Assobienlogiciel.id='.$id;
            $return = $this->Assobienlogiciel->find('all',array('conditions'=>$conditions,'recursive'=>-1));
            $result = json_encode($return);
            return $result;
        }
        
        public function ajax_install($id=null){
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;                
                $this->saveHistory($newid);
                $this->Assobienlogiciel->id = $newid;
                $obj = $this->Assobienlogiciel->find('first',array('conditions'=>array('Assobienlogiciel.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Assobienlogiciel']['INSTALL'] == true ? 0 : 1;
                $date = $newactif == 0 ? null : date('Y-m-d H:i:s');
		if ($this->Assobienlogiciel->saveField('INSTALL',$newactif) && $this->Assobienlogiciel->saveField('DATEINSTALL',$date)) {
			if ($id==null):
                            $this->Session->setFlash(__('Statut d\'installation pris en compte',true),'flash_success');
                        else:
                            $result = true;
                        endif;
		} else {
			if ($id==null):
                           $this->Session->setFlash(__('Statut d\'installation <b>NON</b> pris en compte',true),'flash_failure');
                        else:
                            $result = false;
                        endif;                    
		}
		if ($id==null):
                    exit();
                else:
                    return $result;
                endif;
        }  
        
        public function add_date_install($id){
            $this->Assobienlogiciel->id = $id;
            $obj = $this->Assobienlogiciel->read();
            if($obj['Assobienlogiciel']['INSTALL']==true){
                $this->Assobienlogiciel->saveField('DATEINSTALL',date('Y-m-d H:i:s'));
            } else {
                $this->Assobienlogiciel->saveField('DATEINSTALL',null);
            }
        }
        
        public function saveHistory($id=null){
            if($id!=null && userAuth('id')!=null):
                $this->Assobienlogiciel->id = $id;
                $obj = $this->Assobienlogiciel->read(); 
                $record['Historylogiciel']['assobienlogiciel_id']=$id;
                $record['Historylogiciel']['INSTALL']=$obj['Assobienlogiciel']['INSTALL'];
                $record['Historylogiciel']['DATEINSTALL']=$obj['Assobienlogiciel']['DATEINSTALL'];
                $record['Historylogiciel']['MODIFIEDBY']= userAuth('id'); 
                $record['Historylogiciel']['created']=date('Y-m-d H:i:s');
                $record['Historylogiciel']['modified']=date('Y-m-d H:i:s');
                $this->Assobienlogiciel->Historylogiciel->create();
                if ($this->Assobienlogiciel->Historylogiciel->save($record)) {
                        $this->Session->setFlash(__('Modification historisée',true),'flash_success');
                } else {
                        $this->Session->setFlash(__('Historisation incorrecte, veuillez corriger le logiciel',true),'flash_failure');
                }
            else:
                $this->Session->setFlash(__('Historisation impossible le logiciel est incorect.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;
        }
}
