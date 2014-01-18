<?php
App::uses('AppController', 'Controller');
/**
 * Mws Controller
 *
 * @property Mw $Mw
 * @property PaginatorComponent $Paginator
 */
class MwsController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Mw.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null,$envoutil=null) {
            $this->set('title_for_layout','Middlewares');
            if (isAuthorized('mws', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Mw.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Mw.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                switch($envoutil):
                    case null:
                        $newconditions[]="1=1";
                        $strfilter .= ' de tous les outils';
                        break;
                    default:
                        $newconditions[]="Mw.envoutil_id=".$envoutil;
                        $nomenvoutil = $this->Mw->Envoutil->findById($envoutil);
                        $strfilter .= ' pour l\'outil '.$nomenvoutil['Envoutil']['NOM'];
                        break;
                endswitch;                
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Mw->recursive = 0;
		$this->set('mws', $this->paginate());
                $envoutils = $this->requestAction('envoutils/get_list/1');
                $this->set('envoutils',$envoutils);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->set('title_for_layout','Middlewares');
		if (!$this->Mw->exists($id)) {
			throw new NotFoundException(__('Middleware incorrect'));
		}
		$options = array('conditions' => array('Mw.' . $this->Mw->primaryKey => $id));
		$this->set('mw', $this->Mw->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Middlewares');
            if (isAuthorized('mws', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Mw->validate = array();
                        $this->History->goBack(1);
                    else:                     
                        if ($this->isUniqueField('Mw.NOM',$this->request->data['Mw']['NOM'])):
                            $this->Mw->create();
                            if ($this->Mw->save($this->request->data)) {
                                    $this->Session->setFlash(__('Middleware sauvegardé',true),'flash_success');
                                    $this->History->goBack(1);
                            } else {
                                    $this->Session->setFlash(__('Middleware incorrect, veuillez corriger l\'application',true),'flash_failure');
                            }
                        else:
                            $this->Session->setFlash(__('Le nom du middleware existe déjà, veuillez corriger l\'application',true),'flash_failure');
                        endif;
                    endif;
		endif;
                $envoutils = $this->requestAction('envoutils/get_select/1');
                $this->set('envoutils',$envoutils);                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}

        public function isUniqueField($field,$value){
            $options = array('conditions' => array($field=>$value));
            $result = $this->Mw->find('count', $options);
            if ($result> 0):
                return false;
            else:
                return true;
            endif;
        }
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            $this->set('title_for_layout','Middlewares');
            if (isAuthorized('mws', 'edit')) :    
                $options = array('conditions' => array('Mw.' . $this->Mw->primaryKey => $id));
                $mw = $this->Mw->find('first', $options);
                $this->set('mw',$mw);
                $envoutils = $this->requestAction('envoutils/get_select/1');
                $this->set('envoutils',$envoutils);
                        
		if (!$this->Mw->exists($id)) {
			throw new NotFoundException(__('Middleware incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Mw->validate = array();
                        $this->History->goBack(1);
                    else:                     
                        if ($this->isUniqueFieldUntilId('Mw.NOM',$this->request->data['Mw']['NOM'],$id)):
                            if ($this->Mw->save($this->request->data)) {
                                    $this->Session->setFlash(__('Middleware sauvegardé',true),'flash_success');
                                    $this->History->goBack(1);
                            } else {
                                    $this->Session->setFlash(__('Middleware incorrect, veuillez corriger l\'application',true),'flash_failure');
                            }
                        else:
                            $this->Session->setFlash(__('Le nom du middleware existe déjà, veuillez corriger l\'application',true),'flash_failure');
                        endif;
                    endif;
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

        public function isUniqueFieldUntilId($field,$value,$id){
            $options = array('conditions' => array($field=>$value,'Mw.id !='.$id));
            $result = $this->Mw->find('count', $options);
            if ($result> 0):
                return false;
            else:
                return true;
            endif;
        }
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            $this->set('title_for_layout','Middlewares');
            if (isAuthorized('mws', 'delete')) : 
		$this->Mw->id = $id;
		if (!$this->Mw->exists()) {
			throw new NotFoundException(__('Middleware incorrect'));
		}
		if ($this->Mw->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Middleware supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Middleware <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Mw->id = $id;
                $obj = $this->Mw->find('first',array('conditions'=>array('Mw.id'=>$id),'recursive'=>0));
                $newactif = $obj['Mw']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Mw->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Middlewares');
            if (isAuthorized('mws', 'index')) :
                $keyword=isset($this->params->data['Mw']['SEARCH']) ? $this->params->data['Mw']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Mw.NOM LIKE '%".$keyword."%'","Mw.PVU LIKE '%".$keyword."%'","Mw.COUTUNITAIRE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Mw->recursive = 0;
                $this->set('mws', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Mw->find('list',array('fields'=>array('Mw.id','Mw.NOM'),'conditions'=>array('Mw.ACTIF'=>$actif),'order'=>array('Mw.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }         
}
