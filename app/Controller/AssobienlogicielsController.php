<?php
App::uses('AppController', 'Controller');
App::uses('LogicielsController', 'Controller');
/**
 * Assobienlogiciels Controller
 *
 * @property Assobienlogiciel $Assobienlogiciel
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class AssobienlogicielsController extends AppController {


    /**
     * varaibles globales utilisées dans ce controller
     */
    public $components = array('History','Common');

    /**
     * Autorise l'appel de méthodes sans connexion
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_logiciel_info'));
        parent::beforeFilter();
    }   

/**
* index method
*
* @return void
*/
//	public function index() {
//		$this->Assobienlogiciel->recursive = 0;
//		$this->set('assobienlogiciels', $this->paginate());
//	}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
//	public function view($id = null) {
//		if (!$this->Assobienlogiciel->exists($id)) {
//			throw new NotFoundException(__('Invalid assobienlogiciel'));
//		}
//		$options = array('conditions' => array('Assobienlogiciel.' . $this->Assobienlogiciel->primaryKey => $id));
//		$this->set('assobienlogiciel', $this->Assobienlogiciel->find('first', $options));
//	}

/**
* add method
*
* @return void
*/
//	public function add() {
//		if ($this->request->is('post')) {
//			$this->Assobienlogiciel->create();
//			if ($this->Assobienlogiciel->save($this->request->data)) {
//				$this->Session->setFlash(__('The assobienlogiciel has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The assobienlogiciel could not be saved. Please, try again.'));
//			}
//		}
//		$biens = $this->Assobienlogiciel->Bien->find('list');
//		$logiciels = $this->Assobienlogiciel->Logiciel->find('list');
//		$this->set(compact('biens', 'logiciels'));
//	}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
//	public function edit($id = null) {
//		if (!$this->Assobienlogiciel->exists($id)) {
//			throw new NotFoundException(__('Invalid assobienlogiciel'));
//		}
//		if ($this->request->is(array('post', 'put'))) {
//			if ($this->Assobienlogiciel->save($this->request->data)) {
//				$this->Session->setFlash(__('The assobienlogiciel has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The assobienlogiciel could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('Assobienlogiciel.' . $this->Assobienlogiciel->primaryKey => $id));
//			$this->request->data = $this->Assobienlogiciel->find('first', $options);
//		}
//		$biens = $this->Assobienlogiciel->Bien->find('list');
//		$logiciels = $this->Assobienlogiciel->Logiciel->find('list');
//		$this->set(compact('biens', 'logiciels'));
//	}

