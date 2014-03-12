<?php
App::uses('AppController', 'Controller');
/**
 * Linkshareds Controller
 *
 * @property Linkshared $Linkshared
 */
class LinksharedsController extends AppController {
        public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Linkshared.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:        
            //ajout du compte admin (id=1) pour afficher les liens ajouté par l'administrateur qui sont donc commun à tous
            return '1,'.$this->requestAction('assoentiteutilisateurs/json_get_all_users/'.userAuth('id'));
        endif;
    }
    
    public function get_linkshared_filter($visibility){
        $result = array();
        if($visibility == null):
            $result['condition']='1=1';
        elseif ($visibility!=''):
            $result['condition']="Linkshared.utilisateur_id IN (".$visibility.')';
        else:
            $result['condition']="Linkshared.utilisateur_id =".userAuth('id');
        endif;                        
        return $result;
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
            //$this->Session->delete('history');
            $this->set('title_for_layout','Liens partagés');
            $listusers = $this->get_visibility();
            $getfilter = $this->get_linkshared_filter($listusers);
            $newconditions =  array($getfilter['condition']); 
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));
            $this->set('linkshareds', $this->paginate());              
        }

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('linkshareds', 'add')) :
                $this->set('title_for_layout','Liens partagés');
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Linkshared->validate = array();
                        $this->History->goFirst();
                    else:                    
			$this->Linkshared->create();
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('Lien partagé sauvegardé',true),'flash_success');
				$this->History->goFirst();
			} else {
				$this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé',true),'flash_failure');
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
            if (isAuthorized('linkshareds', 'edit')) :
                $this->set('title_for_layout','Liens partagés');
                if (!$this->Linkshared->exists($id)) {
			throw new NotFoundException(__('Lien partagé incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Linkshared->validate = array();
                        $this->History->goFirst();
                    else:                    
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('Lien partagé sauvegardé',true),'flash_success');
				$this->History->goFirst();
			} else {
				$this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Linkshared.' . $this->Linkshared->primaryKey => $id));
			$this->request->data = $this->Linkshared->find('first', $options);
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
            if (isAuthorized('linkshareds', 'delete')) :
                $this->set('title_for_layout','Liens partagés');
                $this->Linkshared->id = $id;
		if (!$this->Linkshared->exists()) {
			throw new NotFoundException(__('Lien partagé incorrect'));
		}
		if ($this->Linkshared->delete()) {
			$this->Session->setFlash(__('Lien partagé supprimé',true),'flash_success');
			$this->History->goFirst();
		}
		$this->Session->setFlash(__('Lien partagé <b>NON</b> supprimé',true),'flash_failure');
		$this->History->goFirst();
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
            $this->set('title_for_layout','Liens partagés');
            if (isAuthorized('linkshareds', 'index')) :
                if(isset($this->params->data['Activitesreelle']['SEARCH'])):
                    $keywords = $this->params->data['Activitesreelle']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords));  
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Linkshared.NOM LIKE '%".$value."%'","Linkshared.LINK LIKE '%".$value."%'"));
                    endforeach;
                    $listusers = $this->get_visibility();
                    $getfilter = $this->get_linkshared_filter($listusers);
                    $newconditions =  array($getfilter['condition']);                   
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));
                    $this->set('linkshareds', $this->paginate());              
                else:
                    $this->redirect(array('action'=>'index'));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }   
}        
