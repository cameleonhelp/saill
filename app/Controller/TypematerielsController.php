<?php
App::uses('AppController', 'Controller');
/**
 * Typemateriels Controller
 *
 * @property Typemateriel $Typemateriel
 */
class TypematerielsController extends AppController {
        public $components = array('History','Common'); 
    
        public $paginate = array(
        'limit' => 25,
        'order' => array('Typemateriel.NOM' => 'asc'),
        );
    
        public function get_list_uc(){
            return $this->Typemateriel->find('list',array('fields'=>array('Typemateriel.id','Typemateriel.NOM'),'conditions'=>array('Typemateriel.UC'=>1),'oreder'=>array('Typemateriel.NOM'=>'asc'),'recursive'=>0));
        }
        
        public function get_all_uc(){
            return $this->Typemateriel->find('all',array('conditions'=>array('Typemateriel.UC'=>1),'oreder'=>array('Typemateriel.NOM'=>'asc'),'recursive'=>0));
        }      
        
        public function get_typemateriel_uc_filter($id){
            $result = array();
            switch ($id){
                case 'tous':
                case null:    
                    $result['condition']="1=1";
                    $result['filter'] = " de tout type de matériel";
                    break;
                case '1' :
                    $result['condition']="Typemateriel.UC = 1";
                    $result['filter'] = " des Unités centrales et/ou portables";  
                    break;
                case '0' :
                    $result['condition']="Typemateriel.UC = 0";
                    $result['filter'] = " des autres type de matériel que Unité Centrale et portable";  
                    break;            
            }   
            return $result; 
        }
        
/**
 * index method
 *
 * @return void
 */
	public function index($filtreUC = null) {
            $this->set('title_for_layout','Types de matériel');
            if (isAuthorized('typemateriels', 'index')) :
                $getUC = $this->get_typemateriel_uc_filter($filtreUC);
                $this->set('strfilter',$getUC['filter']);
                $newconditions = array($getUC['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->set('typemateriels', $this->paginate());
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
            $this->set('title_for_layout','Types de matériel');
            if (isAuthorized('typemateriels', 'add')) :
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Typemateriel->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Typemateriel->create();
			if ($this->Typemateriel->save($this->request->data)) {
				$this->Session->setFlash(__('Type de matériel sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Type de matériel incorrect, veuillez corriger le type de matériel',true),'flash_failure');
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
            $this->set('title_for_layout','Types de matériel');
            if (isAuthorized('typemateriels', 'edit')) :
                if (!$this->Typemateriel->exists($id)) {
			throw new NotFoundException(__('Type de matériel incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Typemateriel->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Typemateriel->save($this->request->data)) {
				$this->Session->setFlash(__('Type de matériel sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Type de matériel incorrect, veuillez corriger le type de matériel',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Typemateriel.' . $this->Typemateriel->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Typemateriel->find('first', $options);
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
            $this->set('title_for_layout','Types de matériel');
            if (isAuthorized('typemateriels', 'delete')) :
                $this->Typemateriel->id = $id;
		if (!$this->Typemateriel->exists()) {
			throw new NotFoundException(__('Type de matériel incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Typemateriel->delete()) {
			$this->Session->setFlash(__('Type de matériel supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Type de matériel <b>NON</b> supprimé',true),'flash_failure');
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
	public function search($filtreUC=null,$keywords=null) {
            $this->set('title_for_layout','Types de matériel');
            if (isAuthorized('typemateriels', 'index')) :
                if(isset($this->params->data['Typemateriel']['SEARCH'])):
                    $keywords = $this->params->data['Typemateriel']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    $getUC = $this->get_typemateriel_uc_filter($filtreUC);
                    $this->set('strfilter',$getUC['filter']);
                    $newcondition = array($getUC['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Typemateriel.NOM LIKE '%".$value."%'","Typemateriel.DESCRIPTION LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('typemateriels', $this->paginate());     
                else:
                    $this->redirect(array('action'=>'index',$filtreUC));
                endif;                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }            
}
