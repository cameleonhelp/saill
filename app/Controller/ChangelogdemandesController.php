<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Changelogdemandes Controller
 *
 * @property Changelogdemande $Changelogdemande
 * @property PaginatorComponent $Paginator
 */
class ChangelogdemandesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Changelogversion.VERSION'=>'asc','Changelogdemande.id'=>'desc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($changelog=null,$all=null,$criticite=null,$etat=null,$type=null) {
            $this->set('title_for_layout','Liste des changements demandés');
            switch($changelog):
                case '1';
                    $conditions[]="Changelogdemande.OPEN=0";
                    $conditions[]="Changelogversion.ETAT=1";
                    unset($this->paginate['order']);
                    $this->paginate = array('order'=>array('Changelogversion.VERSION'=>'desc','Changelogdemande.TYPE'=>'asc'));                    
                    break;
                case '2':
                    $conditions[]="Changelogversion.ETAT=0";
                    $conditions[]="Changelogdemande.changelogversion_id is not null";                    
                    break;
                default:
                    if (userAuth('profil_id')>1) :
                        $conditions[]="Changelogdemande.utilisateur_id=".userAuth('id');
                    endif;   
                    $conditions[]= isset($all) && $all=='1' ? "Changelogdemande.OPEN=1" : "Changelogversion.ETAT=0";
                    unset($this->paginate['order']);                   
                    $this->paginate = array('order'=>array('Changelogdemande.OPEN'=>'desc','Changelogversion.VERSION'=>'asc','Changelogdemande.TYPE'=>'asc'));
            endswitch;
                switch($criticite):
                    case null:
                    case 'tous':
                        $conditions[]="1=1";
                        break;
                    default:
                        $conditions[]="Changelogdemande.CRITICITE=".$criticite;
                        break;
                endswitch;
                switch($etat):
                    case null:
                    case 'tous':
                        $conditions[]="1=1";
                        break;
                    default:
                        $conditions[]="Changelogdemande.ETAT=".$etat;
                        break;
                endswitch;
                switch($type):
                    case null:
                    case 'tous':
                        $conditions[]="1=1";
                        break;
                    default:
                        $conditions[]="Changelogdemande.TYPE=".$type;
                        break;
                endswitch;                
		$this->Changelogdemande->recursive = 1;
                $this->paginate = isset($conditions) ? array_merge_recursive($this->paginate,array('conditions'=>$conditions)) : $this->paginate;
		if($changelog==1):
                    $this->paginate = array('limit'=>$this->Changelogdemande->find('count'));
                endif;
                $this->set('changelogdemandes', $this->paginate());
                $this->set('datereelle', $this->paginate());
                $changelogetats = Configure::read('changelogEtatDemande');  
                $changelogtypes = Configure::read('changelogType');  
                $changelogcriticites = Configure::read('changelogCriticite'); 
                $nextversion = $this->Changelogdemande->requestAction('changelogversions/getnextversion');
		$this->set(compact('changelogetats','changelogtypes','changelogcriticites','nextversion')); 
                $export = $this->Changelogdemande->find('all',array('conditions'=>$conditions,'order'=>array('Changelogversion.VERSION'=>'asc','Changelogdemande.id'=>'desc'),'recursive'=>0));
                $this->Session->delete('xls_export');
                $this->Session->write('xls_export',$export);  
	}
        
        public function changelog(){
            $this->index('1');
            $versions = $this->requestAction('changelogversions/get_all_close');
            $this->set(compact('versions'));
        }
        
        public function listetodo(){
            $this->index('2');
        }        

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {        
		if (!$this->Changelogdemande->exists($id)) {
			throw new NotFoundException(__('Invalid changelogdemande'));
		}
		$options = array('conditions' => array('Changelogdemande.' . $this->Changelogdemande->primaryKey => $id));
		$this->set('changelogdemande', $this->Changelogdemande->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Demande de changement dans SAILL');
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Changelogdemande->validate = array();
                        $this->History->goBack(1);
                    else:                       
			$this->Changelogdemande->create();
			if ($this->Changelogdemande->save($this->request->data)) {
                                $obj = $this->Changelogdemande->find('first',array('conditions'=>array('Changelogdemande.id'=>$this->Changelogdemande->getInsertID())));
                                $this->sendmail($obj);
				$this->Session->setFlash(__('Demande sauvegardée',true),'flash_success');
			} else {
				$this->Session->setFlash(__('Demande incorrecte, veuillez corriger la demande',true),'flash_failure');
			}
                        return $this->redirect(array('action' => 'index',0,1));
                    endif;
		}
                $changelogetats = Configure::read('changelogEtatDemande');  
                $changelogtypes = Configure::read('changelogType');  
                $changelogcriticites = Configure::read('changelogCriticite');  
		$changelogversions = $this->Changelogdemande->Changelogversion->find('list');
		$utilisateurs = $this->Changelogdemande->Utilisateur->find('list');
		$this->set(compact('changelogversions', 'utilisateurs','changelogetats','changelogtypes','changelogcriticites'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            $this->set('title_for_layout','Mise à jour de votre demande de changement dans SAILL');
		if (!$this->Changelogdemande->exists($id)) {
			throw new NotFoundException(__('Invalid changelogdemande'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Changelogdemande->validate = array();
                        $this->History->goBack(1);
                    else:                       
			if ($this->Changelogdemande->save($this->request->data)) {
                                $obj = $this->Changelogdemande->find('first',array('conditions'=>array('Changelogdemande.id'=>$id)));
                                $this->sendmail($obj);                            
				$this->Session->setFlash(__('Demande sauvegardée',true),'flash_success');
			} else {
				$this->Session->setFlash(__('Demande incorrecte, veuillez corriger la demande',true),'flash_failure');
			}
                        return $this->redirect(array('action' => 'index',0,1));
                    endif;
		} else {
			$options = array('conditions' => array('Changelogdemande.' . $this->Changelogdemande->primaryKey => $id));
			$this->request->data = $this->Changelogdemande->find('first', $options);
		}
		$changelogversions = $this->Changelogdemande->Changelogversion->find('list');
		$utilisateurs = $this->Changelogdemande->Utilisateur->find('list');
                $changelogreponses = $this->requestAction('changelogreponses/get_all_reponses/'.$id);
		$this->set(compact('changelogversions', 'utilisateurs','changelogreponses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Changelogdemande->id = $id;
		if (!$this->Changelogdemande->exists()) {
			throw new NotFoundException(__('Invalid changelogdemande'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Changelogdemande->delete()) {
			$this->Session->setFlash(__('Demande supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Demande <b>NON</b> supprimée',true),'flash_failure');
		}
		return $this->redirect(array('action' => 'index',0,1));
	}
        
        public function ajax_changeetat($id=null){
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;
                $this->Changelogdemande->id = $newid;
                $obj = $this->Changelogdemande->find('first',array('conditions'=>array('Changelogdemande.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Changelogdemande']['OPEN'] == 1 ? 0 : 1;
                $etat = $newactif == 0 ? 4 : 0;
                if ($this->Changelogdemande->saveField('OPEN',$newactif) && $this->Changelogdemande->saveField('ETAT',$etat)) {
                        if ($id==null):
                            $this->Session->setFlash(__('Modification de l\'état de la demande prise en compte',true),'flash_success');
                        else:
                            $result = true;
                        endif;
                } else {
                        if ($id==null):
                            $this->Session->setFlash(__('Modification de l\'état de la demande <b>NON</b> prise en compte',true),'flash_failure');
                        else:
                            $result = false;
                        endif;
                }
		if ($id==null):
                    exit();
                else:
                    return $result;
                endif;
        }   
        
        public function get_info($id){
            $obj = $this->Changelogdemande->find('first',array('conditions'=>array('Changelogdemande.id'=>$id),'recursive'=>1));
            return $obj;
        }
        
        public function sendmail($obj){
            $valideurs = $this->requestAction('parameters/get_developpeur');
            $to = explode(';', $valideurs['Parameter']['param']);
            $from = userAuth('MAIL');
            $objet = 'SAILL : Ajout de la demande de changement n°'.' [C-'.  strYear($obj['Changelogdemande']['created']).'-'.$obj['Changelogdemande']['id'].']';
            $message = "Merci de traiter la demande suivante: ".
                    '<ul>
                    <li>Demande :'.$obj['Changelogdemande']['DEMANDE'].'</li>     
                    </ul>';
            if(count($to) > 0):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($from)
                        ->to($to)
                        ->subject($objet)
                        ->send($message);
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
        }
        
        public function close($id){
            $sql = "UPDATE changelogdemandes SET DATEREELLE='".date('Y-m-d H:i:s')."' WHERE changelogversion_id=".$id;
            $this->Changelogdemande->query($sql);
        }
        
        public function open($id){
            $sql = "UPDATE changelogdemandes SET DATEREELLE=NULL WHERE changelogversion_id=".$id;
            $this->Changelogdemande->query($sql);
        }     
        
	function export_xls() {
                $changelogetats = Configure::read('changelogEtatDemande');  
                $changelogtypes = Configure::read('changelogType');  
                $changelogcriticites = Configure::read('changelogCriticite'); 
		$this->set(compact('changelogetats','changelogtypes','changelogcriticites')); 
		$data = $this->Session->read('xls_export');               
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}          
}
