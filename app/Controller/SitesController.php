<?php
App::uses('AppController', 'Controller');
/**
 * Sites Controller
 *
 * @property Site $Site
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class SitesController extends AppController {
    /**
     * Variables gloabales utilisées au niveau du controller
     */
    public $components = array('History','Common'); 
    public $paginate = array(
    'limit' => 25,
    'order' => array('Site.NOM' => 'asc'));

    /**
     * liste les sites
     * 
     * @throws UnauthorizedException
     */
    public function index() {
        //$this->Session->delete('history');
        if (isAuthorized('sites', 'index')) :
            $this->set('sites', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * Ajoute un site
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('sites', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Site->validate = array();
                    $this->History->goBack(1);
                else:                     
                    $this->Site->create();
                    if ($this->Site->save($this->request->data)) {
                            $this->Session->setFlash(__('Site sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Site incorrecte, veuillez corriger le site',true),'flash_failure');
                    }
                endif;
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * Mets à jour le site
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('sites', 'edit')) :
            if (!$this->Site->exists($id)) {
                    throw new NotFoundException(__('Site incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Site->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Site->save($this->request->data)) {
                            $this->Session->setFlash(__('Site sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Site incorrect, veuillez corriger le site',true),'flash_failure');
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Site.' . $this->Site->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Site->find('first', $options);
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * Supprime le site
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('sites', 'delete')) :
            $this->Site->id = $id;
            if (!$this->Site->exists()) {
                    throw new NotFoundException(__('Site incorrect'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->Site->delete()) {
                    $this->Session->setFlash(__('Site supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(___('Site <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * Recherche de sites
     * 
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($keywords=null) {
        if (isAuthorized('sites', 'index')) :
            if(isset($this->params->data['Site']['SEARCH'])):
                $keywords = $this->params->data['Site']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                $newcondition = array();
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Site.NOM LIKE '%".$value."%'","Site.DESCRIPTION LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('sites', $this->paginate());     
            else:
                $this->redirect(array('action'=>'index'));
            endif;                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }    

    /**
     * renvois la liste des sites pour les selects
     * 
     * @return array
     */
    public function get_list(){
        return $this->Site->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc'),'recursive'=>0));
    }

    /**
     * renvois la liste des sites
     * 
     * @return array
     */
    public function get_all(){
        return $this->Site->find('all',array('order'=>array('NOM'=>'asc'),'recursive'=>0));
    }           
}
