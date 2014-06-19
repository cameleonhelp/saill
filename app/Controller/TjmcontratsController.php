<?php
App::uses('AppController', 'Controller');
/**
 * Tjmcontrats Controller
 *
 * @property Tjmcontrat $Tjmcontrat
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class TjmcontratsController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $components = array('History','Common'); 
    public $paginate = array(
    'limit' => 25,
    'order' => array('Tjmcontrat.TJM' => 'asc'),
    );
    
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "TJM contrats" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }          

    /**
     * liste les tjms contrat
     * 
     * @throws UnauthorizedException
     */
    public function index() {
        $this->set_title();
        if (isAuthorized('tjmcontrats', 'index')) :
            $this->Tjmcontrat->recursive = 0;
            $this->set('tjmcontrats', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * ajoute un tjm contrat
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('tjmcontrats', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Tjmcontrat->validate = array();
                    $this->History->goBack(1);
                else:                     
                    $this->Tjmcontrat->create();
                    if ($this->Tjmcontrat->save($this->request->data)) {
                            $this->Session->setFlash(__('TJM contrat sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('TJM contrat incorrect, veuillez corriger le TJM contrat',true),'flash_failure');
                    }
                endif;
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * met à jour le tjm contrat
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('tjmcontrats', 'edit')) :
            if (!$this->Tjmcontrat->exists($id)) {
                    throw new NotFoundException(__('TJM contrat incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Tjmcontrat->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Tjmcontrat->save($this->request->data)) {
                            $this->Session->setFlash(__('TJM contrat sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('TJM contrat incorrect, veuillez corriger le TJM contrat',true),'flash_failure');
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Tjmcontrat.' . $this->Tjmcontrat->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Tjmcontrat->find('first', $options);
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * supprime le tjm contrat
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('tjmcontrats', 'delete')) :
            $this->Tjmcontrat->id = $id;
            if (!$this->Tjmcontrat->exists()) {
                    throw new NotFoundException(__('TJM contrat incorrect'));
            }
            if ($this->Tjmcontrat->delete()) {
                    $this->Session->setFlash(__('TJM contrat supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('TJM contrat <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * recherche de tjm contrat
     * 
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($keywords=null) {
        $this->set_title();
        if (isAuthorized('tjmcontrats', 'index')) :
            if(isset($this->params->data['Tjmcontrat']['SEARCH'])):
                $keywords = $this->params->data['Tjmcontrat']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Tjmcontrat.TJM LIKE '%".$value."%'","Tjmcontrat.ANNEE LIKE '%".$value."%'"));
                endforeach;
                $conditions = array('OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('tjmcontrats', $this->paginate());                   
            else:
                $this->redirect(array('action'=>'index'));
            endif;              
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }      

    /**
     * renvois la liste de tous les tjm contrat
     * 
     * @return array
     */
    public function get_all(){
        $conditions[] = '1=1';
        return $this->Tjmcontrat->find('all',array('conditions'=>$conditions,'recursive'=>0));
    }

    /**
     * renvois la liste des tjm contrat pour les selects
     * 
     * @return type
     */
    public function get_list(){
        $conditions[] = '1=1';
        return $this->Tjmcontrat->find('list',array('fields'=>array('Tjmcontrat.id','Tjmcontrat.TJM'),'conditions'=>$conditions,'recursive'=>0));
    }        
}
