<?php
App::uses('AppController', 'Controller');
/**
 * Livrables Controller
 *
 * @property Livrable $Livrable
 */
class LivrablesController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Livrable.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index($filtreChrono=null,$filtreEtat=null,$filtregestionnaire=null) {
                switch ($filtreChrono){
                    case 'toutes':
                        $newconditions[]="1=1";
                        $fchronologie = "tous les livrables";
                        break;
                    case 'previousweek':
                        $date = new DateTime();
                        $today = $date->sub(new DateInterval('P1W'));
                        $previousWeek = $date->sub(new DateInterval('P2W'));
                        $newconditions[]="Livrable.ECHEANCE BETWEEN '".$today->format('Y-m-d')."' AND '".$previousWeek->format('Y-m-d')."'";
                        $fchronologie = "tous les livrables de la semaine précédente";
                        break;  
                    case 'week':
                        $date = new DateTime();
                        $today = new DateTime();
                        $previousWeek = $date->sub(new DateInterval('P1W'));
                        $newconditions[]="Livrable.ECHEANCE BETWEEN '".$today->format('Y-m-d')."' AND '".$previousWeek->format('Y-m-d')."'";                        
                        $fchronologie = "tous les livrables de la semaine en cours";
                        break;  
                    case 'nextweek':
                        $date = new DateTime();
                        $today = $date->add(new DateInterval('P1W'));
                        $previousWeek = $date->add(new DateInterval('P2W'));
                        $newconditions[]="Livrable.ECHEANCE BETWEEN '".$today->format('Y-m-d')."' AND '".$previousWeek->format('Y-m-d')."'";                        
                        $fchronologie = "tous les livrables de la semaine suivante";
                        break;  
                    case 'tolate':
                        $date = new DateTime();
                        $previousWeek = $date;
                        $newconditions[]="Livrable.ECHEANCE > '".$previousWeek->format('Y-m-d')."' AND (Livrable.DATELIVRAISON = '0000-00-00' OR Livrable.DATELIVRAISON = NULL)";
                        $fchronologie = "tous les livrables en retards";
                        break;  
                    case 'incomplet':
                        $newconditions[]="Livrable.ECHEANCE IS NULL ";
                        $fchronologie = "tous les livrables en retards";
                        break;     
                }
                $this->set('fchronologie',$fchronologie); 
                switch ($filtreEtat){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fetat = "sans condition sur les états";
                        break;                      
                    case 'todo':
                        $newconditions[]="Livrable.ETAT = 'à faire'";
                        $fetat = "dont l'état est 'à faire'";
                        break;  
                    case 'inmotion':
                        $newconditions[]="Livrable.ETAT = 'en cours'";
                        $fetat = "dont l'état est 'en cours'";
                        break;  
                    case 'delivered':
                        $newconditions[]="Livrable.ETAT = 'livré'";
                        $fetat = "dont l'état est 'livré'";
                        break;  
                    case 'validated':
                        $newconditions[]="Livrable.ETAT = 'validé'";
                        $fetat = "dont l'état est 'validé'";
                        break;  
                    case 'notvalidated':
                        $newconditions[]="Livrable.ETAT != 'validé'";
                        $fetat = "dont l'état est autre que 'validé'";
                        break;                      
                    }    
                $this->set('fetat',$fetat);  
                switch ($filtregestionnaire){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fgestionnaire = "de tous les gestionnaires";
                        break;                      
                    default :
                        $newconditions[]="Livrable.utilisateur_id = '".$filtregestionnaire."'";
                        $nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array('Utilisateur.id'=> $filtregestionnaire)));
                        $fgestionnaire = "dont le gestionnaire est ".$nomlong['Utilisateur']['NOMLONG'];                     
                    }    
                $this->set('fgestionnaire',$fgestionnaire); 
                $gestionnaires = $this->Livrable->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('gestionnaires',$gestionnaires);                
		$this->Livrable->recursive = 0;
                  $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->set('livrables', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Livrable->exists($id)) {
			throw new NotFoundException(__('Livrable incorrect'),'default',array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Livrable.' . $this->Livrable->primaryKey => $id));
		$this->set('livrable', $this->Livrable->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $utilisateur = $this->Livrable->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('utilisateur',$utilisateur);
		if ($this->request->is('post')) {
			$this->Livrable->create();
			if ($this->Livrable->save($this->request->data)) {
				$this->Session->setFlash(__('Livrable sauvegardé'),'default',array('class'=>'alert alert-success'));
                                //enregistrer le suivilivrable
                                $suiviliv['Suivilivrable']['livrable_id']=$this->Livrable->id;
                                $suiviliv['Suivilivrable']['ECHEANCE']=$this->Livrable->ECHEANCE;
                                $suiviliv['Suivilivrable']['ETAT']=$this->Livrable->ETAT;
                                $suiviliv['Suivilivrable']['DATELIVRAISON']=$this->Livrable->DATELIVRAISON;
                                $suiviliv['Suivilivrable']['DATEVALIDATION']=$this->Livrable->DATEVALIDATION;                                
                                $this->Livrable->Suivilivrable->save($suiviliv);
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Livrable incorrect, veuillez corriger le livrable'),'default',array('class'=>'alert alert-error'));
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
                $etats = Configure::read('etatLivrable');
                $this->set('etats',$etats);             
                $utilisateur = $this->Livrable->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('utilisateur',$utilisateur);  
                $suivilivrables = $this->Livrable->Suivilivrable->find('all',array('conditions'=>array('Suivilivrable.livrable_id'=>$id),'order'=>array('Suivilivrable.created'=>'desc','Suivilivrable.id'=>'desc')));
                $this->set('Suivilivrables',$suivilivrables);                 
		if (!$this->Livrable->exists($id)) {
			throw new NotFoundException(__('Livrable incorrect'),'default',array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Livrable->save($this->request->data)) {
				$this->Session->setFlash(__('Livrable sauvegardé'),'default',array('class'=>'alert alert-success'));
                                //enregistrer le suivilivrable
                                $suiviliv['Suivilivrable']['livrable_id']=$this->Livrable->id;
                                $suiviliv['Suivilivrable']['ECHEANCE']=$this->Livrable->ECHEANCE;
                                $suiviliv['Suivilivrable']['ETAT']=$this->Livrable->ETAT;
                                $suiviliv['Suivilivrable']['DATELIVRAISON']=$this->Livrable->DATELIVRAISON;
                                $suiviliv['Suivilivrable']['DATEVALIDATION']=$this->Livrable->DATEVALIDATION;                                
                                $this->Livrable->Suivilivrable->save($suiviliv);
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Livrable incorrect, veuillez corriger le livrable'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Livrable.' . $this->Livrable->primaryKey => $id));
			$this->request->data = $this->Livrable->find('first', $options);
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
		$this->Livrable->id = $id;
		if (!$this->Livrable->exists()) {
			throw new NotFoundException(__('Livrable incorrect'),'default',array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Livrable->delete()) {
			$this->Session->setFlash(__('Livrable supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Livrable <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $keyword=$this->params->data['Livrable']['SEARCH']; 
                $newconditions = array('OR'=>array("Livrable.NOM LIKE '%".$keyword."%'","Livrable.REFERENCE LIKE '%".$keyword."%'","Utilisateur.NOM LIKE '%".$keyword."%'","Utilisateur.PRENOM LIKE '%".$keyword."%'","Suivilivrable.ETAT LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Livrable->recursive = 0;
                $this->set('livrables', $this->paginate());              
                $this->render('index'); 
        }           
}
