<?php
App::uses('AppController', 'Controller');
/**
 * Utilisateurs Controller
 *
 * @property Utilisateur $Utilisateur
 */
class UtilisateursController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Utilisateur.NOM' => 'asc','Utilisateur.PRENOM' => 'asc'),
        'conditions'=>array('Utilisateur.id >'=> 1),
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Utilisateur->recursive = 0;
		$this->set('utilisateurs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Utilisateur->exists($id)) {
			throw new NotFoundException(__('Utilisateur incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Utilisateur.' . $this->Utilisateur->primaryKey => $id));
		$this->set('utilisateur', $this->Utilisateur->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $societe = $this->Utilisateur->Societe->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('societe',$societe);
                if ($this->request->is('post')) {
			$this->Utilisateur->create();
			if ($this->Utilisateur->save($this->request->data)) {
				$this->Session->setFlash(__('Utilisateur sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Utilisateur incorrect, veuillez corriger l\'utilisateur'),true,array('class'=>'alert alert-error'));
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
                $societe = $this->Utilisateur->Societe->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('societe',$societe);
                $section = $this->Utilisateur->Section->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('section',$section);
                $hierarchique = $this->Utilisateur->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG'),'order'=>array('NOMLONG'=>'asc'),'conditions'=>array('HIERARCHIQUE'=>1)));
                $this->set('hierarchique',$hierarchique);
                $profil = $this->Utilisateur->Profil->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('profil',$profil);
                $assistance = $this->Utilisateur->Assistance->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('assistance',$assistance);                
                $site = $this->Utilisateur->Site->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('site',$site);
                $domaine = $this->Utilisateur->Domaine->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('domaine',$domaine);
                $tjmagent = $this->Utilisateur->Tjmagent->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('tjmagent',$tjmagent);  
                $outil = $this->Utilisateur->Outil->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('outil',$outil);  
                $listediffusion = $this->Utilisateur->Listediffusion->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('listediffusion',$listediffusion);
                $dossierpartage = $this->Utilisateur->Dossierpartage->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('dossierpartage',$dossierpartage);
                $activite = $this->Utilisateur->Activite->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('activite',$activite);
                $workcapacite = Configure::read('workCapacity');
                $this->set('workcapacite',$workcapacite);
                $affectations = $this->Utilisateur->Affectation->find('all',array('fields'=>array('id','activite_id','Activite.NOM'),'conditions'=>array('Affectation.utilisateur_id'=>$id)));
                $this->set('affectations',$affectations);
                $dotations = $this->Utilisateur->Dotation->find('all',array('fields'=>array('id','materielinformatique_id','Materielinformatique.NOM','materielautre_id','Typemateriel.NOM'),'conditions'=>array('Dotation.utilisateur_id'=>$id)));
                $this->set('dotations',$dotations);
                $utiliseoutils = $this->Utilisateur->Utiliseoutil->find('all',array('fields'=>array('id','outil_id','Outil.NOM','listediffusion_id','Listediffusion.NOM','dossierpartage_id','Dossierpartage.NOM'),'conditions'=>array('Utiliseoutil.utilisateur_id'=>$id)));
                $this->set('utiliseoutils',$utiliseoutils);
                if (!$this->Utilisateur->exists($id)) {
			throw new NotFoundException(__('Utilisateur incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Utilisateur->save($this->request->data)) {
				$this->Session->setFlash(__('Utilisateur sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Utilisateur incorrect, veuillez corriger l\'utilisateur'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Utilisateur.' . $this->Utilisateur->primaryKey => $id));
			$this->request->data = $this->Utilisateur->find('first', $options);
                        $this->set('utilisateur', $this->Utilisateur->find('first', $options));
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
		$this->Utilisateur->id = $id;
		if (!$this->Utilisateur->exists()) {
			throw new NotFoundException(__('Utilisateur incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Utilisateur->delete()) {
			$this->Session->setFlash(__('Utilisateur supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Utilisateur <b>NON</b> supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * profil method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function profil($id = null) {
                $this->set('title_for_layout',"Mon profils");
                $societe = $this->Utilisateur->Societe->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('societe',$societe);
         }  
        
/**
 * logout method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
	public function logout() {
            $this->set('title_for_layout',"Déconnexion");
        }  
        
/**
 * dupliquer method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function dupliquer($id = null) {
		$this->Utilisateur->id = $id;
                $record = $this->Utilisateur->read();
                unset($record['Utilisateur']['id']);
                unset($record['Utilisateur']['COMMENTAIRE']);
                $this->Utilisateur->create();
                if ($this->Utilisateur->saveAll($record)) {
                        $this->Session->setFlash(__('Utilisateur dupliqué'),true,array('class'=>'alert alert-success'));
                        $this->redirect(array('action' => 'index'));
                } 
		$this->Session->setFlash(__('Utilisateur <b>NON</b> dupliqué'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}          
}