/**
* delete method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
//	public function delete($id = null) {
//		$this->Assobienlogiciel->id = $id;
//		if (!$this->Assobienlogiciel->exists()) {
//			throw new NotFoundException(__('Invalid assobienlogiciel'));
//		}
//		$this->request->onlyAllow('post', 'delete');
//		if ($this->Assobienlogiciel->delete()) {
//			$this->Session->setFlash(__('The assobienlogiciel has been deleted.'));
//		} else {
//			$this->Session->setFlash(__('The assobienlogiciel could not be deleted. Please, try again.'));
//		}
//		return $this->redirect(array('action' => 'index'));
//	}

    /**
     * retourne toutes les associations pour un bien
     * 
     * @param int $id du bien
     * @return array
     */
    public function get_list($id){
        $list = $this->Assobienlogiciel->find('all',array('conditions'=>array('Assobienlogiciel.bien_id'=>$id),'recursive'=>0));
        return $list;
    }     

    /**
     * retourne un tableau des biens pour un logiciel
     * 
     * @param int $id du logiciel
     * @return array
     */
    public function get_biens_for_outil($id=null){
        if($id!=null):
            $list = $this->Assobienlogiciel->find('all',array('conditions'=>array('Assobienlogiciel.logiciel_id'=>$id),'order'=>array('Bien.NOM'=>'asc'),'recursive'=>0));
            return $list;
        else:
            return array();
        endif;
    }

    /**
     * retourne l'identifiant de l'associaltion pour un logiciel
     * 
     * @param int $id du logiciel
     * @return string des identifiants
     */
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

    /**
     * retourne tous les logiciels d'un bien
     * 
     * @param int $id du bien
     * @return array des logiciels
     */
    public function get_outils_for_bien($id=null){
        if($id!=null):
            $list = $this->Assobienlogiciel->find('all',array('conditions'=>array('Assobienlogiciel.bien_id'=>$id),'order'=>array('Logiciel.NOM'=>'asc'),'recursive'=>0));
            return $list;
        else:
            return array();
        endif;
    }  

    /**
     * sauvegarde de l'application rattachée au logiciel
     * 
     * @param int $id du logiciel
     * @param int $application_id de l'application
     */
    public function save_logiciel_applicationid($id,$application_id){
        $this->Assobienlogiciel->Logiciel->id = $id;
        //tester si le logiciel exist
        $this->Assobienlogiciel->Logiciel->saveField('application_id', $application_id);
    }

    /**
     * Ajout dynamique d'une association
     * 
     * @throws UnauthorizedException
     */
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }   

    /**
     * mise à jour de certains champs de l'association (Ajax)
     * 
     * @throws UnauthorizedException
     */
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
                 $ObjLogiciels = new LogicielsController();		
                 $ObjLogiciels->erase($this->request->data['Assobienlogiciel']['old_logiciel_id']);
                 $this->History->goFirst();                       
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }  

    /**
     * Mise à jour dynamique de l'association (Ajax)
     * 
     * @throws UnauthorizedException
     */
    public function ajaxedit() {
        $this->autoRender = false;
        if (isAuthorized('biens', 'edit') || isAuthorized('logiciels', 'edit')) :
            if ($this->request->is('post') || $this->request->is('put')) :
                    $id = $this->request->data['Assobienlogiciel']['id'];
                    if ($this->Assobienlogiciel->exists($id)) {
                        $this->Assobienlogiciel->id = $id;
                        if ($this->Assobienlogiciel->save($this->request->data)) {
                                $this->add_date_install($id);
                                $ObjLogiciels = new LogicielsController();	
                                $logiciel = $ObjLogiciels->get_info($this->request->data['Assobienlogiciel']['logiciel_id']);
                                if($logiciel['Logiciel']['application_id'] != $this->request->data['Assobienlogiciel']['application_id']):
                                    App::uses('Controller', 'Logiciels');
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }  

    /**
     * suppression dynamique de l'association (Ajax)
     * 
     * @param int $id
     * @throws UnauthorizedException
     */
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }         

    /**
     * Retourne les finormation sur le logiciel
     * 
     * @param int $id de l'association
     * @return json
     */
    public function json_get_logiciel_info($id){
        $this->autoRender = false;
        $conditions[] = 'Assobienlogiciel.id='.$id;
        $return = $this->Assobienlogiciel->find('all',array('conditions'=>$conditions,'recursive'=>-1));
        $result = json_encode($return);
        return $result;
    }

    /**
     * mise à jour dynamique de la date d'installation (Ajax)
     * 
     * @param int $id
     * @return boolean
     */
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

    /**
     * Mise à jour de la date d'installation 
     * 
     * @param int $id de l'association
     */
    public function add_date_install($id){
        $this->Assobienlogiciel->id = $id;
        $obj = $this->Assobienlogiciel->read();
        if($obj['Assobienlogiciel']['INSTALL']==true){
            $this->Assobienlogiciel->saveField('DATEINSTALL',date('Y-m-d H:i:s'));
        } else {
            $this->Assobienlogiciel->saveField('DATEINSTALL',null);
        }
    }

    /**
     * Sauvegarde de l'historique
     * 
     * @param int $id identifiant de l'association
     * @throws UnauthorizedException
     */
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;
    }

    /**
     * Mise à jour dynamique de l'environnement (Ajax)
     */
    public function ajaxupdateenv(){
        $this->autoRender = false;
        $this->Assobienlogiciel->id = $this->request->data('id');
        if ($this->Assobienlogiciel->saveField('dsitenv_id',$this->request->data('dsitenvid'))) {
                $this->Session->setFlash(__('Liste environnements DSI-T sauvegardée',true),'flash_success');
                //$this->History->notmove();
        } else {
                $this->Session->setFlash(__('Liste environnements DSI-T incorrecte, veuillez corriger la liste',true),'flash_failure');
        }
    }

    /**
     * retourne la liste des association pour un environnement DSIT
     * 
     * @param int $dsitenv_id
     * @param int $application_id
     * @return Assobienlogiciel
     */
    public function get_for_dsitenv($dsitenv_id,$application_id){
        //retrait de la condition sur l'application ,'Bien.application_id'=>$application_id
        $list = $this->Assobienlogiciel->find('all',array('conditions'=>array('OR'=>array('Assobienlogiciel.dsitenv_id'=>$dsitenv_id,'Assobienlogiciel.dsitenv_id LIKE "%'.$dsitenv_id.',%"','Assobienlogiciel.dsitenv_id LIKE "%,'.$dsitenv_id.'%"'),'Bien.application_id'=>$application_id),'order'=>array('Bien.NOM'=>'asc'),'group'=>'Bien.NOM','recursive'=>1));
        return $list;
    }          
}
