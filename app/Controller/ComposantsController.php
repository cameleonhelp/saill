<?php
App::uses('AppController', 'Controller');
App::uses('AssoentiteutilisateursController', 'Controller');
App::uses('EntitesController', 'Controller');
/**
 * Composants Controller
 *
 * @property Composant $Composant
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class ComposantsController extends AppController {
    /**
     * Components
     */
    public $paginate = array('limit' => 25,'order'=>array('Composant.NOM'=>'asc'));
    public $components = array('History','Common');

    /**
     * limite la visibilité en fonction de l'utilisateur
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
     * applique la limitation de visibilité
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('OR'=>array('Composant.entite_id IN ('.$visibility.')','Composant.entite_id IS NULL'));
        else:
            return array('OR'=>array('Composant.entite_id ='.userAuth('entite_id'),'Composant.entite_id IS NULL'));
        endif;
    }

    /**
     * filtre sur les composants actifs
     * 
     * @param string $id
     * @return string.
     */
    public function get_composant_actif_filter($id){
        $result = array();
        switch($id):
            case null:
            case 1:
                $result['condition']="Composant.ACTIF=1";
                $result['filter'] = 'actives';
                break;
            case 0:
                $result['condition']="Composant.ACTIF=0";
                $result['filter'] = 'inactives';
                break;
        endswitch;
        return $result;
    }     

    /**
     * filtre sur l'entité
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_composant_entite_filter($id,$visibility){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']=array('OR'=>array('Composant.entite_id IN ('.$visibility.')','Composant.entite_id IS NULL'));
                else:
                    $result['condition']=array('OR'=>array('Composant.entite_id ='.userAuth('entite_id'),'Composant.entite_id IS NULL'));
                endif;                      
                $result['filter'] = ' de tous les cercles';
                break;
            default:
                $result['condition']='Composant.entite_id ='.$id;
                $ObjEntites = new EntitesController();
                $nom = $ObjEntites->get_entite_nom($id);
                $result['filter'] = 'ayant pour entité '.$nom;
        endswitch;
        return $result;
    } 
    
    /**
     * liste les composants
     * 
     * @param string $actif
     * @param string $entite
     * @throws UnauthorizedException
     */
    public function index($actif=null,$entite=null) {
        if (isAuthorized('composants', 'index')) :
            $visibility = $this->get_visibility();                
            $restriction= $this->get_restriction($visibility);
            $getactif = $this->get_composant_actif_filter($actif);
            $getentite = $this->get_composant_entite_filter($entite, $visibility);
            $this->set('strfilter',$getactif['filter'].$getentite['filter']);
            $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
            $this->set('composants', $this->paginate());
            $ObjEntites = new EntitesController();
            $cercles = $ObjEntites->get_all();
            $this->set(compact('cercles'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * ajoute un composant
     *
     * @return void
     */
    public function add() {
        if (isAuthorized('composants', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Composant->validate = array();
                    $this->History->goBack(1);
                else:                 
                    $this->request->data['Composant']['entite_id']=userAuth('entite_id');
                    $this->Composant->create();
                    if ($this->Composant->save($this->request->data)) {
                            $this->Session->setFlash(__('Composant sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Composant incorrect, veuillez corriger le composant',true),'flash_failure');
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
     * met à jour le composant
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (isAuthorized('composants', 'edit')) :
            if (!$this->Composant->exists($id)) {
                    throw new NotFoundException(__('Composant incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Composant->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Composant->save($this->request->data)) {
                            $this->Session->setFlash(__('Composant sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Composant incorrect, veuillez corriger le composant',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Composant.' . $this->Composant->primaryKey => $id));
                $this->request->data = $this->Composant->find('first', $options);
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
     * supprime le composant
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (isAuthorized('composants', 'delete')) :
            $this->Composant->id = $id;
            if (!$this->Composant->exists()) {
                    throw new NotFoundException(__('Composant incorrect'));
            }
            if ($this->Composant->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Composant supprimé',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Composant <b>NON</b> supprimé',true),'flash_failure');
            }
            return $this->redirect(array('action' => 'index'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;  
    }

    /**
     * modiification du statut actif en dynamique (Ajax)
     */
    public function ajax_actif(){
            $id = $this->request->data('id');
            $this->Composant->id = $id;
            $composant = $this->Composant->find('first',array('conditions'=>array('Composant.id'=>$id),'recursive'=>0));
            $newactif = $composant['Composant']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Composant->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * recherche de copmposants
     * 
     * @param string $actif
     * @param string $entite
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($actif=null,$entite=null,$keywords=null){
        if (isAuthorized('composants', 'index')) :
            if(isset($this->params->data['Composant']['SEARCH'])):
                $keywords = $this->params->data['Composant']['SEARCH'];
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
                $getactif = $this->get_composant_actif_filter($actif);
                $getentite = $this->get_composant_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Composant.NOM LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('composants', $this->paginate());  
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
     * list des composants
     * 
     * @param string $actif
     * @return array
     */
    public function get_select($actif=1){        
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);      
        $conditions[] = 'Composant.ACTIF='.$actif;
        $list = $this->Composant->find('list',array('fields'=>array('Composant.id','Composant.NOM'),'conditions'=>$conditions,'order'=>array('Composant.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }  

    /**
     * liste des composants
     * 
     * @param string $actif
     * @return array
     */
    public function get_list($actif=null){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Composant.ACTIF='.$actif;
        $list = $this->Composant->find('all',array('fields'=>array('Composant.id','Composant.NOM'),'order'=>array('Composant.NOM'=>'asc'),'conditions'=>$conditions,'recursive'=>0));
        return $list;
    }  

    /**
     * retourne le chassis à partir de son nom
     * 
     * @param string $nom
     * @return array
     */
    public function getbynom($nom){
        $this->Composant->recursive = 0;
        $obj = $this->Composant->findByNom($nom);
        return $obj;
    }         
}
