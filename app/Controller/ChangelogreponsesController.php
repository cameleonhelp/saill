<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Controller', 'Changelogdemandes');
App::import('Controller', 'Changelogversions');
App::import('Controller', 'Utilisateurs');
/**
 * Changelogreponses Controller
 *
 * @property Changelogreponse $Changelogreponse
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class ChangelogreponsesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('order'=>array('Changelogreponse.created'=>'asc'));
	public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Réponse à votre demande de changement" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }            
        
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Changelogreponse->recursive = 0;
		$this->set('changelogreponses', $this->paginate());
	}
        
        public function beforeFilter() {   
            $this->Auth->allow(array('json_get_info'));
            parent::beforeFilter();
        }  
        
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Changelogdemande->validate = array();
                        $this->History->goBack(1);
                    endif;
		}                
                //$id = demande_id
                $this-set_title('Liste des réponses');
                $changelogreponses = $this->get_all_reponses($id);
                $ObjChangelogdemandes = new ChangelogdemandesController();	
                $changelogdemande = $ObjChangelogdemandes->get_info($id);
		$this->set(compact('changelogreponses','changelogdemande'));
                $changelogetats = Configure::read('changelogEtatDemande');  
                $changelogtypes = Configure::read('changelogType');  
                $changelogcriticites = Configure::read('changelogCriticite');  
		$this->set(compact('changelogetats','changelogtypes','changelogcriticites'));                   
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id) {
            $this->set_title('Répondre à une demande');
                $ObjChangelogdemandes = new ChangelogdemandesController();
                $ObjChangelogversions = new ChangelogversionsController();            
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Changelogreponse->validate = array();
                        //return $this->redirect(array('controller'=>'changelogdemandes','action' => 'index',0,1));
                        $this->History->goBack(1);
                    else:              
                        if($this->request->data['Changelogreponse']['REPONSE']!=''):
                            $this->Changelogreponse->create();
                            if ($this->Changelogreponse->save($this->request->data)) {
                                    $this->Session->setFlash(__('Réponse sauvegardée',true),'flash_success');
                            } else {
                                    $this->Session->setFlash(__('Réponse incorrecte, veuillez corriger la réponse',true),'flash_failure');
                            }
                        endif;

                        $this->Changelogreponse->Changelogdemande->id = $id;
                        $this->Changelogreponse->Changelogdemande->saveField('ETAT', $this->request->data['Changelogreponse']['ETAT']);
                        $this->Changelogreponse->Changelogdemande->saveField('TYPE', $this->request->data['Changelogreponse']['TYPE']);
                        $this->Changelogreponse->Changelogdemande->saveField('CRITICITE', $this->request->data['Changelogreponse']['CRITICITE']);
                        if($this->request->data['Changelogreponse']['ETAT']== 2 || $this->request->data['Changelogreponse']['ETAT']== 4 ):
                            $this->Changelogreponse->Changelogdemande->saveField('OPEN', 0);
                        endif;
                        if($this->request->data['Changelogreponse']['DATEPREVUE']!= ''):
                            $this->Changelogreponse->Changelogdemande->saveField('DATEPREVUE', $this->request->data['Changelogreponse']['DATEPREVUE']);
                        else:
                            $this->Changelogreponse->Changelogdemande->saveField('DATEPREVUE', NULL);
                        endif;                        
                        if($this->request->data['Changelogreponse']['CRITICITE']!=''):
                            $this->Changelogreponse->Changelogdemande->saveField('changelogversion_id', $this->request->data['Changelogreponse']['version_id']);
                        endif;                            
                        $demande = $ObjChangelogdemandes->get_info($id);
                        if(in_array($this->request->data['Changelogreponse']['ETAT'],array('0','2','4'))) : $this->sendmail($demande); endif;
                        //return $this->redirect(array('controller'=>'changelogdemandes','action' => 'index',0,1));
                        $this->History->goBack(2);
                    endif;
		}
                $changelogetats = Configure::read('changelogEtatDemande');  
                $changelogtypes = Configure::read('changelogType');  
                $changelogcriticites = Configure::read('changelogCriticite');  
		$this->set(compact('changelogetats','changelogtypes','changelogcriticites'));                    
		$changelogdemande = $ObjChangelogdemandes->get_info($id);
                $changelogversions = $ObjChangelogversions->get_select_open();
                $changelogreponses = $this->get_all_reponses($id);
		$this->set(compact('changelogdemande','changelogversions','changelogreponses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Changelogreponse->exists($id)) {
			throw new NotFoundException(__('Invalid changelogreponse'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Changelogreponse->save($this->request->data)) {
				$this->Session->setFlash(__('The changelogreponse has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The changelogreponse could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Changelogreponse.' . $this->Changelogreponse->primaryKey => $id));
			$this->request->data = $this->Changelogreponse->find('first', $options);
		}
		$changelogdemandes = $this->Changelogreponse->Changelogdemande->find('list');
		$utilisateurs = $this->Changelogreponse->Utilisateur->find('list');
		$this->set(compact('changelogdemandes', 'utilisateurs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Changelogreponse->id = $id;
		if (!$this->Changelogreponse->exists()) {
			throw new NotFoundException(__('Invalid changelogreponse'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Changelogreponse->delete()) {
			$this->Session->setFlash(__('The changelogreponse has been deleted.'));
		} else {
			$this->Session->setFlash(__('The changelogreponse could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function get_all_reponses($id){
            $objs = $this->Changelogreponse->find('all',array('conditions'=>array('Changelogreponse.changelogdemande_id'=>$id),'order'=>array('Changelogreponse.created'=>'desc'),'recursive'=>0));
            return $objs;
        }
        
        public function json_get_info($id){
            $this->autoRender = false;
            $conditions[] = 'Changelogreponse.id='.$id;
            $result = $this->Changelogreponse->find('first',array('conditions'=>$conditions,'recursive'=>-1));
            return json_encode($result);
        }
        
        public function ajaxedit(){
            $this->autoRender = false;
            $this->Changelogreponse->id = $this->request->data('id');
            if ($this->Changelogreponse->saveField('REPONSE',$this->request->data('memo'))) {
                    $this->Session->setFlash(__('Réponse sauvegardée',true),'flash_success');
                    $this->History->notmove();
            } else {
                    $this->Session->setFlash(__('Réponse incorrecte, veuillez corriger la réponse',true),'flash_failure');
            }
        }
        
        public function updateresponses ($version_id,$date){
            $conditions=array('Changelogdemande.changelogversion_id'=>$version_id,'Changelogdemande.OPEN'=>1);
            $reponses = $this->Changelogreponse->Changelogdemande->find('all',array('conditions'=>$conditions,'recursive'=>-1));
            foreach($reponses as $reponse):
                $this->Changelogreponse->Changelogdemande->id = $reponse['Changelogdemande']['id'];
                $this->Changelogreponse->Changelogdemande->saveField('DATEPREVUE', $date);
            endforeach;
        }
        
        public function sendmail($obj){
            $reponses = '';
            $tmpreponses = $this->get_all_reponses($obj['Changelogdemande']['id']);          
            foreach($tmpreponses as $tmpreponse):
                $reponses .= '<li>'.$tmpreponse['Changelogreponse']['created'].' - '.$tmpreponse['Changelogreponse']['REPONSE'].'</li>';
            endforeach;
            $changelogetats = Configure::read('changelogEtatDemande');  
            $ObjUtilisateurs = new UtilisateursController();
            $demandeur = $ObjUtilisateurs->get_mail($obj['Changelogdemande']['utilisateur_id']);           
            $to =$demandeur[0];
            $from = Configure::read('mailapp');
            $objet = 'SAILL : Réponse à la demande de changement n°'.' [C-'.  strYear($obj['Changelogdemande']['created']).'-'.$obj['Changelogdemande']['id'].']';
            $message = "Voici la réponse à la demande : ".
                    '<ul>
                    <li>Statut : '.$changelogetats[$obj['Changelogdemande']['ETAT']].'</li>
                    <li>Prévu en version : '.$obj['Changelogversion']['VERSION'].'</li>
                    <li>Livraison prévue le : '.$obj['Changelogversion']['DATEPREVUE'].'</li>
                    <li>Demande : '.$obj['Changelogdemande']['DEMANDE'].'</li>  
                    <li>Réponses : <ul>'.$reponses.'</ul></li>
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
}
