<?php
App::uses('AppController', 'Controller');
App::uses('ChangelogreponsesController', 'Controller');
App::uses('ChangelogdemandesController', 'Controller');
/**
 * Changelogversions Controller
 *
 * @property Changelogversion $Changelogversion
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class ChangelogversionsController extends AppController {

    /**
     * Components
     */
    public $paginate = array('limit' => 25,'order'=>array('Changelogversion.VERSION'=>'desc'));
    public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Versions de SAILL" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }            
        
    /**
     * liste toutes les versions de SAILL 
     *
     * @return void
     */
    public function index() {
            $this->set_title();
            $this->Changelogversion->recursive = 0;
            $this->set('changelogversions', $this->paginate());
    }

    /**
     * autorise l'utilisation de certaines méthodes sans authen,tification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_info'));
        parent::beforeFilter();
    }  

    /**
     * ajoute une nouvelle version
     *
     * @return void
     */
    public function add() {
            $this->set_title();
            if ($this->request->is('post')) {                    
                $version = $this->Changelogversion->find('all',array('conditions'=>array('Changelogversion.VERSION'=>$this->request->data['Changelogversion']['VERSION']),'recursive'=>0));
                if(count($version)==0):
                    $this->Changelogversion->create();
                    if ($this->Changelogversion->save($this->request->data)) {
                            $this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
                    } else {
                            $this->Session->setFlash(__('Version incorrecte, veuillez corriger la version',true),'flash_failure');
                    }
                else:
                    $this->Session->setFlash(__('Version déjà existante',true),'flash_failure');
                endif;
                return $this->redirect(array('action' => 'index'));
            }
    }

    /**
     * mets à jour une version seule la date est mise à jour
     * 
     * @return void
     */
    public function edit() {
            $this->autoRender = false;
            $this->Changelogversion->id = $this->request->data['Changelogversion']['id'];
            if ($this->request->is(array('post', 'put'))) {
                $ObjChangelogreponses = new ChangelogreponsesController();
                if ($this->Changelogversion->saveField('DATEPREVUE', $this->request->data['Changelogversion']['DATE'])) {
                        $ObjChangelogreponses->updateresponses($this->request->data['Changelogversion']['id'],$this->request->data['Changelogversion']['DATE']);
                        $this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
                } else {
                        $this->Session->setFlash(__('Version incorrecte, veuillez corriger la version',true),'flash_failure');
                }
                return $this->redirect(array('action' => 'index'));
            }
    }

    /**
     * supprime une version
     *
     * @throws NotFoundException
     * @param int $id
     * @return void
     */
    public function delete($id = null) {
            $this->set_title();
            $this->Changelogversion->id = $id;
            if (!$this->Changelogversion->exists()) {
                    throw new NotFoundException(__('Version de SAILL incorrecte'));
            }
            $this->request->onlyAllow('post', 'delete');
            if ($this->Changelogversion->delete()) {
                    $this->Session->setFlash(__('Version supprimée',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Version <b>NON</b> ne peut pas être supprimée',true),'flash_failure');
            }
            return $this->redirect(array('action' => 'index'));
    }
        
    /**
     * change de façon dynamique l'état d'une version
     * 
     * @param int $id
     * @return boolean
     */
    public function ajax_changeetat($id=null){
            $this->set_title();
            $newid = $id == null ? $this->request->data('id') : $id;
            $result = false;
            $this->Changelogversion->id = $newid;
            $obj = $this->Changelogversion->find('first',array('conditions'=>array('Changelogversion.id'=>$newid),'recursive'=>0));
            $newactif = $obj['Changelogversion']['ETAT'] == 1 ? 0 : 1;
            $ObjChangelogdemandes = new ChangelogdemandesController();
            if ($this->Changelogversion->saveField('ETAT',$newactif)) {
                    if($newactif==1):
                        $ObjChangelogdemandes->close($obj['Changelogversion']['id']);
                        $this->Changelogversion->saveField('DATEREELLE',date('Y-m-d H:i:s'));
                    else:
                        $ObjChangelogdemandes->open($obj['Changelogversion']['id']);
                        $this->Changelogversion->saveField('DATEREELLE',null);
                    endif;
                    if ($id==null):
                        $this->Session->setFlash(__('Modification de l\'état de la version prise en compte',true),'flash_success');
                    else:
                        $result = true;
                    endif;
            } else {
                    if ($id==null):
                        $this->Session->setFlash(__('Modification de l\'état de la version <b>NON</b> prise en compte',true),'flash_failure');
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

    /**
     * liste des versions
     * 
     * @return array
     */
    public function get_select_all(){
        $list = $this->Changelogversion->find('list',array('fields'=>array('Changelogversion.id','Changelogversion.VERSION'),'order'=>array('Changelogversion.VERSION'=>'asc'),'recursive'=>0));
        return $list;
    }           

    /**
     * liste des versions ouvertes
     * 
     * @return array
     */
    public function get_select_open(){
        $conditions[] = 'Changelogversion.ETAT=0';
        $list = $this->Changelogversion->find('list',array('fields'=>array('Changelogversion.id','Changelogversion.VERSION'),'conditions'=>$conditions,'order'=>array('Changelogversion.VERSION'=>'asc'),'recursive'=>0));
        return $list;
    }     

    /**
     * liste des versions ouvertes
     * 
     * @return array
     */
    public function get_all_open(){
        $conditions[] = 'Changelogversion.ETAT=0';
        $list = $this->Changelogversion->find('all',array('fields'=>array('Changelogversion.id','Changelogversion.VERSION'),'conditions'=>$conditions,'order'=>array('Changelogversion.VERSION'=>'asc'),'recursive'=>0));
        return $list;
    }            

    /**
     * liste des version fermées
     * 
     * @return array
     */
    public function get_all_close(){
        $conditions[] = 'Changelogversion.ETAT=1';
        $list = $this->Changelogversion->find('all',array('fields'=>array('Changelogversion.id,Changelogversion.DATEREELLE','Changelogversion.VERSION'),'conditions'=>$conditions,'order'=>array('Changelogversion.VERSION'=>'desc'),'recursive'=>0));
        return $list;
    } 

    /**
     * information de la version
     * 
     * @param int $id
     * @return json
     */
    public function json_get_info($id){
        $this->autoRender = false;
        $conditions[] = 'Changelogversion.id='.$id;
        $obj = $this->Changelogversion->find('first',array('conditions'=>$conditions,'recursive'=>-1));
        $result = json_encode($obj);
        return $result;
    }

    /**
     * trouve la prochaine version ouverte
     * 
     * @return array
     */
    public function getnextversion(){
        $conditions[] = 'Changelogversion.ETAT=0';
        $list = $this->Changelogversion->find('all',array('conditions'=>$conditions,'order'=>array('Changelogversion.VERSION'=>'asc'),'recursive'=>0));
        return $list;
    }

    /**
     * trouve la dernière version fermée
     * 
     * @return array
     */
    public function get_last(){
        $conditions[] = 'Changelogversion.ETAT=1';
        $list = $this->Changelogversion->find('first',array('conditions'=>$conditions,'order'=>array('Changelogversion.VERSION'=>'desc'),'recursive'=>0));
        return $list;
    }
}
