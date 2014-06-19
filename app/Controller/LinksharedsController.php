<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
/**
 * Linkshareds Controller
 *
 * @property Linkshared $Linkshared
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class LinksharedsController extends AppController {
    /**
     * Variables utilisées au niveau du controller
     */
    public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Linkshared.NOM' => 'asc'),
        );
    
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Favoris partagés" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }          
    
    /**
     * renvois le périmètre de visibilité
     * 
     * @return string
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:        
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return '1,'.$ObjAssoentiteutilisateurs->json_get_all_users(userAuth('id'));
        endif;
    }
    
    /**
     * applique le filtre sur la visibilité
     * 
     * @param string $visibility
     * @return string
     */
    public function get_linkshared_filter($visibility){
        $result = array();
        if($visibility == null):
            $result['condition']='1=1';
        elseif ($visibility!=''):
            $result['condition']="Linkshared.utilisateur_id IN (".$visibility.')';
        else:
            $result['condition']="Linkshared.utilisateur_id =".userAuth('id');
        endif;                        
        return $result;
    }

    /**
     * liste les favoris
     */
    public function index() {
        $this->set_title();
        $listusers = $this->get_visibility();
        $getfilter = $this->get_linkshared_filter($listusers);
        $newconditions =  array($getfilter['condition']); 
        $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));
        $this->set('linkshareds', $this->paginate());              
    }

    /**
     * ajoute un favoris
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('linkshareds', 'add')) :
            $this->set_title();
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Linkshared->validate = array();
                    $this->History->goFirst();
                else:                    
                    $this->Linkshared->create();
                    if ($this->Linkshared->save($this->request->data)) {
                            $this->Session->setFlash(__('Lien partagé sauvegardé',true),'flash_success');
                            $this->History->goFirst();
                    } else {
                            $this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé',true),'flash_failure');
                    }
                endif;
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * modifie le favoris
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('linkshareds', 'edit')) :
            $this->set_title();
            if (!$this->Linkshared->exists($id)) {
                    throw new NotFoundException(__('Lien partagé incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Linkshared->validate = array();
                    $this->History->goFirst();
                else:                    
                    if ($this->Linkshared->save($this->request->data)) {
                            $this->Session->setFlash(__('Lien partagé sauvegardé',true),'flash_success');
                            $this->History->goFirst();
                    } else {
                            $this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé',true),'flash_failure');
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Linkshared.' . $this->Linkshared->primaryKey => $id));
                    $this->request->data = $this->Linkshared->find('first', $options);
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * supprime le favoris
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('linkshareds', 'delete')) :
            $this->set_title();
            $this->Linkshared->id = $id;
            if (!$this->Linkshared->exists()) {
                    throw new NotFoundException(__('Lien partagé incorrect'));
            }
            if ($this->Linkshared->delete()) {
                    $this->Session->setFlash(__('Lien partagé supprimé',true),'flash_success');
                    $this->History->goFirst();
            }
            $this->Session->setFlash(__('Lien partagé <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goFirst();
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * recherche des favoris
     * 
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($keywords=null) {
        $this->set_title();
        if (isAuthorized('linkshareds', 'index')) :
            if(isset($this->params->data['Activitesreelle']['SEARCH'])):
                $keywords = $this->params->data['Activitesreelle']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords));  
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Linkshared.NOM LIKE '%".$value."%'","Linkshared.LINK LIKE '%".$value."%'"));
                endforeach;
                $listusers = $this->get_visibility();
                $getfilter = $this->get_linkshared_filter($listusers);
                $newconditions =  array($getfilter['condition']);                   
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));
                $this->set('linkshareds', $this->paginate());              
            else:
                $this->redirect(array('action'=>'index'));
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }   
}        
