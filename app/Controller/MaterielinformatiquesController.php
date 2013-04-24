<?php
App::uses('AppController', 'Controller');
/**
 * Materielinformatiques Controller
 *
 * @property Materielinformatique $Materielinformatique
 */
class MaterielinformatiquesController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Materielinformatique.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index($filtreetat=null,$filtretype=null,$filtresection=null) {
            $this->Session->delete('history');
            if (isAuthorized('materielinformatiques', 'index')) :
                switch ($filtreetat){
                    case 'tous':
                    case null:    
                        $newconditions[]="1=1";
                        $fetat = "de tous les états";
                        break;
                    default :
                        $newconditions[]="Materielinformatique.ETAT='".$filtreetat."'";
                        $fetat = "étant '".$filtreetat."'";                        
                }    
                $this->set('fetat',$fetat); 
                switch ($filtretype){
                    case 'tous':
                    case null:    
                        $newconditions[]="1=1";
                        $ftype = "tous les types de matériel";
                        break;
                    default :
                        $newconditions[]="Typemateriel.NOM='".$filtretype."'";
                        $ftype = "type de matériel '".$filtretype."'";                        
                }    
                $this->set('ftype',$ftype); 
                switch ($filtresection){
                    case 'toutes':
                    case null:    
                        $newconditions[]="1=1";
                        $fsection = "toutes les sections";
                        break;
                    default :
                        $newconditions[]="Section.id='".$filtresection."'";
                        $nomsection = $this->Materielinformatique->Section->find('first',array('conditions'=>array('Section.id'=>$filtresection),'recursive'=>-1));
                        $fsection = "la section ".$nomsection['Section']['NOM'];                        
                }    
                $this->set('fsection',$fsection);                 
                $this->set('title_for_layout','Postes informatique');
                if (userAuth('WIDEAREA')==0) {$newconditions[]="Materielinformatique.section_id=".userAuth('section_id');}                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Materielinformatique->recursive = 0;
		$this->set('materielinformatiques', $this->paginate());
                $this->Session->delete('xls_export');
                $this->Materielinformatique->recursive = 0;
                $export = $this->Materielinformatique->find('all',array('conditions'=>$newconditions,'order' => array('Materielinformatique.NOM' => 'asc')));
                $this->Session->write('xls_export',$export); 
                $this->Materielinformatique->recursive = -1;
                $etats = $this->Materielinformatique->find('all',array('fields' => array('ETAT'),'group'=>'ETAT','order'=>array('ETAT'=>'asc')));
                $this->set('etats',$etats); 
                $this->Materielinformatique->recursive = 0;
                $types = $this->Materielinformatique->find('all',array('fields' => array('Typemateriel.NOM'),'group'=>'Typemateriel.NOM','order'=>array('Typemateriel.NOM'=>'asc')));
                $this->set('types',$types);    
                if (userAuth('WIDEAREA')==0) {
                   $sections = $this->Materielinformatique->Section->find('all',array('fields' => array('Section.id','Section.NOM'),'conditions'=>array('Section.id'=>userAuth('section_id')),'recursive'=>0));
                } else {
                   $sections = $this->Materielinformatique->Section->find('all',array('fields' => array('Section.id','Section.NOM'),'group'=>'Section.NOM','order'=>array('Section.NOM'=>'asc'),'recursive'=>0));
                }
                $this->set('sections',$sections);  
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
            if (isAuthorized('materielinformatiques', 'view')) :
		$this->set('title_for_layout','Postes informatique');
                if (!$this->Materielinformatique->exists($id)) {
			throw new NotFoundException(__('Postes informatique incorrect'));
		}
		$options = array('conditions' => array('Materielinformatique.' . $this->Materielinformatique->primaryKey => $id));
		$this->set('materielinformatique', $this->Materielinformatique->find('first', $options));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('materielinformatiques', 'add')) :
                $this->Materielinformatique->Typemateriel->recursive = -1;
                $peripherique = $this->Materielinformatique->Typemateriel->find('list',array('fields' => array('id', 'NOM'),'conditions'=>array('id <'=>3)));
                $this->set('peripherique',$peripherique); 
                $this->Materielinformatique->Section->recursive = -1;
                $section = $this->Materielinformatique->Section->find('list',array('fields' => array('id', 'NOM')));
                $this->set('section',$section); 
                $this->Materielinformatique->Assistance->recursive = -1;
                $assistance = $this->Materielinformatique->Assistance->find('list',array('fields' => array('id', 'NOM')));
                $this->set('assistance',$assistance); 
                $etat = Configure::read('etatMaterielInformatique');
                $this->set('etat',$etat); 
                $this->set('title_for_layout','Postes informatique');
                if ($this->request->is('post')) :
			$this->Materielinformatique->create();
			if ($this->Materielinformatique->save($this->request->data)) {
				$this->Session->setFlash(__('Postes informatique sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Postes informatique incorrect, veuillez corriger le poste informatique'),'default',array('class'=>'alert alert-error'));
			}
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
            if (isAuthorized('materielinformatiques', 'edit')) :
		$this->set('title_for_layout','Postes informatique');
                $this->Materielinformatique->Typemateriel->recursive = -1;
                $peripherique = $this->Materielinformatique->Typemateriel->find('list',array('fields' => array('id', 'NOM'),'conditions'=>array('id <'=>3)));
                $this->set('peripherique',$peripherique); 
                $this->Materielinformatique->Section->recursive = -1;
                $section = $this->Materielinformatique->Section->find('list',array('fields' => array('id', 'NOM')));
                $this->set('section',$section); 
                $this->Materielinformatique->Assistance->recursive = -1;
                $assistance = $this->Materielinformatique->Assistance->find('list',array('fields' => array('id', 'NOM')));
                $this->set('assistance',$assistance); 
                $etat = Configure::read('etatMaterielInformatique');
                $this->set('etat',$etat); 
                if (!$this->Materielinformatique->exists($id)) {
			throw new NotFoundException(__('Postes informatique incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Materielinformatique->save($this->request->data)) {
				$this->Session->setFlash(__('Postes informatique sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Postes informatique incorrect, veuillez corriger le poste informatique'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Materielinformatique.' . $this->Materielinformatique->primaryKey => $id));
			$this->request->data = $this->Materielinformatique->find('first', $options);
                        $this->set('materielinformatique',$this->request->data);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
            if (isAuthorized('materielinformatiques', 'delete')) :
		$this->set('title_for_layout','Postes informatique');
                $this->Materielinformatique->id = $id;
		if (!$this->Materielinformatique->exists()) {
			throw new NotFoundException(__('Postes informatique incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Materielinformatique->delete()) {
			$this->Session->setFlash(__('Postes informatique supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Postes informatique <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('materielinformatiques', 'index')) :
                $this->set('title_for_layout','Postes informatique');
                $keyword=isset($this->params->data['Materielinformatique']['SEARCH']) ? $this->params->data['Materielinformatique']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Materielinformatique.NOM LIKE '%".$keyword."%'","Materielinformatique.ETAT LIKE '%".$keyword."%'","Materielinformatique.COMMENTAIRE LIKE '%".$keyword."%'","Assistance.NOM LIKE '%".$keyword."%'","Section.NOM LIKE '%".$keyword."%'","Typemateriel.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Materielinformatique->recursive = 0;
                $this->set('materielinformatiques', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Materielinformatique->find('all',array('conditions'=>$newconditions));
                $this->Session->write('xls_export',$export);                  
                $etats = $this->Materielinformatique->find('all',array('fields' => array('ETAT'),'group'=>'ETAT','order'=>array('ETAT'=>'asc')));
                $this->set('etats',$etats); 
                $types = $this->Materielinformatique->find('all',array('fields' => array('Typemateriel.NOM'),'group'=>'Typemateriel.NOM','order'=>array('Typemateriel.NOM'=>'asc')));
                $this->set('types',$types);    
                $sections = $this->Materielinformatique->find('all',array('fields' => array('Section.NOM'),'group'=>'Section.NOM','order'=>array('Section.NOM'=>'asc')));
                $this->set('sections',$sections);                 
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
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
        
/**
 * dupliquer method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function dupliquer($id = null) {
            if (isAuthorized('materielinformatiques', 'duplicate')) :
		$this->Materielinformatique->id = $id;
                $record = $this->Materielinformatique->read();
                unset($record['Materielinformatique']['id']);
                $record['Materielinformatique']['NOM']='_nouveau nom_';
                $record['Materielinformatique']['ETAT']='En stock';
                unset($record['Materielinformatique']['created']);                
                unset($record['Materielinformatique']['modified']);
                $this->Materielinformatique->create();
                if ($this->Materielinformatique->save($record)) {
                        $this->Session->setFlash(__('Poste informatique dupliqué'),'default',array('class'=>'alert alert-success'));
                        $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Poste informatique <b>NON</b> dupliqué'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}         
}
