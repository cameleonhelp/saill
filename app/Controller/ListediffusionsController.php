<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
/**
 * Listediffusions Controller
 *
 * @property Listediffusion $Listediffusion
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class ListediffusionsController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Listediffusion.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
            
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Liste de diffusion" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              
        
        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
                return $ObjAssoentiteutilisateurs->json_get_all_users(userAuth('id'));  
            endif;
        }
        
        public function get_restriction($visibility){
            $result = array();
            if($visibility == null):
                $result['condition']='1=1';
            elseif ($visibility!=''):
                $result['condition']=array('OR'=>array('Listediffusion.utilisateur_id IN ('.$visibility.')','Listediffusion.utilisateur_id IS NULL'));
            else:
                $result['condition']=array('OR'=>array('Listediffusion.utilisateur_id ='.userAuth('id'),'Listediffusion.utilisateur_id IS NULL'));
            endif;
            return $result;
        }
        
        public function get_export($condition){
            $this->Session->delete('xls_export');
            $export = $this->Listediffusion->find('all',array('conditions'=>$condition,'order' => array('Listediffusion.NOM' => 'asc'),'recursive'=>0));
            $this->Session->write('xls_export',$export);
        }
        
        public function get_list_utilisateur($visibility){
            if($visibility == null):
                 $condition = array('Utilisateur.ACTIF'=>1,'Utilisateur.id>1','Utilisateur.profil_id > 0');
            elseif ($visibility!=''):
                $condition = array('Utilisateur.ACTIF'=>1,'Utilisateur.id IN ('.$visibility.')','Utilisateur.profil_id > 0');
            else:
                $condition = array('Utilisateur.ACTIF'=>1,'Utilisateur.id ='.userAuth('id'),'Utilisateur.profil_id > 0');
            endif;            
            return $this->Listediffusion->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>$condition,'order'=>'Utilisateur.NOMLONG ASC','recursive'=>-1));
        }
/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->set_title();
            if (isAuthorized('listediffusions', 'index')) :
                $listusers = $this->get_visibility();
                $newcondition = $this->get_restriction($listusers);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition['condition'],'recursive'=>0)); 
		$this->set('listediffusions', $this->paginate());
                $this->get_export($newcondition['condition']);
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
            if (isAuthorized('listediffusions', 'add')) :
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Listediffusion->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Listediffusion->create();
			if ($this->Listediffusion->save($this->request->data)) {
				$this->Session->setFlash(__('Liste de diffusion sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Liste de diffusion incorrecte, veuillez corriger la liste de diffusion',true),'flash_failure');
			}
                    endif;
                endif;
                $visibility = $this->get_visibility();
                $utilisateurs = $this->get_list_utilisateur($visibility);
                $this->set('utilisateurs',$utilisateurs);
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
            if (isAuthorized('listediffusions', 'edit')) :
                if (!$this->Listediffusion->exists($id)) {
			throw new NotFoundException(__('Liste de diffusion incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Listediffusion->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Listediffusion->save($this->request->data)) {
				$this->Session->setFlash(__('Liste de diffusion sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Liste de diffusion incorrecte, veuillez corriger la liste de diffusion',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Listediffusion.' . $this->Listediffusion->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Listediffusion->find('first', $options);
                    $visibility = $this->get_visibility();
                    $utilisateurs = $this->get_list_utilisateur($visibility);
                    $this->set('utilisateurs',$utilisateurs);                        
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
            if (isAuthorized('listediffusions', 'delete')) :
                $this->Listediffusion->id = $id;
		if (!$this->Listediffusion->exists()) {
			throw new NotFoundException(__('Liste de diffusion incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Listediffusion->delete()) {
			$this->Session->setFlash(__('Liste de diffusion supprimée',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Liste de diffusion NON supprimée',true),'flash_failure');
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
            if (isAuthorized('listediffusions', 'index')) :               
                if(isset($this->params->data['Assistance']['SEARCH'])):
                    $keywords = $this->params->data['Assistance']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Listediffusion.NOM LIKE '%".$value."%'","Listediffusion.DESCRIPTION LIKE '%".$value."%'"));
                    endforeach;
                    $listusers = $this->get_visibility();
                    $newcondition = $this->get_restriction($listusers);                    
                    $conditions = array($newcondition['condition'],'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));
                    $this->set('listediffusions', $this->paginate()); 
                    $this->get_export($conditions);                    
                else:
                    $this->redirect(array('action'=>'index'));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
        }  
        
/**
 * export_xls
 * 
 */       
	function export_xls() {
		$data = $this->Session->read('xls_export');
                $this->Session->delete('xls_export');
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}  
        
        public function get_list(){
            $visibility = $this->get_visibility();
            $conditions = $this->get_restriction($visibility);
            $list = $this->Listediffusion->find('list',array('fields'=>array('id','NOM'),'conditions'=>$conditions['condition'],'order'=>array('Listediffusion.NOM'=>'asc'),"recursive"=>1));
            return $list;
        }
            
        public function get_all(){
            $visibility = $this->get_visibility();
            $conditions = $this->get_restriction($visibility);
            $list = $this->Listediffusion->find('all',array('conditions'=>$conditions['condition'],'order'=>array('Listediffusion.NOM'=>'asc'),"recursive"=>1));
            return $list;
        }           
}
