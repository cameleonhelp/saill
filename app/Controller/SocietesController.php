<?php
App::uses('AppController', 'Controller');
/**
 * Societes Controller
 *
 * @property Societe $Societe
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class SocietesController extends AppController {
        public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Societe.NOM' => 'asc'),
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            //$this->Session->delete('history');
            if (isAuthorized('societes', 'index')) :
		$this->set('societes', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('societes', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Societe->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Societe->create();
			if ($this->Societe->save($this->request->data)) {
				$this->Session->setFlash(__('Société sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Société incorrecte, veuillez corriger la société',true),'flash_failure');
			}
                    endif;
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
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
            if (isAuthorized('societes', 'edit')) :
		if (!$this->Societe->exists($id)) {
			throw new NotFoundException(__('Société incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Societe->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Societe->save($this->request->data)) {
				$this->Session->setFlash(__('Société sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Société incorrecte, veuillez corriger la société',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Societe.' . $this->Societe->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Societe->find('first', $options);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            if (isAuthorized('societes', 'delete')) :
		$this->Societe->id = $id;
		if (!$this->Societe->exists()) {
			throw new NotFoundException(__('Société incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Societe->delete()) {
			$this->Session->setFlash(__('Société supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Société <b>NON</b> supprime',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search($keywords=null) {
            if (isAuthorized('societes', 'index')) :
                if(isset($this->params->data['Societe']['SEARCH'])):
                    $keywords = $this->params->data['Societe']['SEARCH'];
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
                        $ornewconditions[] = array('OR'=>array("Societe.NOM LIKE '%".$value."%'","Societe.NOMCONTACT LIKE '%".$value."%'","Societe.TELEPHONE LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('societes', $this->paginate());     
                else:
                    $this->redirect(array('action'=>'index'));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
        }        
        
        public function get_all_societe_id_name(){
            $societes = $this->Societe->find('list',array('fields'=>array('Societe.id','Societe.NOM'),'order'=>array('Societe.NOM'=>'asc'),'recursive'=>-1));
            return $societes;
        }
        
        public function get_list(){
            $societes = $this->Societe->find('list',array('fields'=>array('Societe.id','Societe.NOM'),'order'=>array('Societe.NOM'=>'asc'),'recursive'=>-1));
            return $societes;
        }
        
        public function get_all(){
            $societes = $this->Societe->find('all',array('order'=>array('Societe.NOM'=>'asc'),'recursive'=>-1));
            return $societes;
        }        
}
