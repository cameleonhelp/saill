<?php
App::uses('AppController', 'Controller');
App::uses('AssoentiteutilisateursController', 'Controller');
App::uses('EntitesController', 'Controller');
/**
 * Architectures Controller
 *
 * @property Architecture $Architecture
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class ArchitecturesController extends AppController {

    /**
     * déclaration des variables
     */
    public $paginate = array('limit' => 25,'order'=>array('Architecture.NOM'=>'asc'));
    public $components = array('History','Common');

    /**
     * recherche du périmètre de visibilité
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
     * réduit la visibilité en fonction de la visibilité
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('OR'=>array('Architecture.entite_id IN ('.$visibility.')','Architecture.entite_id IS NULL'));
        else:
            return array('OR'=>array('Architecture.entite_id ='.userAuth('entite_id'),'Architecture.entite_id IS NULL'));
        endif;
    }

    /**
     * filtre sur l'état actif
     * 
     * @param int $id
     * @return string
     */
    public function get_architecture_actif_filter($id){
        $result = array();
        switch($id):
            case null:
            case 1:
                $result['condition']="Architecture.ACTIF=1";
                $result['filter'] = 'actives';
                break;
            case 0:
                $result['condition']="Architecture.ACTIF=0";
                $result['filter'] = 'inactives';
                break;
        endswitch;
        return $result;
    }        

    /**
     * filtre par entité
     * 
     * @param int $id
     * @param string $visibility
     * @return string
     */
    public function get_architecture_entite_filter($id,$visibility){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']=array('OR'=>array('Architecture.entite_id IN ('.$visibility.')','Architecture.entite_id IS NULL'));
                else:
                    $result['condition']=array('OR'=>array('Architecture.entite_id ='.userAuth('entite_id'),'Architecture.entite_id IS NULL'));
                endif;                      
                $result['filter'] = ' de tous les cercles';
                break;
            default:
                $result['condition']='Architecture.entite_id ='.$id;
                $ObjEntites = new EntitesController();		
                $nom = $ObjEntites->get_entite_nom($id);
                $result['filter'] = 'ayant pour entité '.$nom;
        endswitch;
        return $result;
    }    

    /**
     * liste des architectures
     * 
     * @param int $actif
     * @param int $entite
     * @return array
     * @throws UnauthorizedException
     */
    public function index($actif=null,$entite=null) {
        if (isAuthorized('architectures', 'index')) :
            $visibility = $this->get_visibility();                
            $restriction= $this->get_restriction($visibility);
            $getactif = $this->get_architecture_actif_filter($actif);
            $getentite = $this->get_architecture_entite_filter($entite, $visibility);
            $this->set('strfilter',$getactif['filter'].$getentite['filter']);
            $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));
            $this->set('architectures', $this->paginate());
            $ObjEntites = new EntitesController();		
            $cercles = $ObjEntites->get_all();
            $this->set(compact('cercles'));                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * ajout d'une nouvelle architecture
     * 
     * @return void
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('architectures', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Architecture->validate = array();
                    $this->History->goBack(1);
                else:           
                    $this->request->data['Architecture']['entite_id']=userAuth('entite_id');
                    $this->Architecture->create();
                    if ($this->Architecture->save($this->request->data)) {
                            $this->Session->setFlash(__('Architecture sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Architecture incorrecte, veuillez corriger l\'architecture',true),'flash_failure');
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
     * modification de l'architecure
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @return void
     */
    public function edit($id = null) {
        if (isAuthorized('architectures', 'edit')) :
            if (!$this->Architecture->exists($id)) {
                    throw new NotFoundException(__('Architecture incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Architecture->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Architecture->save($this->request->data)) {
                            $this->Session->setFlash(__('Architecture sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Architecture incorrecte, veuillez corriger l\'architecture',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Architecture.' . $this->Architecture->primaryKey => $id));
                $this->request->data = $this->Architecture->find('first', $options);
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
     * suppresion de l'architecture
     * 
     * @param int $id
     * @return void
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('architectures', 'delete')) :
            $this->Architecture->id = $id;
            if (!$this->Architecture->exists()) {
                    throw new NotFoundException(__('Architecture incorrect'));
            }
            if ($this->Architecture->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Architecture supprimée',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Architecture <b>NON</b> supprimée',true),'flash_failure');
            }
            return $this->redirect(array('action' => 'index'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * modification de l'atat actif en dynamique de l'architecture (Ajax)
     */
    public function ajax_actif(){
            $id = $this->request->data('id');
            $this->Architecture->id = $id;
            $architecture = $this->Architecture->find('first',array('conditions'=>array('Architecture.id'=>$id),'recursive'=>0));
            $newactif = $architecture['Architecture']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Architecture->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * recherche des architecture en fonction du $keywords
     * 
     * @param int $actif
     * @param int $entite
     * @param string $keywords
     * @throws UnauthorizedException
     * @return array
     */
    public function search($actif=null,$entite=null,$keywords=null){
        if (isAuthorized('architectures', 'index')) :
            if(isset($this->params->data['Architecture']['SEARCH'])):
                $keywords = $this->params->data['Architecture']['SEARCH'];
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
                $getactif = $this->get_architecture_actif_filter($actif);
                $getentite = $this->get_architecture_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Architecture.NOM LIKE '%".$value."%'","Architecture.COMMENTAIRE LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                     
                $this->set('architectures', $this->paginate());
                $ObjEntites = new EntitesController();		
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
     * Retourne la liste des architecture pour les select
     * 
     * @param int $actif
     * @return array
     */
    public function get_select($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);    
        $conditions[] = 'Architecture.ACTIF='.$actif;
        $list = $this->Architecture->find('list',array('fields'=>array('Architecture.id','Architecture.NOM'),'conditions'=>$conditions,'order'=>array('Architecture.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }    

    /**
     * Retourne toutes les architectures 
     * 
     * @param int $actif
     * @return array 
     */
    public function get_list($actif=null){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);                
        $conditions[] = $actif == null ? '1=1' : 'Architecture.ACTIF='.$actif;
        $list = $this->Architecture->find('all',array('fields'=>array('Architecture.id','Architecture.NOM'),'order'=>array('Architecture.NOM'=>'asc'),'conditions'=>$conditions,'recursive'=>0));
        return $list;
    }       

    /**
     * retourne une architecture à partir de son nom
     * @param string $nom
     * @return Architecture
     */
    public function getbynom($nom){
        $this->Architecture->recursive = 0;
        $obj = $this->Architecture->findByNom($nom);
        return $obj;
    }         
}
