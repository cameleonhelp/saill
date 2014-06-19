<?php
App::uses('AppController', 'Controller');
App::uses('EntitesController', 'Controller');
/**
 * Assoentiteutilisateurs Controller
 *
 * @property Assoentiteutilisateur $Assoentiteutilisateur
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class AssoentiteutilisateursController extends AppController {

    /**
     * varaibles globales utilisées dans le controller
     */
    public $components = array('History','Common');  

    /**
     * sauvegarde l'association utilisateur -> cercle de visibilité
     */
    public function save() {
        $this->autoRender = false;
        $bsave = array();
        $listusers = $this->request->data['Assoentiteutilisateur']['utilisateurs_id'];
        $entite = $this->request->data['Assoentiteutilisateur']['entite_id'];
        if($entite != ''):
            $users = explode(',',$listusers);
            $sql = "DELETE FROM assoentiteutilisateurs WHERE entite_id=".$entite;
            $this->Assoentiteutilisateur->query($sql);
            if ($listusers != ''):
                foreach($users as $key=>$value):
                    $record = array();
                    $fields = array('Assoentiteutilisateur.id');
                    $conditions[] = array('Assoentiteutilisateur.entite_id'=>$entite);
                    $record['Assoentiteutilisateur']['entite_id']= $entite;
                    $conditions[] = array('Assoentiteutilisateur.utilisateur_id'=>$value);
                    $record['Assoentiteutilisateur']['utilisateur_id']= $value;
                    $this->Assoentiteutilisateur->create();
                    $record['Assoentiteutilisateur']['created']= date('Y-m-d H:i:s');
                    $record['Assoentiteutilisateur']['modified']= date('Y-m-d H:i:s');
                    if($this->Assoentiteutilisateur->save($record)):
                        $bsave[] = true;
                    else:
                        $bsave[] = false;
                    endif;
                endforeach;
                if(in_array(false, $bsave)):
                    $this->Session->setFlash(__('Certaines informations sont incorrectes et ne sont pas sauvegardées',true),'flash_warning');
                else:
                    $this->Session->setFlash(__('Informations sauvegardées',true),'flash_success');
                endif;
            else:
                $this->Session->setFlash(__('Informations sauvegardées',true),'flash_success');
            endif;
        else:
            $this->Session->setFlash(__('Informations sur le cercle de visibilité incorrectes, veuillez corriger les informations',true),'flash_failure');
        endif;
        $this->History->goBack(1);
    }    

    /**
     * sauvegarde silencieuse
     * 
     * @param int $entite_id
     * @param int $utilisateur_id
     */
    public function silent_save($entite_id,$utilisateur_id){
        //supression de l'existant
        $sql = "DELETE FROM assoentiteutilisateurs WHERE utilisateur_id=".$utilisateur_id;
        $this->Assoentiteutilisateur->query($sql);
        //sauvegarde du nouvel enregistrement
        $record = array();
        $record['Assoentiteutilisateur']['entite_id']= $entite_id;
        $record['Assoentiteutilisateur']['utilisateur_id']= $utilisateur_id;
        $record['Assoentiteutilisateur']['created']= date('Y-m-d H:i:s');
        $record['Assoentiteutilisateur']['modified']= date('Y-m-d H:i:s');
        $this->Assoentiteutilisateur->create();
        $this->Assoentiteutilisateur->save($record);           
    }

    /**
     * mise à jour dynamique 
     * 
     * @param int $entite_id
     * @param int $utilisateur_id
     */
    public function silent_update($entite_id,$utilisateur_id){
        $this->Assoentiteutilisateur->updateAll(array('entite_id'=>$entite_id), array('utilisateur_id'=>$utilisateur_id));        
    }          

    /**
     * retourne tous les utilisateurs pour une entité
     * 
     * @param int $entite
     * @return Utilisateurs
     */
    public function json_get_users($entite=null){
        $this->autoRender = false;
        $list = '';
        $obj = $this->Assoentiteutilisateur->find('all', array('fields'=>array('Assoentiteutilisateur.utilisateur_id'),'conditions' => array('Assoentiteutilisateur.entite_id' => $entite),'recursive'=>0));
        $results = isset($obj) ? $obj : 'null';
        foreach ($results as $result):
            $list .= trim($result['Assoentiteutilisateur']['utilisateur_id']).',';
        endforeach;
        return trim(substr_replace($list ,"",-1));
    }

    /**
     * compte le nombre d'association pour une entité
     * 
     * @param int $entite
     * @return int
     */
    public function count($entite=null){
        if($entite != null):
            $count = $this->Assoentiteutilisateur->find('count',array('conditions' => array('Assoentiteutilisateur.entite_id' => $entite),'recursive'=>0));
            return $count;
        endif;
    }

    /**
     * suppression des associations d'un utilisateur
     * 
     * @param int $id de l'utilisateur
     */
    public function delete_for_user($id = null){
        $conditions[] = 'Assoentiteutilisateur.utilisateur_id='.$id;
        $this->Assoentiteutilisateur->deleteAll($conditions);
    }

    /**
     * liste toutes les entités pour le compte d'un utilisateur
     * 
     * @param int $id utilisateur
     * @return string
     */
    public function json_get_my_entite($id = null){
        $this->autoRender = false;
        $list = '';
        if(userAuth('profil_id') != 1):
            $condition = $id == null ? array('1=1') : array('Assoentiteutilisateur.utilisateur_id' => $id);
            $obj = $this->Assoentiteutilisateur->find('all', array('fields'=>array('Assoentiteutilisateur.entite_id'),'conditions' => $condition,'group'=>'Assoentiteutilisateur.entite_id','order'=>array('Assoentiteutilisateur.entite_id'=>"asc"),'recursive'=>-1));
            $results = count($obj)>0 ? $obj : 'null';
            if($results!='null'):
                foreach ($results as $result):
                    $list .= $result['Assoentiteutilisateur']['entite_id'].',';
                endforeach;
                return substr_replace($list ,"",-1);
            else:
                return '0';
            endif;
        else:
            $ObjEntites = new EntitesController();
            $obj = $ObjEntites->get_all();
            foreach ($obj as $result):
                $list .= $result['Entite']['id'].',';
            endforeach;
            return substr_replace($list ,"",-1);            
        endif;
    }

    /**
     * retourne tous les utilisateurs d'une liste d'entité
     * 
     * @param string $entite
     * @return string
     */
    public function json_get_all_users_entite($entite){
        $this->autoRender = false;
        $list = '';
        $obj = $this->Assoentiteutilisateur->find('all', array('conditions' => array('Assoentiteutilisateur.entite_id IN ('.$entite.')'),'order'=>array('Assoentiteutilisateur.utilisateur_id'=>'asc'),'group'=>'Assoentiteutilisateur.utilisateur_id','recursive'=>0));
        $results = isset($obj) ? $obj : 'null';
        if($results!='null'):            
            foreach ($results as $result):
                $list .= $result['Assoentiteutilisateur']['utilisateur_id'].',';
            endforeach;
            return substr_replace($list ,"",-1);
        else:
            return '0';
        endif;            
    }   

    /**
     * autorise l'utilisation sans authentification de certaines méthodes
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_all_users','json_get_all_users_actif_nogenerique','json_get_all_users_entite','json_get_all_users_nogenerique','json_get_my_entite','json_get_users'));
        parent::beforeFilter();
    }   

    /**
     * retourne la liste des utilisateur qui sont dans les mêmes entités que l'utilisateur
     * 
     * @param int $id utilisateur
     * @return string
     */
    public function json_get_all_users($id=null){
        $this->autoRender = false;
        $entite = $this->json_get_my_entite($id);   
        if($entite != '0'):
            $list = '';
            $obj = $this->Assoentiteutilisateur->find('all', array('conditions' => array('Assoentiteutilisateur.entite_id IN ('.$entite.')'),'order'=>array('Assoentiteutilisateur.utilisateur_id'=>'asc'),'group'=>'Assoentiteutilisateur.utilisateur_id','recursive'=>-1));
            $results = count($obj)>0 ? $obj : 'null';
            if($results!='null'):
                foreach ($results as $result):
                    $list .= $result['Assoentiteutilisateur']['utilisateur_id'].',';
                endforeach;
                return substr_replace($list ,"",-1);
            else:
                return '0';
            endif;     
        else:
            return '0';
        endif;             
    }    

    /**
     * trouve les sections des entités d'un utilisateur
     * 
     * @param int $id utilisateur
     * @return array
     */
    public function find_array_section($id){
        $entite = $this->json_get_my_entite($id);
        $array = array();
        if($entite != '0'):
            $obj = $this->Assoentiteutilisateur->find('all', array('conditions' => array('Assoentiteutilisateur.entite_id IN ('.$entite.')','Utilisateur.section_id IS NOT NULL'),'order'=>array('Utilisateur.section_id'=>'asc'),'group'=>'Utilisateur.section_id','recursive'=>0));
            if(count($obj) > 0):
                foreach ($obj as $result):
                    $array[] = $result['Utilisateur']['section_id'];
                endforeach;
            endif;     
        endif;  
        return $array;
    }   

    /**
     * trouve les sections des entités d'un utilisateur
     * 
     * @param int $id utilisateur
     * @return string
     */
    public function find_all_section($id){
        $entite = $this->json_get_my_entite($id);   
        if($entite != '0'):
            $list = '';
            $obj = $this->Assoentiteutilisateur->find('all', array('conditions' => array('Assoentiteutilisateur.entite_id IN ('.$entite.')','Utilisateur.section_id IS NOT NULL'),'order'=>array('Utilisateur.section_id'=>'asc'),'group'=>'Utilisateur.section_id','recursive'=>0));
            $results = isset($obj) ? $obj : 'null';
            if($results!='null'):
                foreach ($results as $result):
                    $list .= $result['Utilisateur']['section_id'].',';
                endforeach;
                return substr_replace($list ,"",-1);
            else:
                return '0';
            endif;     
        else:
            return '0';
        endif;             
    }      

    /**
     * trouve tous les utilisateurs actif et non générique des entités de l'utilisateur
     * 
     * @param int $id utilisateur
     * @return string
     */
    public function json_get_all_users_actif_nogenerique($id){
        $entite = $this->json_get_my_entite($id);   
        if($entite != '0'):
            $list = '';
            $obj = $this->Assoentiteutilisateur->find('all', array('conditions' => array('Assoentiteutilisateur.entite_id IN ('.$entite.')','Utilisateur.profil_id != -1','Utilisateur.ACTIF'=>1),'order'=>array('Assoentiteutilisateur.utilisateur_id'=>'asc'),'group'=>'Assoentiteutilisateur.utilisateur_id','recursive'=>0));
            $results = isset($obj) ? $obj : 'null';
            if($results!='null'):
                foreach ($results as $result):
                    $list .= $result['Assoentiteutilisateur']['utilisateur_id'].',';
                endforeach;
                return substr_replace($list ,"",-1);
            else:
                return '0';
            endif;     
        else:
            return '0';
        endif;  
    }

    /**
     * trouve tous les utilisateurs actif et non générique d'une entité
     * 
     * @param int $id entité
     * @return string
     */
    public function json_get_all_users_actif_nogenerique_for_entite($id){
        $list = '';
        $obj = $this->Assoentiteutilisateur->find('all', array('conditions' => array('Assoentiteutilisateur.entite_id'=>$id,'Utilisateur.profil_id != -1','Utilisateur.ACTIF'=>1),'order'=>array('Assoentiteutilisateur.utilisateur_id'=>'asc'),'group'=>'Assoentiteutilisateur.utilisateur_id','recursive'=>0));
        $results = isset($obj) ? $obj : 'null';
        if($results!='null'):
            foreach ($results as $result):
                $list .= $result['Assoentiteutilisateur']['utilisateur_id'].',';
            endforeach;
            return substr_replace($list ,"",-1);
        else:
            return '0';
        endif;     
    }

    /**
     * trouve tous les utilisateurs actif et non générique des entités de l'utilisateur et d'une section
     * 
     * @param int $id utilisateur
     * @param int $section identifiant 
     * @return string
     */    
    public function json_get_all_users_nogenerique($id,$section=null){
        $entite = $this->json_get_my_entite($id); 
        if($entite != '0'):
            $list = '';
            $condition=array('Assoentiteutilisateur.entite_id IN ('.$entite.')','OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id'=>-2));
            $obj = $this->Assoentiteutilisateur->find('all', array('conditions' => $condition ,'order'=>array('Assoentiteutilisateur.utilisateur_id'=>'asc'),'group'=>'Assoentiteutilisateur.utilisateur_id','recursive'=>0));
            $results = count($obj)>0 ? $obj : 'null';
            if($results!='null'):              
                foreach ($results as $result):
                    if($section != null && in_array($result['Utilisateur']['societe_id'],$section)):
                        $list .= $result['Utilisateur']['id'].',';
                    elseif($section == null):
                        $list .= $result['Assoentiteutilisateur']['utilisateur_id'].',';
                    endif;
                endforeach;
                return substr_replace($list ,"",-1);
            else:
                return '0';
            endif;     
        else:
            return '0';
        endif;  
    }   

    /**
     * trouve tous les utilisateurs actif et générique des entités de l'utilisateur et d'une section
     * 
     * @param int $id utilisateur
     * @param int $section identifiant 
     * @return string
     */      
    public function json_get_all_users_and_generique($id,$section=null){
        $entite = $this->json_get_my_entite($id); 
        if($entite != '0'):
            $list = '';
            $condition=array('Assoentiteutilisateur.entite_id IN ('.$entite.')','Utilisateur.ACTIF'=>1);
            $obj = $this->Assoentiteutilisateur->find('all', array('conditions' => $condition ,'order'=>array('Assoentiteutilisateur.utilisateur_id'=>'asc'),'group'=>'Assoentiteutilisateur.utilisateur_id','recursive'=>0));
            $results = count($obj)>0 ? $obj : 'null';
            if($results!='null'):              
                foreach ($results as $result):
                    if($section != null && in_array($result['Utilisateur']['societe_id'],$section)):
                        $list .= $result['Utilisateur']['id'].',';
                    elseif($section == null):
                        $list .= $result['Assoentiteutilisateur']['utilisateur_id'].',';
                    endif;
                endforeach;
                return substr_replace($list ,"",-1);
            else:
                return '0';
            endif;     
        else:
            return '0';
        endif;  
    }  

    /**
     * trouve tous les utilisateur d'une société
     * 
     * @param string $list des identitifants des sociétés
     * @return Utilisateurs
     */
    public function get_all_utilisateur_for_societe($list){
        $list = implode(',',$list); 
        $listusers = $this->json_get_all_users_nogenerique(userAuth('id'),$list); 
        $users =  $this->Assoentiteutilisateur->Utilisateur->find('all', array('conditions' => array('Utilisateur.id IN ('.$listusers.')','Utilisateur.profil_id > 0'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));            
        return $users;            
    }

    /**
     * trouve les utilisateurs sur les entités d'un utilisateur
     * 
     * @param int $userid
     * @return array
     */
    public function get_list_utilisateur($userid){
        $entite = $this->json_get_my_entite($userid);
        $strusers = $this->json_get_all_users_entite($entite);
        $strusers = $strusers!='' ? $strusers : '0';
        $fields = array('Utilisateur.id','Utilisateur.NOMLONG');
        $conditions = array('Utilisateur.id IN ('.$strusers.')');
        $order = array('Utilisateur.NOMLONG'=>'asc');
        $users = $this->Assoentiteutilisateur->Utilisateur->find('list',  array('fields'=>$fields,'conditions'=>$conditions,'order'=>$order,'recursive'=>0));
        return count($users) > 0 ? $users : array();
    }
}
