<?php
App::uses('AppController', 'Controller');
/**
 * Actioncontributeurs Controller
 *
 * @property Actioncontributeur $Actioncontributeur
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class ActioncontributeursController extends AppController {

    /**
     * Composants de la classe
     */
    public $components = array('History','Common');

    /**
     * Méthode qui permet d'autoriser l'utilisation de méthode sans authentification
     */
    public function beforeFilter() {   
        //$this->Auth->allow(array('json_get_this'));
        parent::beforeFilter();
    }   

    /**
     * Méthode utilisé lors du post bac sur la page
     */
    public function beforeRender() {             
        parent::beforeRender();
    }

    /**
     * Méthode permettant de compter le nombre de contributeurs pour une action
     * 
     * @param int $action_id
     * @return int
     */
    public function count_contributeurs($action_id){
        return $this->Actioncontributeur->find('count',array('conditions'=>array('Actioncontributeur.action_id'=>$action_id),'recursive'=>-1));
    }

    /**
     * Méthode permettant de retourner la liste des contributeurs par leur id
     * 
     * @param int $action_id
     * @return string
     */
    public function str_contributeurs($action_id){
        $users = $this->Actioncontributeur->find('all',array('conditions'=>array('Actioncontributeur.action_id'=>$action_id),'recursive'=>-1));
        $result = "";
        foreach ($users as $user):
            $result .= $user['Actioncontributeur']['utilisateur_id'].',';
        endforeach;
        return substr_replace($result ,"",-1);
    }        

    /**
     * Méthode pour enregistrer les contributeurs d'une action
     * 
     * @param int $action_id
     * @param string $users_id séparé par des virgules
     */
    public function save($action_id,$users_id){
        $this->autoRender = false;
        $conditions = array('Actioncontributeur.action_id'=>$action_id);
        $this->Actioncontributeur->deleteAll($conditions,false);
        $ids_tosave = explode(',',$users_id);
        foreach($ids_tosave as $id): 
            $record['Actioncontributeur']['action_id'] = $action_id;
            $record['Actioncontributeur']['utilisateur_id'] = $id;
            $record['Actioncontributeur']['created'] = date('Y-m-d');
            $record['Actioncontributeur']['modified'] = date('Y-m-d');
            $this->Actioncontributeur->create();
            $this->Actioncontributeur->save($record);
        endforeach;
    }
}
