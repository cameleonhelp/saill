<?php
App::uses('AppController', 'Controller');
/**
 * Contrats Controller
 *
 * @property Contrat $Contrat
 */
class ContratsController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Contrat.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
/**
 * index method
 *
 * @return void
 */
	public function index($filtre) {
                switch ($filtre){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fcontrat = "tous les contrats";
                        break;
                    case 'actif':
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
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contrat->exists($id)) {
			throw new NotFoundException(__('Contrat incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Contrat.' . $this->Contrat->primaryKey => $id));
		$this->set('contrat', $this->Contrat->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $tjmcontrats = $this->Contrat->Tjmcontrat->find('list',array('fields' => array('id', 'TJM')));
                $this->set('tjmcontrats',$tjmcontrats);             
		if ($this->request->is('post')) {
			$this->Contrat->create();
			if ($this->Contrat->save($this->request->data)) {
				$this->Session->setFlash(__('Contrat sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index','actif'));
			} else {
				$this->Session->setFlash(__('Contrat incorrect, veuillez corriger le contrat'),true,array('class'=>'alert alert-error'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
                $tjmcontrats = $this->Contrat->Tjmcontrat->find('list',array('fields' => array('id', 'TJM')));
                $this->set('tjmcontrats',$tjmcontrats);            
		if (!$this->Contrat->exists($id)) {
			throw new NotFoundException(__('Contrat incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contrat->save($this->request->data)) {
				$this->Session->setFlash(__('Contrat sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index','actif'));
			} else {
				$this->Session->setFlash(__('Contrat incorrect, veuillez corriger le contrat'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Contrat.' . $this->Contrat->primaryKey => $id));
			$this->request->data = $this->Contrat->find('first', $options);
		}
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
		$this->Contrat->id = $id;
		if (!$this->Contrat->exists()) {
			throw new NotFoundException(__('Contrat incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contrat->delete()) {
			$this->Session->setFlash(__('Contrat supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index','actif'));
		}
		$this->Session->setFlash(__('Contrat <b>NON</b> supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $keyword=$this->params->data['Contrat']['SEARCH']; 
                $newconditions = array('OR'=>array("Contrat.NOM LIKE '%".$keyword."%'","Contrat.DESCRIPTION LIKE '%".$keyword."%'","Contrat.ANNEEDEBUT LIKE '%".$keyword."%'","Contrat.ANNEEFIN LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Contrat->recursive = 0;
                $this->set('contrats', $this->paginate());              
                $this->render('/Contrats/index');
        }         
}
