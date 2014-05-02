<?php
App::uses('AppController', 'Controller');
App::uses('ActivitesController', 'Controller');
/**
 * Achats Controller
 *
 * @property Achat $Achat
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class AchatsController extends AppController {
    /**
     * Déclaration des variables public de cette classe 
     */
    public $components = array('History','Common');  
    public $paginate = array(
    'limit' => 25,
    'order' => array('Achat.DATE' => 'desc','Achat.LIBELLEACHAT' => 'asc'),
    );
             
    /**
     * Méthode permettant entre autre d'autoriser l'accès sans authentification à des méthodes
     */
    public function beforeFilter() {   
        //$this->Auth->allow(array('json_get_this'));
        parent::beforeFilter();
    }           
        
    /**
     * Méthode permettant de limiter la visibilité de l'utilisateur en fonction de son profil
     * 
     * @return null ou string
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjActivites = new ActivitesController();
            return $ObjActivites->find_str_id_cercle_activite(userAuth('id'));
        endif;
    }
        
    /**
     * Méthode permettant de fixer la limite de visibilité dans les conditions des requêtes
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
     * Méthode permettant de compléter les conditions pour le filtre filtre
     * 
     * @param string $filtre
     * @param string $visibility
     * @return array('condition'=>'','filter'=>'')
     */
    public function get_achat_filtre_filter($filtre,$visibility){
        $result = array();
        switch ($filtre){
            case 'toutes':
            case null: 
                if($visibility == null):
                    $result['condition']="Activite.projet_id > 1";
                elseif ($visibility!=''):
                    $result['condition']="Activite.id IN (".$visibility.')';
                else:
                    $result['condition']="Activite.projet_id > 1";
                endif;                    
                $result['filter'] = "toutes les activités";
                break;                 
            default :
                $result['condition']="Activite.id='".$filtre."'";
                $activite = $this->Achat->Activite->find('first',array('fields'=>array('Activite.NOM'),'conditions'=>array('Activite.id'=>$filtre)));
                $result['filter'] = "l'activité ".$activite['Activite']['NOM'];
                break;                      
        }              
        return $result;
    }
        
    /**
     * Méthode permettant de mettre en session les données de l'export
     * 
     * @param array $condition
     */
    public function get_export($condition){
        $this->Session->delete('xls_export');
        $export = $this->Achat->find('all',array('conditions'=>$condition,'order'=>array('Achat.DATE'=>'desc'),'recursive'=>0));
        $this->Session->write('xls_export',$export);  
    }
        
    /**
     * Méthode permettant de lister les achats
     * 
     * @param string $filtre
     * @throws UnauthorizedException
     * @return Achats
     */
    public function index($filtre=null) {
        if (isAuthorized('achats', 'index')) : 
            $listactivite = $this->get_visibility();
            $getfiltre = $this->get_achat_filtre_filter($filtre, $listactivite);
            $this->set('factivite',$getfiltre['filter']);  
            $newconditions = array($getfiltre['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));
            $this->set('achats', $this->paginate());
            $this->get_export($newconditions);
            $ObjActivites = new ActivitesController();
            $activites = $ObjActivites->find_all_cercle_activite(userAuth('id'));
            $this->set('activites',$activites); 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;
    }

    /**
     * Méthode permettant d'ajouter un nouvel achat
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('achats', 'add')) : 
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Achat->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->Achat->create();
                    if ($this->Achat->save($this->request->data)) {
                            $this->Session->setFlash(__('Achat sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Achat incorrect, veuillez corriger l\'achat',true),'flash_failure');
                    }
                endif;
            endif;
            $ObjActivites = new ActivitesController();
            $activites = $ObjActivites->find_all_cercle_activite(userAuth('id'));
            $this->set('activites',$activites);                    
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 

    }

    /**
     * Méthode permettant la modification d'un achat
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('achats', 'edit')) :               
            if (!$this->Achat->exists($id)) {
                    throw new NotFoundException(__('Achat incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Achat->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Achat->save($this->request->data)) {
                            $this->Session->setFlash(__('Achat sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Achat incorrect, veuillez corriger l\'achat',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Achat.' . $this->Achat->primaryKey => $id),'recursive'=>0);
                $this->request->data = $this->Achat->find('first', $options);
                $ObjActivites = new ActivitesController();
                $activites = $ObjActivites->find_all_cercle_activite(userAuth('id'));
                $this->set('activites',$activites);                          
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * Méthode permettant de supprimer un achat
     * 
     * @param type $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('achats', 'delete')) : 
            $this->Achat->id = $id;
            if (!$this->Achat->exists()) {
                    throw new NotFoundException(__('Achat incorrect'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->Achat->delete()) {
                    $this->Session->setFlash(__('Achat supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Achat <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }
        
    /**
     * Méthode pour rechercher un achat
     * 
     * @param string $filtre
     * @param string $keywords
     * @throws UnauthorizedException
     * @return Achats
     */
    public function search($filtre=null,$keywords=null) {
        if (isAuthorized('achats', 'index')) : 
            if(isset($this->params->data['Achat']['SEARCH'])):
                $keywords = $this->params->data['Achat']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords));        
                $listactivite = $this->get_visibility();
                $getfiltre = $this->get_achat_filtre_filter($filtre, $listactivite);
                $this->set('factivite',$getfiltre['filter']);  
                $newconditions = array($getfiltre['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Achat.DATE LIKE '%".$value."%'","Activite.NOM LIKE '%".$value."%'","Achat.LIBELLEACHAT LIKE '%".$value."%'","Achat.DESCRIPTION LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                    
                $this->set('achats', $this->paginate());
                $this->get_export($conditions);
                $ObjActivites = new ActivitesController();
                $activites = $ObjActivites->find_all_cercle_activite(userAuth('id'));
                $this->set('activites',$activites);  
            else:
                $this->redirect(array('action'=>'index',$filtre));
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }    
       
    /**
     * Méthode pour exporter au format Excel
     */
    function export_xls() {
            $data = $this->Session->read('xls_export');
            $this->set('rows',$data);
            $this->render('export_xls','export_xls');
    }        
}
