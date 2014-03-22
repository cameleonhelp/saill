<?php
App::uses('AppController', 'Controller');
/**
 * Tjmcontrats Controller
 *
 * @property Tjmcontrat $Tjmcontrat
 */
class TjmcontratsController extends AppController {
        public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Tjmcontrat.TJM' => 'asc'),
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->set('title_for_layout','TJM contrats');
            if (isAuthorized('tjmcontrats', 'index')) :
                $this->Tjmcontrat->recursive = 0;
		$this->set('tjmcontrats', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','TJM contrats');
            if (isAuthorized('tjmcontrats', 'add')) :
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Tjmcontrat->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Tjmcontrat->create();
			if ($this->Tjmcontrat->save($this->request->data)) {
				$this->Session->setFlash(__('TJM contrat sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('TJM contrat incorrect, veuillez corriger le TJM contrat',true),'flash_failure');
			}
                    endif;
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
            $this->set('title_for_layout','TJM contrats');
            if (isAuthorized('tjmcontrats', 'edit')) :
                if (!$this->Tjmcontrat->exists($id)) {
			throw new NotFoundException(__('TJM contrat incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Tjmcontrat->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Tjmcontrat->save($this->request->data)) {
				$this->Session->setFlash(__('TJM contrat sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('TJM contrat incorrect, veuillez corriger le TJM contrat',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Tjmcontrat.' . $this->Tjmcontrat->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Tjmcontrat->find('first', $options);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
            $this->set('title_for_layout','TJM contrats');
            if (isAuthorized('tjmcontrats', 'delete')) :
                $this->Tjmcontrat->id = $id;
		if (!$this->Tjmcontrat->exists()) {
			throw new NotFoundException(__('TJM contrat incorrect'));
		}
		if ($this->Tjmcontrat->delete()) {
			$this->Session->setFlash(__('TJM contrat supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('TJM contrat <b>NON</b> supprimé',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search($keywords=null) {
            $this->set('title_for_layout','TJM contrats');
            if (isAuthorized('tjmcontrats', 'index')) :
                if(isset($this->params->data['Tjmcontrat']['SEARCH'])):
                    $keywords = $this->params->data['Tjmcontrat']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Tjmcontrat.TJM LIKE '%".$value."%'","Tjmcontrat.ANNEE LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array('OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('tjmcontrats', $this->paginate());                   
                else:
                    $this->redirect(array('action'=>'index'));
                endif;              
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }      
        
        public function get_all(){
            $conditions[] = '1=1';
            return $this->Tjmcontrat->find('all',array('conditions'=>$conditions,'recursive'=>0));
        }
        
        public function get_list(){
            $conditions[] = '1=1';
            return $this->Tjmcontrat->find('list',array('fields'=>array('Tjmcontrat.id','Tjmcontrat.TJM'),'conditions'=>$conditions,'recursive'=>0));
        }        
}
