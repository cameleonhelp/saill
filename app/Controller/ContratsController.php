<?php
App::uses('AppController', 'Controller');
/**
 * Contrats Controller
 *
 * @property Contrat $Contrat
 */
class ContratsController extends AppController {
        public $components = array('History');
        public $paginate = array(
        'limit' => 15,
        'order' => array('Contrat.NOM' => 'asc'),
        'conditions' => array('Contrat.id >' => 1),
        );
/**
 * index method
 *
 * @return void
 */
	public function index($filtre=null) {
            //$this->Session->delete('history');
            if (isAuthorized('contrats', 'index')) :
                switch ($filtre){
                    case 'tous':    
                        $newconditions[]="1=1";
                        $fcontrat = "tous les contrats";
                        break;
                    case 'actif':
                    case '<':
                    case null:    
                        $newconditions[]="Contrat.ACTIF=1";
                        $fcontrat = "tous les contrats actifs";
                        break;  
                    case 'inactif':
                        $newconditions[]="Contrat.ACTIF=0";
                        $fcontrat = "tous les contrats inactifs";
                        break;                     
                }    
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Contrat->recursive = 0;
		$this->set('contrats', $this->paginate());
                $this->set('fcontrat',$fcontrat);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
            if (isAuthorized('contrats', 'view')) :
		if (!$this->Contrat->exists($id)) {
			throw new NotFoundException(__('Contrat incorrect'));
		}
		$options = array('conditions' => array('Contrat.' . $this->Contrat->primaryKey => $id));
		$this->set('contrat', $this->Contrat->find('first', $options));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('contrats', 'add')) :
                $tjmcontrats = $this->Contrat->Tjmcontrat->find('list',array('fields' => array('id', 'TJM'),'recursive'=>-1));
                $this->set('tjmcontrats',$tjmcontrats);             
		if ($this->request->is('post')) :
			$this->Contrat->create();
			if ($this->Contrat->save($this->request->data)) {
				$this->Session->setFlash(__('Contrat sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Contrat incorrect, veuillez corriger le contrat'),'default',array('class'=>'alert alert-error'));
			}
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
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
            if (isAuthorized('contrats', 'edit')) :
                $tjmcontrats = $this->Contrat->Tjmcontrat->find('list',array('fields' => array('id', 'TJM'),'recursive'=>-1));
                $this->set('tjmcontrats',$tjmcontrats);            
		if (!$this->Contrat->exists($id)) {
			throw new NotFoundException(__('Contrat incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contrat->save($this->request->data)) {
				$this->Session->setFlash(__('Contrat sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Contrat incorrect, veuillez corriger le contrat'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Contrat.' . $this->Contrat->primaryKey => $id));
			$this->request->data = $this->Contrat->find('first', $options);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
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
            if (isAuthorized('contrats', 'delete')) :
		$this->Contrat->id = $id;
		if (!$this->Contrat->exists()) {
			throw new NotFoundException(__('Contrat incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Contrat->delete()) {
			$this->Session->setFlash(__('Contrat supprimé'),'default',array('class'=>'alert alert-success'));
			$this->History->goBack();
		}
		$this->Session->setFlash(__('Contrat <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->History->goBack();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('contrats', 'index')) :
                $keyword=isset($this->params->data['Contrat']['SEARCH']) ? $this->params->data['Contrat']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Contrat.NOM LIKE '%".$keyword."%'","Contrat.DESCRIPTION LIKE '%".$keyword."%'","Contrat.ANNEEDEBUT LIKE '%".$keyword."%'","Contrat.ANNEEFIN LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Contrat->recursive = 0;
                $this->set('contrats', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }         
}
