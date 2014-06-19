<?php
App::uses('AppController', 'Controller');
App::uses('ProjetsController', 'Controller');
/**
 * Centrecouts Controller
 *
 * @property Centrecout $Centrecout
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class CentrecoutsController extends AppController {

    /**
     * variables utilisées au niveau du controller
     */
    public $components = array('History','Common');    
    public $paginate = array(
    'order' => array('Centrecout.NOM' => 'asc'),
    );
        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Centre de coûts" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              
        
    /**
     * limite la visibilité en fonction de l'utilisateur
     * 
     * @return null
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            return null;
        endif;
    }

    /**
     * permet de fixer une restriction en fonction de la visibilité
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return '1=1';
        else:
            return '1=1';
        endif;
    }

    /**
     * filtre sur le département
     * 
     * @param string $departement
     * @return string
     */
    public function get_centrecout_departement_filter($departement){
        $result = array();
        switch ($departement) {
            case 'tous':
            case null:  
                $result['condition']="1=1";
                $result['filter'] = "tous les cercles";
                break;  
            default:
                $nomdepartement = $this->Centrecout->find('first',array('conditions'=>array('Centrecout.id'=>$departement),'recursive'=>0));
                $result['condition']="Centrecout.NOMDEPARTEMENT='".$nomdepartement['Centrecout']['NOMDEPARTEMENT']."'";
                $result['filter'] = "de l'entité ".$nomdepartement['Centrecout']['NOMDEPARTEMENT'];                        
                break;
        }
        return $result;
    }

    /**
     * liste les centres de coûts
     * 
     * @param string $departement
     * @throws UnauthorizedException
     */
    public function index($departement=null) {
        $this->set_title();
        if (isAuthorized('centrecouts', 'index')) :   
            $getdepartement = $this->get_centrecout_departement_filter($departement);
            $fpriorite = $getdepartement['filter'];
            $ObjProjets = new ProjetsController();		
            $all_projets = $ObjProjets->get_list_actif();
            $departements = $this->find_list_nomdepartement();
            $this->set(compact('all_projets','departements','fpriorite'));                
            $newconditions = array($getdepartement['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));
            $this->set('centrecouts', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * ajoute un centre de coût
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('centrecouts', 'add')) :             
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Activitesreelle->validate = array();
                    $this->History->goFirst();
                else:                      
                    $this->Centrecout->create();
                    if ($this->Centrecout->save($this->request->data)) {
                            $this->Session->setFlash(__('Centre de coût sauvegardé',true),'flash_success');
                            $this->History->goFirst();
                    } else {
                            $this->Session->setFlash(__('Centre de coût incorrect, veuillez corriger le centre de coût',true),'flash_failure');
                    }
                endif;
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * modifie un centre de coût
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('centrecouts', 'edit')) :             
            if (!$this->Centrecout->exists($id)) {
                    throw new NotFoundException(__('Invalid centrecout'));
            }
            if ($this->request->is(array('post', 'put'))) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Activitesreelle->validate = array();
                    $this->History->goFirst();
                else:                      
                    if ($this->Centrecout->save($this->request->data)) {
                            $this->Session->setFlash(__('Centre de coût sauvegardé',true),'flash_success');
                            $this->History->goFirst();
                    } else {
                            $this->Session->setFlash(__('Centre de coût incorrect, veuillez corriger le centre de coût',true),'flash_failure');
                    }
               endif;
            } else {
                    $options = array('conditions' => array('Centrecout.' . $this->Centrecout->primaryKey => $id));
                    $this->request->data = $this->Centrecout->find('first', $options);
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * supprime le centre de coût
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('centrecouts', 'delete')) :             
            $this->Centrecout->id = $id;
            if (!$this->Centrecout->exists()) {
                    throw new NotFoundException(__('Invalid centrecout'));
            }
            if ($this->Centrecout->delete()) {
                    $this->Session->setFlash(__('Centre de coût supprimé',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Centre de coût <b>NON</b> supprimé',true),'flash_failure');
            }
            $this->History->goFirst();
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * recherche du centre de coût
     * 
     * @param string $departement
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($departement=null,$keywords=null) {
        $this->set_title();
        if (isAuthorized('centrecouts', 'index')) :
            if(isset($this->params->data['Centrecout']['SEARCH'])):
                $keywords = $this->params->data['Centrecout']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                $getdepartement = $this->get_centrecout_departement_filter($departement);
                $fpriorite = $getdepartement['filter'];
                $ObjProjets = new ProjetsController();		
                $all_projets = $ObjProjets->get_list_actif();
                $departements = $this->find_list_nomdepartement();
                $this->set(compact('all_projets','departements','fpriorite'));                
                $newconditions = array($getdepartement['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Centrecout.NOM LIKE '%".$value."%'","Centrecout.NOMDEPARTEMENT LIKE '%".$value."%'","Centrecout.CODEDEPARTEMENT LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('centrecouts', $this->paginate());                    
            else:
                $this->redirect(array('action'=>'index',$departement));
            endif;   
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }    

    /**
     * trouve tous les départements sasiie au niveau des centres de coût
     * 
     * @return array
     */
    public function find_list_nomdepartement(){
        $results = $this->Centrecout->find('all',array('fields'=>array('Centrecout.id','Centrecout.NOMDEPARTEMENT'),'group'=>array('Centrecout.NOMDEPARTEMENT'),'order'=>array('Centrecout.NOMDEPARTEMENT'=>'asc'),'recursive'=>0));
        return $results;
    }
}
