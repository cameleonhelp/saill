<?php
App::uses('AppController', 'Controller');
/**
 * Activitesreelles Controller
 *
 * @property Activitesreelle $Activitesreelle
 */
class ActivitesreellesController extends AppController {

        public $paginate = array(
        //'limit' => 15,
        //'threaded',
        'order' => array('Activitesreelle.utilisateur_id' => 'asc','Activitesreelle.DATE' => 'desc'),
        //'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),
        );
        
/**
 * index method
 *
 * @return void
 */
	public function index($etat=null,$utilisateur=null,$mois=null) {
                switch ($etat){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fetat = "toutes les feuilles de temps";
                        break;
                    case 'actif':
                    case null:
                        $newconditions[]="Activitesreelle.VEROUILLE = 1";
                        $fetat = "toutes les feuilles de temps actives";
                        break;                    
                    case 'facture':
                        $newconditions[]="Activitesreelle.VEROUILLE = 0";
                        $fetat = "toutes les feuilles de temps facturées";
                        break;                      
                }  
                $this->set('fetat',$fetat);                 
                switch ($utilisateur){
                    case 'tous':
                    case null:
                        $newconditions[]="1=1";
                        $futilisateur = "tous les utilisateurs";
                        break;
                    default:
                        $newconditions[]="Activitesreelle.utilisateur_id = ".$utilisateur;
                        $utilisateur = $this->Activitesreelle->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$utilisateur)));
                        $futilisateur = $utilisateur['Utilisateur']['NOMLONG'];
                        break;                      
                }  
                $this->set('futilisateur',$futilisateur);
                switch ($mois){
                    case 'tous':
                    case null:
                        $newconditions[]="1=1";
                        $fperiode = "";
                        break;
                    default:
                        $annee = date('Y');
                        $dernierjour = date('t', mktime(0, 0, 0, $mois, 5, $annee));
                        $datedebut = $annee."-".$mois."-01";
                        $datefin = $annee."-".$mois."-".$dernierjour;
                        $newconditions[]="Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                        $moiscal = array('01'=>"janvier",'02'=>"février",'03'=>"mars",'04'=>"avril",'05'=>"mai",'06'=>"juin",'07'=>"juillet",'08'=>"août",'09'=>"septembre",'10'=>"octobre",'11'=>"novembre",'12'=>"décembre",);
                        $fperiode = "pour le mois de ".$moiscal[$mois];
                        break;                      
                }  
                $this->set('fperiode',$fperiode);                
                $this->set('title_for_layout','Feuilles de temps');
                $utilisateurs = $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
                $this->set('utilisateurs',$utilisateurs);
                $group = $this->Activitesreelle->find('all',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Activitesreelle.DATE) AS NBACTIVITE'),'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'order'=>array('Activitesreelle.utilisateur_id' => 'asc','Activitesreelle.DATE' => 'desc')));
                $this->set('groups',$group);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                 
		$this->Activitesreelle->recursive = 0;
		$this->set('activitesreelles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->set('title_for_layout','Feuilles de temps');            
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
		$this->set('activitesreelle', $this->Activitesreelle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($utilisateur_id=null,$action_id=null) {
                $this->set('title_for_layout','Feuilles de temps');            
		if ($this->request->is('post')) {
                        if ($utilisateur_id!=null) $this->request->data['Activitesreelle']['utilisateur_id']=$utilisateur_id ;
                        $this->request->data['Activitesreelle']['action_id']=$action_id;
                        if ($this->ActiviteExists($this->request->data['Activitesreelle']['utilisateur_id'], $this->request->data['Activitesreelle']['DATE'], $this->request->data['Activitesreelle']['activite_id']) > 0){
                            $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                            $this->redirect(array('action' => 'edit',$this->ActiviteExists($this->request->data['Activitesreelle']['utilisateur_id'], $this->request->data['Activitesreelle']['DATE'], $this->request->data['Activitesreelle']['activite_id'])));
                        }
			$this->Activitesreelle->create();
                        if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('Feuille de temps créée'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'edit',$this->Activitesreelle->getLastInsertID()));
			} else {
				$this->Session->setFlash(__('Feuille de temps incorrecte, veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
			}
		}
                $condition=array("1=1");
                if ($action_id != null) {
                    $condition = ('Activite.projet_id > 1');
                }
                $activites = $this->Activitesreelle->Activite->find('list',array('fields'=>array('id','NOM'),'conditions'=>$condition));
		$this->set('activites', $activites);
		$utilisateurs = $this->Activitesreelle->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.id>1')));
		$this->set('utilisateurs', $utilisateurs);
                if ($action_id != null) {
                $action = $this->Activitesreelle->Action->find('first',array('conditions'=>array('Action.id'=>$action_id)));
                    $this->request->data['Activitesreelle']['utilisateur_id'] = $action['Action']['utilisateur_id'];
                    $this->request->data['Activitesreelle']['DATE'] = $action['Action']['DEBUT'];
                    $this->request->data['Activitesreelle']['activite_id'] = $action['Action']['activite_id'];
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
                $this->set('title_for_layout','Feuilles de temps');            
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('Feuille de temps sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Feuille de temps incorrecte veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
			$this->request->data = $this->Activitesreelle->find('first', $options);
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
                $this->set('title_for_layout','Feuilles de temps');            
		$this->Activitesreelle->id = $id;
		if (!$this->Activitesreelle->exists()) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Activitesreelle->delete()) {
				$this->Session->setFlash(__('Feuille de temps supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
				$this->Session->setFlash(__('Feuille de temps <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * duplicate method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function duplicate($id = null) {
                $this->set('title_for_layout','Feuilles de temps');  
                $this->Activitesreelle->id = $id;
                $record = $this->Activitesreelle->read();
                $date = $record['Activitesreelle']['DATE'];
                unset($record['Activitesreelle']['id']);
                unset($record['Activitesreelle']['DATE']);
                unset($record['Activitesreelle']['created']);                
                unset($record['Activitesreelle']['modified']);
                $date = new DateTime($this->Activitesreelle->CUSDate($date));
                $date->add(new DateInterval('P7D'));                
                $record['Activitesreelle']['DATE'] = $date->format('d/m/Y');
                if ($this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id']) > 0){
                    $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                    $this->redirect(array('action' => 'edit',$this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id'])));
                }                
                $this->Activitesreelle->create();
                if ($this->Activitesreelle->save($record)) {
                        $this->Session->setFlash(__('Feuille de temps dupliquée'),'default',array('class'=>'alert alert-success'));
                        $this->redirect(array('action' => 'edit',$this->Activitesreelle->getLastInsertID()));
                } 
		$this->Session->setFlash(__('Feuille de temps <b>NON</b> dupliqué'),'default',array('class'=>'alert alert-error'));            
	}  
        
/**
 * autoduplicate method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function autoduplicate($id = null) {
                $this->set('title_for_layout','Feuilles de temps');  
                $this->Activitesreelle->id = $id;
                $record = $this->Activitesreelle->read();
                $date = $record['Activitesreelle']['DATE'];
                unset($record['Activitesreelle']['id']);
                unset($record['Activitesreelle']['DATE']);
                unset($record['Activitesreelle']['created']);                
                unset($record['Activitesreelle']['modified']);
                $date = new DateTime($this->Activitesreelle->CUSDate($date));
                $date->add(new DateInterval('P7D'));                
                $record['Activitesreelle']['DATE'] = $date->format('d/m/Y');
                if ($this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id']) > 0){
                    $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                    $this->redirect($this->goToPostion());
                }                
                $this->Activitesreelle->create();
                if ($this->Activitesreelle->save($record)) {
                    $this->Session->setFlash(__('Feuille de temps dupliquée'),'default',array('class'=>'alert alert-success'));
                    $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Feuille de temps <b>NON</b> dupliqué'),'default',array('class'=>'alert alert-error'));            
	}   
        
/**
 * updatefacturation method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function updatefacturation($id = null) {
                $this->set('title_for_layout','Feuilles de temps');  
                $this->Activitesreelle->id = $id;
                $record = $this->Activitesreelle->read();
                unset($record['Activitesreelle']['created']);                
                unset($record['Activitesreelle']['modified']);
                $record['Activitesreelle']['created'] = $this->Activitesreelle->read('created');
                $record['Activitesreelle']['modified'] = date('Y-m-d');                 
                $record['Activitesreelle']['VEROUILLE'] = 0;
                $this->Activitesreelle->create();
                if ($this->Activitesreelle->save($record)) {
                    $this->Session->setFlash(__('Feuille de temps mise à jour pour facturation'),'default',array('class'=>'alert alert-success'));
                    $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Feuille de temps <b>NON</b> mise à jour pour facturation'),'default',array('class'=>'alert alert-error'));            
	}           
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $this->set('title_for_layout','feuilles de temps');
                $keyword=$this->params->data['Activitesreelle']['SEARCH']; 
                $newconditions = array('OR'=>array("Activite.NOM LIKE '%".$keyword."%'","Action.OBJET LIKE '%".$keyword."%'"));
                $group = $this->Activitesreelle->find('all',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Activitesreelle.DATE) AS NBACTIVITE'),'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'order'=>array('Activitesreelle.utilisateur_id' => 'asc','Activitesreelle.DATE' => 'desc'),'conditions'=>$newconditions));
                $this->set('groups',$group);                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Activitesreelle->recursive = 0;
                $this->set('activitesreelles', $this->paginate());              
                $this->render('index');
        }          
        
/**
 * ActiviteExists method
 * 
 * @param type $utilisateurId
 * @param type $date
 * @param type $activite
 * @return l'id de l'activité si elle existe
 */        
        public function ActiviteExists($utilisateurId, $date, $activite){
            $allActivite = $this->Activitesreelle->find('first',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateurId,'Activitesreelle.activite_id'=>$activite,'Activitesreelle.DATE'=>$this->Activitesreelle->CUSDate($this->Activitesreelle->debutsem($date)))));
            return isset($allActivite['Activitesreelle']) ? $allActivite['Activitesreelle']['id'] : 0;
        }        
}
