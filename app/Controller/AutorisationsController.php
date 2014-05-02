<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Profils');
/**
 * Autorisations Controller
 *
 * @property Autorisation $Autorisation
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class AutorisationsController extends AppController {
        public $components = array('History','Common'); 
        public $paginate = array(
            'limit' => 25,
            'order' => array('Profil.NOM' => 'asc','Autorisation.MODEL' => 'asc'),
            /*'order' => array(
                'Post.title' => 'asc' /*/
            );
        
        public function get_autorisations_filter($id){
            $result = array();
            switch ($id){
                case 'tous':
                case null:    
                    $result['condition']="1=1";
                    $result['filter'] = "tous les profils";
                    break;
                default :
                    $result['condition']="Profil.id='".$id."'";
                    $profil = $this->Autorisation->Profil->find('first',array('conditions'=>array('Profil.id'=>$id)));
                    $result['filter'] = "le profil ".$profil['Profil']['NOM'];                        
            }  
            return $result;
        }
        
        public function get_all_tables(){
            $models = $this->Autorisation->findAllTables($this->Autorisation);
            $models = array_merge($models,array('rapports'=>'rapports'));
            asort($models);
            return $models;
        }
    
 /**
 * index method
 *
 * @return void
 */
	public function index($filtreautorisation=null) {
            //$this->Session->delete('history');
            if (isAuthorized('autorisations', 'index')) :
                $getautorisation = $this->get_autorisations_filter($filtreautorisation);
                $this->set('fprofil',$getautorisation['filter']); 
                $newconditions = array($getautorisation['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));
		$this->set('autorisations', $this->paginate());
                $ObjProfils = new ProfilsController();   
                $profils = $ObjProfils->get_all();
                $this->set('profils',$profils);                
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
            if (isAuthorized('autorisations', 'index')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Autorisation->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Autorisation->create();
			if ($this->Autorisation->save($this->request->data)) {
				$this->Session->setFlash(__('Autorisation sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Autorisation incorrecte, veuillez corriger l\'autorisation',true),'flash_failure');
			}
                    endif;
		endif;
                $models = $this->get_all_tables();
                $ObjProfils = new ProfilsController();   
                $profis = $ObjProfils->get_list();
                $this->set(compact('models','profil'));                
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
            if (isAuthorized('autorisations', 'index')) :           
		if (!$this->Autorisation->exists($id)) {
			throw new NotFoundException(__('Autorisation incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Autorisation->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Autorisation->save($this->request->data)) {
				$this->Session->setFlash(__('Autorisation sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Autorisation incorrecte, veuillez corriger l\'autorisation',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Autorisation.' . $this->Autorisation->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Autorisation->find('first', $options);
                        $this->set('autorisation', $this->Autorisation->find('first', $options));
                        $models = $this->get_all_tables();
                        $ObjProfils = new ProfilsController();   
                        $profis = $ObjProfils->get_list();
                        $this->set(compact('models','profil'));                        
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
            if (isAuthorized('autorisations', 'index')) :
		$this->Autorisation->id = $id;
		if (!$this->Autorisation->exists()) {
			throw new NotFoundException(__('Autorisation incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Autorisation->delete()) {
			$this->Session->setFlash(__('Autorisation supprimée',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Autorisation NON supprimée',true),'flash_failure');
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
	public function search($filtreautorisation=null,$keywords=null) {
            if (isAuthorized('autorisations', 'index')) :
                if(isset($this->params->data['Autorisation']['SEARCH'])):
                    $keywords = $this->params->data['Autorisation']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords));                 
                    $getautorisation = $this->get_autorisations_filter($filtreautorisation);
                    $this->set('fprofil',$getautorisation['filter']); 
                    $newconditions = array($getautorisation['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Profil.NOM LIKE '%".$value."%'","Autorisation.MODEL LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));
                    $this->set('autorisations', $this->paginate());
                    $ObjProfils = new ProfilsController();   
                    $profils = $ObjProfils->get_all();
                    $this->set('profils',$profils);    
                else:
                    $this->redirect(array('action'=>'index',$filtreautorisation));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
        }          
}
