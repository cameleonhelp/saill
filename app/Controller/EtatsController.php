<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Entites');
App::import('Controller', 'Assoentiteutilisateurs');
/**
 * Etats Controller
 *
 * @property Etat $Etat
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class EtatsController extends AppController {

    /**
     * Components
     */
    public $paginate = array('limit' => 25,'order'=>array('Entite.NOM'=>'asc','Etat.ORDER'=>'asc'));
    public $components = array('History','Common');

    /**
     * détermine le périmètre de visibilité
     * 
     * @return null
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return $ObjAssoentiteutilisateurs->json_get_my_entite(userAuth('id'));
        endif;
    }

    /**
     * applique la restriction de visibilité
     * 
     * @param type $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('OR'=>array('Etat.entite_id IN ('.$visibility.')','Etat.entite_id IS NULL'));
        else:
            return array('OR'=>array('Etat.entite_id ='.userAuth('entite_id'),'Etat.entite_id IS NULL'));
        endif;
    }

    /**
     * filtre les état en fonction de leur état
     * 
     * @param string $id
     * @return string
     */
    public function get_etat_actif_filter($id){
        $result = array();
        switch($id):
            case null:
            case 1:
                $result['condition']="Etat.ACTIF=1";
                $result['filter'] = 'actives';
                break;
            case 0:
                $result['condition']="Etat.ACTIF=0";
                $result['filter'] = 'inactives';
                break;
        endswitch;
        return $result;
    }

    /**
     * filtre les états par entité
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_etat_entite_filter($id,$visibility){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']=array('OR'=>array('Etat.entite_id IN ('.$visibility.')','Etat.entite_id IS NULL'));
                else:
                    $result['condition']=array('OR'=>array('Etat.entite_id ='.userAuth('entite_id'),'Etat.entite_id IS NULL'));
                endif;                      
                $result['filter'] = ' de tous les cercles';
                break;
            default:
                $result['condition']='Etat.entite_id ='.$id;
                $ObjEntites = new EntitesController();	
                $nom = $ObjEntites->get_entite_nom($id);
                $result['filter'] = 'ayant pour entité '.$nom;
        endswitch;
        return $result;
    }        

    /**
     * liste les états
     * 
     * @param string $actif
     * @param string $entite
     * @throws UnauthorizedException
     */
    public function index($actif=null,$entite=null) {
        if (isAuthorized('etats', 'index')) :               
            $visibility = $this->get_visibility();                
            $restriction= $this->get_restriction($visibility);
            $getactif = $this->get_etat_actif_filter($actif);
            $getentite = $this->get_etat_entite_filter($entite, $visibility);
            $this->set('strfilter',$getactif['filter'].$getentite['filter']);
            $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
            $this->set('etats', $this->paginate());
            $ObjEntites = new EntitesController();	
            $cercles = $ObjEntites->get_all();
            $this->set(compact('cercles'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * ajoute un état
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('etats', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Etat->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->Etat->create();
                    if ($this->Etat->save($this->request->data)) {
                            $this->Session->setFlash(__('Etat sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Etat incorrect, veuillez corriger l\'application',true),'flash_failure');
                    }
                endif;
            endif;
            $ObjEntites = new EntitesController();	
            $cercles = $ObjEntites->find_list_cercle();
            $this->set(compact('cercles'));                 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * met à jour un état
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('etats', 'edit')) :            
            if (!$this->Etat->exists($id)) {
                    throw new NotFoundException(__('Etat incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Etat->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Etat->save($this->request->data)) {
                            $this->Session->setFlash(__('Etat sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Etat incorrect, veuillez corriger l\'état',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Etat.' . $this->Etat->primaryKey => $id));
                $this->request->data = $this->Etat->find('first', $options);
                $ObjEntites = new EntitesController();	
                $cercles = $ObjEntites->find_list_cercle();
                $this->set(compact('cercles')); 
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * supprime un état
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('etats', 'delete')) : 
            $this->Etat->id = $id;
            if (!$this->Etat->exists()) {
                    throw new NotFoundException(__('Etat incorrect'));
            }
            if ($this->Etat->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Etat supprimé',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Etat <b>NON</b> supprimé',true),'flash_failure');
            }
            $this->History->notmove();
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * mets à jour le statuit de l'état (Ajax)
     */
    public function ajax_actif(){
            $id = $this->request->data('id');
            $this->Etat->id = $id;
            $cpu = $this->Etat->find('first',array('conditions'=>array('Etat.id'=>$id),'recursive'=>0));
            $newactif = $cpu['Etat']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Etat->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * recherhce les états
     * 
     * @param string $actif
     * @param string $entite
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($actif=null,$entite=null,$keywords=null){
        if (isAuthorized('etats', 'index')) :
            if(isset($this->params->data['Etat']['SEARCH'])):
                $keywords = $this->params->data['Etat']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                $visibility = $this->get_visibility();                
                $restriction= $this->get_restriction($visibility);
                $getactif = $this->get_etat_actif_filter($actif);
                $getentite = $this->get_etat_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Etat.NOM LIKE '%".$value."%'","Etat.ORDER LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('etats', $this->paginate());    $ObjEntites = new EntitesController();	

                $cercles = $ObjEntites->get_all();
                $this->set(compact('cercles'));                    
            else:
                $this->redirect(array('action'=>'index',$actif,$entite));
            endif;                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;  
    }

    /**
     * renvois la liste des états
     * 
     * @param string $actif
     * @return array
     */
    public function get_select($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Etat.ACTIF='.$actif;            
        $list = $this->Etat->find('list',array('fields'=>array('Etat.id','Etat.NOM'),'conditions'=>$conditions,'order'=>array('Etat.ORDER'=>'asc'),'recursive'=>0));
        return $list;
    }        

    /**
     * renvois la liste des états actifs ou pas
     * 
     * @param string $actif
     * @return array
     */
    public function get_list($actif=null){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Etat.ACTIF='.$actif;
        $list = $this->Etat->find('all',array('fields'=>array('Etat.id','Etat.NOM'),'conditions'=>$conditions,'order'=>array('Etat.ORDER'=>'asc'),'recursive'=>-1));
        return $list;
    }    

    /**
     * renvois le nom de l'état
     * 
     * @param string $nom
     * @return string
     */
    public function getbynom($nom){
        $this->Etat->recursive = 0;
        $obj = $this->Etat->findByNom($nom);
        return $obj;
    }         
}