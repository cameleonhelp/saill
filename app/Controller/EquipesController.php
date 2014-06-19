<?php
App::uses('AppController', 'Controller');
/**
 * Equipes Controller
 *
 * @property Equipe $Equipe
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class EquipesController extends AppController {

    /**
     *
     */
    public $components = array('History','Common'); 
    
    /**
     * index method
     */
//	public function index() {
//		$this->Equipe->recursive = 0;
//		$this->set('equipes', $this->paginate());
//	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function view($id = null) {
//		if (!$this->Equipe->exists($id)) {
//			throw new NotFoundException(__('Invalid equipe'));
//		}
//		$options = array('conditions' => array('Equipe.' . $this->Equipe->primaryKey => $id));
//		$this->set('equipe', $this->Equipe->find('first', $options));
//	}

    /**
     * Ajoute un agent à l'équipe
     */
    public function add() {
            if ($this->request->is('post')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Equipe->validate = array();
                    $this->History->notmove();
                else:                    
                    $this->Equipe->create();
                    foreach ($this->request->data['Equipe']['agents'] as $agent) {
                        $this->request->data['Equipe']['agent']=$agent;
                        $this->Equipe->create();
                        if ($this->Equipe->save($this->request->data)) {
                                $this->Session->setFlash(__('Nouvel(s) agent(s) ajouté(s)',true),'flash_success');
                        } else {
                                $this->Session->setFlash(__('Au moins un nouvel agent <b>N\'A PAS ETE</b> ajouté',true),'flash_failure');
                        }
                    }   
                    $this->History->goback(1);
                endif;
            }
            $utilisateurs = $this->Equipe->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.ACTIF'=>1,'Utilisateur.profil_id >'=>0),'order'=>array('NOMLONG'=>'asc'),'recursive'=>-1));
            $this->set('utilisateurs',$utilisateurs);
    }

    /**
     * modification de 
     * 
     * @param type $id
     * @throws NotFoundException
     */
//    public function edit($id = null) {
//            if (!$this->Equipe->exists($id)) {
//                    throw new NotFoundException(__('Invalid equipe'));
//            }
//            if ($this->request->is('post') || $this->request->is('put')) {
//                if (isset($this->params['data']['cancel'])) :
//                    $this->Equipe->validate = array();
//                    $this->History->goBack(1);
//                else:                    
//                    if ($this->Equipe->save($this->request->data)) {
//                            $this->Session->setFlash(__('The equipe has been saved'));
//                            $this->redirect(array('action' => 'index'));
//                    } else {
//                            $this->Session->setFlash(__('The equipe could not be saved. Please, try again.'));
//                    }
//                endif;
//            } else {
//                    $options = array('conditions' => array('Equipe.' . $this->Equipe->primaryKey => $id));
//                    $this->request->data = $this->Equipe->find('first', $options);
//            }
//    }

    /**
     * supprime un agent de l'équipe
     * 
     * @param type $id
     * @throws NotFoundException
     */
    public function delete($id = null) {
            $this->Equipe->id = $id;
            if (!$this->Equipe->exists()) {
                    throw new NotFoundException(__('Agent invalide'));
            }
            if ($this->Equipe->delete()) {
                    $this->Session->setFlash(__('Agent supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Agent <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(1);
    }

    /**
     * liste l'équipe de l'utilisateur
     * 
     * @param string $id
     * @return string
     */
    public function myTeam($id = null){
        $result = '';
        $agents = $this->Equipe->find('all',array('conditions'=>array('Equipe.utilisateur_id'=>$id)));
        foreach($agents as $agent):
            $result .= $agent['Equipe']['agent'].",";
        endforeach;
        return $result;
    }

    /**
     * liste toute l'équipe d'un utilisateur
     * 
     * @param string $id
     * @return array
     */
    public function allMyTeam($id = null){
        $result = '';
        $agents = $this->Equipe->find('all',array('conditions'=>array('Equipe.utilisateur_id'=>$id)));
        return $agents;
    }

    /**
     * liste l'équipe de l'utilisateur
     * 
     * @param string $id
     * @return array
     */
    public function listMyTeam($id = null){
        $result = '';
        $in = '';
        $agents = $this->Equipe->find('all',array('conditions'=>array('Equipe.utilisateur_id'=>$id)));
        foreach($agents as $agent):
            $in .= $agent['Equipe']['agent'].",";
        endforeach;
        $in = ($in != ',' || $in != '') ? $in.$id : $id;
        $list = $this->Equipe->Utilisateur->find('list',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id in ('.$in.')')));
        return $list;
    }        

    /**
     * liste toute l'équipe d'un utilisateur
     * 
     * @param string $id
     * @return array
     */
    public function getMyTeam($id = null){
        $result = '';
        $in = '';
        $agents = $this->Equipe->find('all',array('conditions'=>array('Equipe.utilisateur_id'=>$id)));
        foreach($agents as $agent):
            $in .= $agent['Equipe']['agent'].",";
        endforeach;
        $in = ($in != ',' || $in != '') ? $in.$id : $id;
        $list = $this->Equipe->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id in ('.$in.')')));
        return $list;
    }   

    /**
     * enregistre la couleur sélectionnée (Ajax)
     * 
     * @param type $id
     * @param string $color
     */
    public function saveColor($id,$color){
        $this->Equipe->id = $id;
        $color = "#".$color;
        if ($this->Equipe->saveField('COLOR', $color)):
            //$this->Session->setFlash(__('Choix de couleur enregistré',true),'flash_success');
        else :
            //$this->Session->setFlash(__('Choix de couleur <b>NON</b> enregistré',true),'flash_failure');
        endif;
        exit();
    }
}
