<?php
App::uses('AppController', 'Controller');
/**
 * Typemateriels Controller
 *
 * @property Typemateriel $Typemateriel
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class TypematerielsController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $components = array('History','Common'); 
    public $paginate = array(
    'limit' => 25,
    'order' => array('Typemateriel.NOM' => 'asc'),
    );
                     
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Type de matériel" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }         

    /**
     * méthode permettant l'utilisation de méthode sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_list_other'));
        parent::beforeFilter();
    }  

    /**
     * renvois la liste des UC
     * 
     * @return array
     */
    public function get_list_uc(){
        return $this->Typemateriel->find('list',array('fields'=>array('Typemateriel.id','Typemateriel.NOM'),'conditions'=>array('Typemateriel.UC'=>1),'oreder'=>array('Typemateriel.NOM'=>'asc'),'recursive'=>0));
    }

    /**
     * renvois toutes les UC
     * 
     * @return array
     */
    public function get_all_uc(){
        return $this->Typemateriel->find('all',array('conditions'=>array('Typemateriel.UC'=>1),'oreder'=>array('Typemateriel.NOM'=>'asc'),'recursive'=>0));
    }      

    /**
     * renvois autre que UC
     * 
     * @return array
     */
    public function get_list_other(){
        return $this->Typemateriel->find('list',array('fields'=>array('Typemateriel.id','Typemateriel.NOM'),'conditions'=>array('Typemateriel.UC'=>0),'oreder'=>array('Typemateriel.NOM'=>'asc'),'recursive'=>0));
    }

    /**
     * renvois autre que UC
     * 
     * @return json
     */
    public function json_list_other(){
        $this->autoRender = false;
        $result = $this->Typemateriel->find('list',array('fields'=>array('Typemateriel.NOM','Typemateriel.id'),'conditions'=>array('Typemateriel.UC'=>0),'oreder'=>array('Typemateriel.NOM'=>'asc'),'recursive'=>0));
        return json_encode($result);
    }        

    /**
     * filtre les matériel par statut UC
     * 
     * @param string $id
     * @return string
     */
    public function get_typemateriel_uc_filter($id){
        $result = array();
        switch ($id){
            case 'tous':
            case null:    
                $result['condition']="1=1";
                $result['filter'] = " de tout type de matériel";
                break;
            case '1' :
                $result['condition']="Typemateriel.UC = 1";
                $result['filter'] = " des Unités centrales et/ou portables";  
                break;
            case '0' :
                $result['condition']="Typemateriel.UC = 0";
                $result['filter'] = " des autres type de matériel que Unité Centrale et portable";  
                break;            
        }   
        return $result; 
    }

    /**
     * liste le matériel
     *
     * @param string $filtreUC
     */
    public function index($filtreUC = null) {
        $this->set_title();
        if (isAuthorized('typemateriels', 'index')) :
            $getUC = $this->get_typemateriel_uc_filter($filtreUC);
            $this->set('strfilter',$getUC['filter']);
            $newconditions = array($getUC['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
            $this->set('typemateriels', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * ajoute un type de matériel
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('typemateriels', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Typemateriel->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->Typemateriel->create();
                    if ($this->Typemateriel->save($this->request->data)) {
                            $this->Session->setFlash(__('Type de matériel sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Type de matériel incorrect, veuillez corriger le type de matériel',true),'flash_failure');
                    }
                endif;
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * met à jour un type de matériel
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('typemateriels', 'edit')) :
            if (!$this->Typemateriel->exists($id)) {
                    throw new NotFoundException(__('Type de matériel incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Typemateriel->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Typemateriel->save($this->request->data)) {
                            $this->Session->setFlash(__('Type de matériel sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Type de matériel incorrect, veuillez corriger le type de matériel',true),'flash_failure');
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Typemateriel.' . $this->Typemateriel->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Typemateriel->find('first', $options);
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * suypprime un type de matériel
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('typemateriels', 'delete')) :
            $this->Typemateriel->id = $id;
            if (!$this->Typemateriel->exists()) {
                    throw new NotFoundException(__('Type de matériel incorrect'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->Typemateriel->delete()) {
                    $this->Session->setFlash(__('Type de matériel supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Type de matériel <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * recherche de type de matériel
     * 
     * @param string $filtreUC
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($filtreUC=null,$keywords=null) {
        $this->set_title();
        if (isAuthorized('typemateriels', 'index')) :
            if(isset($this->params->data['Typemateriel']['SEARCH'])):
                $keywords = $this->params->data['Typemateriel']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                $getUC = $this->get_typemateriel_uc_filter($filtreUC);
                $this->set('strfilter',$getUC['filter']);
                $newcondition = array($getUC['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Typemateriel.NOM LIKE '%".$value."%'","Typemateriel.DESCRIPTION LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('typemateriels', $this->paginate());     
            else:
                $this->redirect(array('action'=>'index',$filtreUC));
            endif;                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }            
}
