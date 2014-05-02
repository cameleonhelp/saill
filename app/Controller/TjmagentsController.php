<?php
App::uses('AppController', 'Controller');
/**
 * Tjmagents Controller
 *
 * @property Tjmagent $Tjmagent
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class TjmagentsController extends AppController {
        public $components = array('History','Common');
    public $paginate = array(
        'limit' => 25,
        'order' => array('Tjmagent.NOM' => 'asc'),
        );
    
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "TJM agents" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }      
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->set_title();
            if (isAuthorized('tjmagents', 'index')) :
                $this->Tjmagent->recursive = 0;
		$this->set('tjmagents', $this->paginate());
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
            $this->set_title();
            if (isAuthorized('tjmagents', 'add')) :
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Tjmagent->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Tjmagent->create();
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('TJM agent sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('TJM agent incorrect, veuillez corriger le TJM agent',true),'flash_failure');
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
            $this->set_title();
            if (isAuthorized('tjmagents', 'edit')) :
                if (!$this->Tjmagent->exists($id)) {
			throw new NotFoundException(__('TJM agent incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Tjmagent->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('TJM agent sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('TJM agent incorrect, veuillez corriger le TJM agent',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Tjmagent.' . $this->Tjmagent->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Tjmagent->find('first', $options);
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
            $this->set_title();
            if (isAuthorized('tjmagents', 'delete')) :
                $this->Tjmagent->id = $id;
		if (!$this->Tjmagent->exists()) {
			throw new NotFoundException(__('TJM agent incorrect'));
		}
		if ($this->Tjmagent->delete()) {
			$this->Session->setFlash(__('TJM agent supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('TJM agent <b>NON</b> supprimé',true),'flash_failure');
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
            $this->set_title();
            if (isAuthorized('tjmagents', 'index')) :
                if(isset($this->params->data['Tjmagent']['SEARCH'])):
                    $keywords = $this->params->data['Tjmagent']['SEARCH'];
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
                        $ornewconditions[] = array('OR'=>array("Tjmagent.NOM LIKE '%".$value."%'","Tjmagent.ANNEE LIKE '%".$value."%'","Tjmagent.TARIFHT LIKE '%".$value."%'","Tjmagent.TARIFTTC LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('tjmagents', $this->paginate());   
                else:
                    $this->redirect(array('action'=>'index'));
                endif;   
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
        }  
              
        public function get_list(){
            return $this->Tjmagent->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc'),'recursive'=>0));
        }
        
        public function get_all(){
            return $this->Tjmagent->find('all',array('order'=>array('NOM'=>'asc'),'recursive'=>0));
        }   
        
        public function get_current_list(){
            return $this->Tjmagent->find('list',array('fields' => array('id', 'NOM'),'conditions'=>array('ANNEE'=>date('Y')),'order'=>array('NOM'=>'asc'),'recursive'=>0));
        }
        
        public function get_current_all(){
            return $this->Tjmagent->find('all',array('order'=>array('NOM'=>'asc'),'conditions'=>array('ANNEE'=>date('Y')),'recursive'=>0));
        }         
}
