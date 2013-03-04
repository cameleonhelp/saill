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
	public function index($filtreetat,$filtretype,$filtresection) {
                switch ($filtreetat){
                    case 'tous':
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
                        $newconditions[]="1=1";
                        $fsection = "toutes les sections";
                        break;
                    default :
                        $newconditions[]="Section.NOM='".$filtresection."'";
                        $fsection = "la section ".$filtresection;                        
                }    
                $this->set('fsection',$fsection);                 
                $this->set('title_for_layout','Postes informatique');
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Materielinformatique->recursive = 0;
		$this->set('materielinformatiques', $this->paginate());
                $etats = $this->Materielinformatique->find('all',array('fields' => array('ETAT'),'group'=>'ETAT','order'=>array('ETAT'=>'asc')));
                $this->set('etats',$etats); 
                $types = $this->Materielinformatique->find('all',array('fields' => array('Typemateriel.NOM'),'group'=>'Typemateriel.NOM','order'=>array('Typemateriel.NOM'=>'asc')));
                $this->set('types',$types);    
                $sections = $this->Materielinformatique->find('all',array('fields' => array('Section.NOM'),'group'=>'Section.NOM','order'=>array('Section.NOM'=>'asc')));
                $this->set('sections',$sections);                 
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','Postes informatique');
                if (!$this->Materielinformatique->exists($id)) {
			throw new NotFoundException(__('Postes informatique incorrect'),'default',array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Materielinformatique.' . $this->Materielinformatique->primaryKey => $id));
		$this->set('materielinformatique', $this->Materielinformatique->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $peripherique = $this->Materielinformatique->Typemateriel->find('list',array('fields' => array('id', 'NOM'),'conditions'=>array('id <'=>3)));
                $this->set('peripherique',$peripherique);                
                $section = $this->Materielinformatique->Section->find('list',array('fields' => array('id', 'NOM')));
                $this->set('section',$section);  
                $assistance = $this->Materielinformatique->Assistance->find('list',array('fields' => array('id', 'NOM')));
                $this->set('assistance',$assistance); 
                $etat = Configure::read('etatMaterielInformatique');
                $this->set('etat',$etat); 
                $this->set('title_for_layout','Postes informatique');
                if ($this->request->is('post')) {
			$this->Materielinformatique->create();
			if ($this->Materielinformatique->save($this->request->data)) {
				$this->Session->setFlash(__('Postes informatique sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Postes informatique incorrect, veuillez corriger le poste informatique'),'default',array('class'=>'alert alert-error'));
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
		$this->set('title_for_layout','Postes informatique');
                $peripherique = $this->Materielinformatique->Typemateriel->find('list',array('fields' => array('id', 'NOM')));
                $this->set('peripherique',$peripherique);                
                $section = $this->Materielinformatique->Section->find('list',array('fields' => array('id', 'NOM')));
                $this->set('section',$section);  
                $assistance = $this->Materielinformatique->Assistance->find('list',array('fields' => array('id', 'NOM')));
                $this->set('assistance',$assistance); 
                $etat = Configure::read('etatMaterielInformatique');
                $this->set('etat',$etat); 
                if (!$this->Materielinformatique->exists($id)) {
			throw new NotFoundException(__('Postes informatique incorrect'),'default',array('class'=>'alert alert-error'));
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
		$this->set('title_for_layout','Postes informatique');
                $this->Materielinformatique->id = $id;
		if (!$this->Materielinformatique->exists()) {
			throw new NotFoundException(__('Postes informatique incorrect'),'default',array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Materielinformatique->delete()) {
			$this->Session->setFlash(__('Postes informatique supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Postes informatique <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $this->set('title_for_layout','Postes informatique');
                $keyword=$this->params->data['Materielinformatique']['SEARCH']; 
                $newconditions = array('OR'=>array("Materielinformatique.NOM LIKE '%".$keyword."%'","Materielinformatique.ETAT LIKE '%".$keyword."%'","Materielinformatique.COMMENTAIRE LIKE '%".$keyword."%'","Assistance.NOM LIKE '%".$keyword."%'","Section.NOM LIKE '%".$keyword."%'","Typemateriel.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Materielinformatique->recursive = 0;
                $this->set('materielinformatiques', $this->paginate());
                $etats = $this->Materielinformatique->find('all',array('fields' => array('ETAT'),'group'=>'ETAT','order'=>array('ETAT'=>'asc')));
                $this->set('etats',$etats); 
                $types = $this->Materielinformatique->find('all',array('fields' => array('Typemateriel.NOM'),'group'=>'Typemateriel.NOM','order'=>array('Typemateriel.NOM'=>'asc')));
                $this->set('types',$types);    
                $sections = $this->Materielinformatique->find('all',array('fields' => array('Section.NOM'),'group'=>'Section.NOM','order'=>array('Section.NOM'=>'asc')));
                $this->set('sections',$sections);                 
                $this->render('index');
        }   
}
