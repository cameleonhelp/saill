<?php
App::uses('AppController', 'Controller');
/**
 * Expressionbesoins Controller
 *
 * @property Expressionbesoin $Expressionbesoin
 * @property PaginatorComponent $Paginator
 */
class ExpressionbesoinsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Expressionbesoin.modified'=>'desc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($application=null,$etat=null,$type=null,$perimetre=null) {
            $this->set('title_for_layout','Environnements'); 
            if (isAuthorized('expressionbesoins', 'index')) :  
                $listentite = $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.userAuth('id'));
                $newconditions[]="Expressionbesoin.entite_id IN (".$listentite.')';                
                switch($application):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter = ', pour toutes les applications';
                        break;
                    default :
                        $newconditions[]="Expressionbesoin.application_id=".$application;
                        $nom = $this->Expressionbesoin->Application->findById($application);
                        $strfilter = ', pour l\'application '.$nom['Application']['NOM'];
                        break;
                endswitch;
                switch($etat):
                    case null:
                    case 'actif':
                        $newconditions[]="Expressionbesoin.etat_id < 4";
                        $strfilter .= ', avec un état actif';
                        break;                          
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= '';
                        break;                         
                    default :
                        $newconditions[]="Expressionbesoin.etat_id=".$etat;
                        $nom = $this->Expressionbesoin->Etat->findById($etat);
                        $strfilter .= ', '.$nom['Etat']['NOM'];
                        break;                   
                endswitch;                     
                switch($type):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= ', pour tous les environnements';
                        break;
                    default:
                        $newconditions[]="Expressionbesoin.type_id=".$type;
                        $nom = $this->Expressionbesoin->Type->findById($type);
                        $strfilter .= ', pour l\'environnement '.$nom['Type']['NOM'];
                        break;
                endswitch;   
                switch($perimetre):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= '';
                        break;
                    default:
                        $newconditions[]="Expressionbesoin.perimetre_id=".$perimetre;
                        $nom = $this->Expressionbesoin->Perimetre->findById($perimetre);
                        $strfilter .= ', pour le périmétre '.$nom['Perimetre']['NOM'];
                        break;
                endswitch;                 
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->Expressionbesoin->recursive = 0;
                $export = $this->Expressionbesoin->find('all',array('conditions'=>$newconditions,'order' => array('Expressionbesoin.id' => 'desc'),'recursive'=>0));
                $this->Session->delete('xls_export');
                $this->Session->write('xls_export',$export);                 
		$this->set('expressionbesoins', $this->paginate());
                $applications = $this->requestAction('applications/get_list/1');
                $types = $this->requestAction('types/get_list/1');
                $perimetres = $this->requestAction('perimetres/get_list/1');
                $etats = $this->requestAction('etats/get_list/1');
		$this->set(compact('applications','types','perimetres','etats'));    
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Expressionbesoin->exists($id)) {
			throw new NotFoundException(__('Invalid expressionbesoin'));
		}
		$options = array('conditions' => array('Expressionbesoin.' . $this->Expressionbesoin->primaryKey => $id));
		$this->set('expressionbesoin', $this->Expressionbesoin->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Expression des besoins'); 
            if (isAuthorized('expressionbesoins', 'add')) : 
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Expressionbesoin->validate = array();
                        $this->History->goBack(1);
                    else:           
                        $this->request->data['Expressionbesoin']['entite_id']=userAuth('entite_id');
			$this->Expressionbesoin->create();
			if ($this->Expressionbesoin->save($this->request->data)) {
                                $id = $this->Expressionbesoin->getLastInsertID();
                                $this->saveHistory($id);
                                $expb = $this->Expressionbesoin->find('all',array('conditions'=>array('Expressionbesoin.id'=>$id),'recursive'=>0));
                                $this->sendmailajout($expb);
				$this->Session->setFlash(__('Expression du besoin sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Expression du besoin incorrect, veuillez corriger l\'expression du besoin',true),'flash_failure');
			}
                    endif;
		}
                $applications = $this->requestAction('applications/get_select/1');
                $types = $this->requestAction('types/get_select/1');
                $perimetres = $this->requestAction('perimetres/get_select/1');
                $etats = $this->requestAction('etats/get_select/1');                
		$composants = $this->requestAction('composants/get_select/1'); 
		$lots = $this->requestAction('lots/get_select/1'); 
		$phases = $this->requestAction('phases/get_select/1'); 
		$volumetries = $this->requestAction('volumetries/get_select/1'); 
		$puissances = $this->requestAction('puissances/get_select/1'); 
		$architectures = $this->requestAction('architectures/get_select/1'); 
                $dsitenvs = array();
		$this->set(compact('applications', 'composants', 'perimetres', 'lots', 'etats', 'types', 'phases', 'volumetries', 'puissances', 'architectures','dsitenvs'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            $this->set('title_for_layout','Expression des besoins'); 
            if (isAuthorized('expressionbesoins', 'edit')) : 
		if (!$this->Expressionbesoin->exists($id)) {
			throw new NotFoundException(__('Invalid expressionbesoin'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Expressionbesoin->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Expressionbesoin->save($this->request->data)) {
                                $this->saveHistory($id);
				$this->Session->setFlash(__('Expression du besoin modifée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Expression du besoin incorrect, veuillez corriger l\'expression du besoin',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Expressionbesoin.' . $this->Expressionbesoin->primaryKey => $id));
			$this->request->data = $this->Expressionbesoin->find('first', $options);
		}
                $applications = $this->requestAction('applications/get_select/1');
                $types = $this->requestAction('types/get_select/1');
                $perimetres = $this->requestAction('perimetres/get_select/1');
                $etats = $this->requestAction('etats/get_select/1');                
		$composants = $this->requestAction('composants/get_select/1'); 
		$lots = $this->requestAction('lots/get_select/1'); 
		$phases = $this->requestAction('phases/get_select/1'); 
		$volumetries = $this->requestAction('volumetries/get_select/1'); 
		$puissances = $this->requestAction('puissances/get_select/1'); 
		$architectures = $this->requestAction('architectures/get_select/1'); 
                $histories = $this->requestAction('historyexpbs/get_list/'.$id);
                $dsitenvs = $this->requestAction('dsitenvs/get_select_for_application/'.$this->request->data['Expressionbesoin']['application_id']);
		$this->set(compact('applications', 'composants', 'perimetres', 'lots', 'etats', 'types', 'phases', 'volumetries', 'puissances', 'architectures','histories','dsitenvs'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$loop=false) {
            $this->set('title_for_layout','Expression des besoins');            
            if (isAuthorized('expressionbesoins', 'delete')) : 
		$this->Expressionbesoin->id = $id;
		if (!$this->Expressionbesoin->exists()) {
			throw new NotFoundException(__('Expression du besoin incorrecte'));
		}
                $obj = $this->Expressionbesoin->find('first',array('conditions'=>array('Expressionbesoin.id'=>$id),'recursive'=>0));
                if($obj['Expressionbesoin']['ACTIF']==1):
                    $newactif = $obj['Expressionbesoin']['ACTIF'] == 1 ? 0 : 1;
                    $newetat = $newactif == 0 ? 4 : 1; //mise à jour du statut état qui est une donnée référentielle et qui peut donc être modifié !!!! pas top
                    if ($this->Expressionbesoin->saveField('ACTIF',$newactif) && $this->Expressionbesoin->saveField('etat_id',$newetat)) {
                            $this->saveHistory($id);
                            if ($newactif==0):
                                $this->Session->setFlash(__('Expression du besoin suppriméee',true),'flash_success');
                                if($loop) : return true; endif;
                            else:
                                $this->Session->setFlash(__('Expression du besoin activée',true),'flash_success');
                                if($loop) : return true; endif;
                            endif;
                    } else {
                            if ($newactif==0):
                                $this->Session->setFlash(__('Expression du besoin <b>NON</b> suppriméee',true),'flash_success');
                                if($loop) : return true; endif;
                            else:
                                $this->Session->setFlash(__('Expression du besoin <b>NON</b> activée',true),'flash_success');
                                if($loop) : return true; endif;
                            endif;                    
                    }
                    if(!$loop) : $this->History->notmove();  
                    else:
                        return true;
                    endif;
                else:
                    if($this->Expressionbesoin->delete()):                      
                        $this->Session->setFlash(__('Expression du besoin suppriméee',true),'flash_success');
                        if(!$loop) : $this->History->goBack(1); 
                        else:
                            return true;
                        endif;
                    else:
                        $this->Session->setFlash(__('Expression du besoin <b>NON</b> suppriméee',true),'flash_failure');
                        if($loop) : return false; endif;
                    endif;
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        public function ajax_actif($id=null){
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;                
                $this->Expressionbesoin->id = $newid;
                $obj = $this->Expressionbesoin->find('first',array('conditions'=>array('Expressionbesoin.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Expressionbesoin']['ACTIF'] == 1 ? 0 : 1;
                $newetat = $newactif == 0 ? 4 : 1; //mise à jour du statut état qui est une donnée référentielle et qui peut donc être modifié !!!! pas top
		if ($this->Expressionbesoin->saveField('ACTIF',$newactif) && $this->Expressionbesoin->saveField('etat_id',$newetat)) {
                        $this->saveHistory($newid);
			if ($id==null):
                            $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
                        else:
                            $result = true;
                        endif;
		} else {
			if ($id==null):
                           $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
                        else:
                            $result = false;
                        endif;                        
		}
		if ($id==null):
                    exit();
                else:
                    return $result;
                endif;
        } 
        
        public function deleteall($id){
            if($this->request->data('id')!==''):
                $ids = explode('-', $this->request->data('id'));
                if(count($ids)>0 && $ids[0]!=""):
                    foreach($ids as $newid):
                        if($this->delete($newid,true)):
                            echo $this->Session->setFlash(__('Modification du statut supprimé pris en compte pour toutes les expressions de besoin sélectionnées',true),'flash_success'); 
                        else :
                            $this->Session->setFlash(__('Modification du statut supprimé <b>NON</b> pris en compte pouter toutes les expressions de besoin sélectionnées',true),'flash_failure');
                        endif;
                    endforeach; 
                    sleep(3);
                    //$this->History->goBack(1);
                endif;
            else :
                $this->Session->setFlash(__('Aucune expresion de besoin sélectionnée',true),'flash_failure');
            endif;
        }         
        
/**
 * dupliquer method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function dupliquer($id = null) {
            if (isAuthorized('expressionbesoins', 'duplicate')) :
		$this->Expressionbesoin->id = $id;
                $record = $this->Expressionbesoin->read();
                unset($record['Expressionbesoin']['id']);
                unset($record['Expressionbesoin']['application_id']);  
                $record['Expressionbesoin']['application_id']=0;
                unset($record['Expressionbesoin']['etat_id']);  
                $record['Expressionbesoin']['etat_id']=0;                
                unset($record['Expressionbesoin']['COMMENTAIRE']);
                unset($record['Expressionbesoin']['DATELIVRAISON']);
                unset($record['Expressionbesoin']['DATEFIN']);
                unset($record['Expressionbesoin']['ACTIF']);
                unset($record['Expressionbesoin']['URL']);
                unset($record['Expressionbesoin']['URLLOGIN']);
                unset($record['Expressionbesoin']['URLPASSWORD']);                
                unset($record['Expressionbesoin']['created']);                
                unset($record['Expressionbesoin']['modified']);
                $this->Expressionbesoin->create();
                if ($this->Expressionbesoin->save($record)) {
                        $this->Session->setFlash(__('Expression du besoin dupliquée',true),'flash_success');
                        $this->redirect(array('action'=>'edit',$this->Expressionbesoin->getLastInsertID()));
                } else {
                        $this->Session->setFlash(__('Expression du besoin incorrecte, veuillez corriger l\'expression du besoin',true),'flash_failure');
                }               
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	} 
        
        public function rapport(){
            $this->set('title_for_layout','Rapport environnements');
            if (isAuthorized('expressionbesoins', 'rapports')) :               
                $etats = $this->requestAction('etats/get_select/1');                
		$lots = $this->requestAction('lots/get_select/1'); 
                $perimetres = $this->requestAction('perimetres/get_select/1'); 
                $mois = array('01'=>'Janvier','02'=>'Février','03'=>'Mars','04'=>'Avril','05'=>'Mai','06'=>'Juin','07'=>'Juillet','08'=>'Août','09'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
                $fiveyearago = date('Y')-5;
                for($i=0;$i<6;$i++):
                    $year = $fiveyearago + $i;
                    $annee[$year]=$year;
                endfor;                
                $this->set(compact('etats','lots','perimetres', 'mois', 'annee')); 
                if ($this->request->is('post')):
                    $mois = $this->data['Expressionbesoin']['mois'];
                    $annee = $this->data['Expressionbesoin']['annee'];                     
                    $selectlot = $this->data['Expressionbesoin']['lot_id']=='' || $this->data['Expressionbesoin']['lot_id']=='4' ? '' : ' AND lot_id = '.$this->data['Expressionbesoin']['lot_id'];
                    $selectperimetre = $this->data['Expressionbesoin']['perimetre_id']=='' ? '' : ' AND perimetre_id = '.$this->data['Expressionbesoin']['perimetre_id'];
                    $thisetats = $this->data['Expressionbesoin']['etat_id'];
                    $listetats = '';
                    foreach($thisetats as $key => $value):
                        $listetats.=$value.',';
                    endforeach;
                    $selectetat = ' AND etat_id in ('.substr_replace($listetats ,"",-1).')';
                    $sql = "select count(expressionbesoins.id) as NB,MONTH(DATELIVRAISON) as MOIS, lots.NOM as LOT,applications.NOM as APPLICATION,etats.NOM as ETAT, perimetres.`NOM` AS PERIMETRE
                            from expressionbesoins
                            LEFT JOIN lots on expressionbesoins.lot_id = lots.id
                            LEFT JOIN applications on expressionbesoins.application_id = applications.id
                            LEFT JOIN perimetres on expressionbesoins.perimetre_id = perimetres.id
                            LEFT JOIN etats on expressionbesoins.etat_id = etats.id
                            WHERE (DATELIVRAISON IS NOT NULL AND  DATELIVRAISON <> '0000-00-00' AND MONTH(DATELIVRAISON) = ".$mois.
                            ") AND YEAR(DATELIVRAISON) = ".$annee." ".$selectlot.$selectperimetre.$selectetat.
                            " group by lot_id, application_id, perimetre_id,etat_id
                            order by MONTH(DATELIVRAISON) asc,lot_id asc, perimetre_id asc, application_id asc, etat_id asc;";
                    $results = $this->Expressionbesoin->query($sql);
                    $this->set('results',$results);
                    $chartsql = "select count(expressionbesoins.id) as NB, lots.NOM as LOT, perimetres.`NOM` AS PERIMETRE
                            from expressionbesoins
                            LEFT JOIN lots on expressionbesoins.lot_id = lots.id
                            LEFT JOIN perimetres on expressionbesoins.perimetre_id = perimetres.id
                            WHERE (DATELIVRAISON IS NOT NULL AND  DATELIVRAISON <> '0000-00-00' AND MONTH(DATELIVRAISON) = ".$mois.
                            ") AND YEAR(DATELIVRAISON) = ".$annee." ".$selectlot.$selectperimetre.$selectetat.
                            " group by lot_id, perimetre_id
                            order by lot_id asc, perimetre_id asc;";
                    $chartresults = $this->Expressionbesoin->query($chartsql);
                    /**
                     * retravailler le résultat pour mettre des zéro si plusieurs lots et applications différentes
                     */
                    $appresultsql= "select perimetres.NOM
                            from expressionbesoins
                            LEFT JOIN perimetres on expressionbesoins.perimetre_id = perimetres.id
                            WHERE (DATELIVRAISON IS NOT NULL AND  DATELIVRAISON <> '0000-00-00' AND MONTH(DATELIVRAISON) = ".$mois.
                            ") AND YEAR(DATELIVRAISON) = ".$annee." ".$selectlot.$selectperimetre.$selectetat.
                            " group by perimetre_id
                            order by perimetre_id asc;";
                    $appresult = $this->Expressionbesoin->query($appresultsql);
                    $lotresultsql= "select lots.NOM
                            from expressionbesoins
                            LEFT JOIN lots on expressionbesoins.lot_id = lots.id
                            WHERE (DATELIVRAISON IS NOT NULL AND  DATELIVRAISON <> '0000-00-00' AND MONTH(DATELIVRAISON) = ".$mois.
                            ") AND YEAR(DATELIVRAISON) = ".$annee." ".$selectlot.$selectperimetre.$selectetat.
                            " group by lot_id
                            order by lot_id asc;";
                    $lotresult = $this->Expressionbesoin->query($lotresultsql);                    
                    if(count($lotresult)>1):
                        $i = 0;
                        $array = array();
                        foreach($chartresults as $result):
                                $array[]=array($result['lots']['LOT'],$result['perimetres']['PERIMETRE']);
                        endforeach;
                        foreach($lotresult as $lot):
                            foreach($appresult as $app):
                                $completearray[]=array($lot['lots']['NOM'],$app['perimetres']['NOM']);
                            endforeach;
                            $i++;
                        endforeach;
                        $diff = narray_diff ($array,$completearray);
                        foreach($diff as $result):
                            $add[]=array(array('NB' => '0'),'lots' => array('LOT' => $result[0]),'perimetres' => array('PERIMETRE' => $result[1]));
                        endforeach;
                        if(isset($add) && is_array($add)):
                        $chartresults = array_merge($chartresults,$add);
                        else:
                            $chartresults = $chartresults;
                        endif;
                    endif;                    
                    $this->set('chartresults',$chartresults); 
                    /**
                     * Calcul du nombre d'environnements dans un état a valider, validé et livré sur tous les environnements
                     */
                    $chartcumulenv = "SELECT COUNT(expressionbesoins.id) AS NB, lots.NOM AS LOT, perimetres.NOM AS PERIMETRE
                                      FROM expressionbesoins
                                      LEFT JOIN lots ON expressionbesoins.lot_id = lots.id
                                      LEFT JOIN perimetres ON expressionbesoins.`perimetre_id` = perimetres.id
                                      WHERE `etat_id` IN (3) 
                                      GROUP BY perimetres.NOM,lots.NOM
                                      order by perimetre_id asc;"; //retiré les états 1 et 2 pour ne prendre que les livrés
                    $chartcumulenvresults = $this->Expressionbesoin->query($chartcumulenv);
                    $this->set('chartcumulenvresults',$chartcumulenvresults);
                    //TODO : piste de select 
                    //TODO : SELECT *,COUNT(id), CONCAT(MONTH(DATELIVRAISON),'/',YEAR(DATELIVRAISON)) FROM `historyexpbs` 
                    //TODO : WHERE `etat_id` = 3 AND DATELIVRAISON IS NOT NULL GROUP BY MONTH(DATELIVRAISON) 
                    //TODO : ORDER BY CONCAT(YEAR(DATELIVRAISON),IF(MONTH(DATELIVRAISON)<10,CONCAT('0',MONTH(DATELIVRAISON)),MONTH(DATELIVRAISON))) asc
                    $charthistosql = "select count(expressionbesoins.id) as NB,MONTH(DATELIVRAISON) as MOIS, lots.NOM as LOT
                            from expressionbesoins
                            LEFT JOIN lots on expressionbesoins.lot_id = lots.id
                            WHERE (DATELIVRAISON IS NOT NULL AND  DATELIVRAISON <> '0000-00-00'".
                            ") AND YEAR(DATELIVRAISON) = ".$annee." ".$selectlot.$selectperimetre.$selectetat.
                            " group by MONTH(DATELIVRAISON),lot_id
                            order by MONTH(DATELIVRAISON) asc,lot_id asc;";
                    $charthistoresults = $this->Expressionbesoin->query($charthistosql);
                    $this->set('charthistoresults',$charthistoresults);                    
                endif;                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
        }
        
        public function search(){
            if (isAuthorized('expressionbesoins', 'index')) :
                $keyword=isset($this->params->data['Expressionbesoin']['SEARCH']) ? $this->params->data['Expressionbesoin']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Application.NOM LIKE '%".$keyword."%'","Composant.NOM LIKE '%".$keyword."%'","Perimetre.NOM LIKE '%".$keyword."%'","Lot.NOM LIKE '%".$keyword."%'","Etat.NOM LIKE '%".$keyword."%'","Type.NOM LIKE '%".$keyword."%'","Phase.NOM LIKE '%".$keyword."%'","Volumetrie.NOM LIKE '%".$keyword."%'","Puissance.NOM LIKE '%".$keyword."%'","Architecture.NOM LIKE '%".$keyword."%'","Dsitenv.NOM LIKE '%".$keyword."%'","Expressionbesoin.USAGE LIKE '%".$keyword."%'","Expressionbesoin.NOMUSAGE LIKE '%".$keyword."%'","Expressionbesoin.PVU LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Expressionbesoin->recursive = 0;
                $this->set('expressionbesoins', $this->paginate());    
                $applications = $this->requestAction('applications/get_list/1');
                $types = $this->requestAction('types/get_list/1');
                $perimetres = $this->requestAction('perimetres/get_list/1');
                $etats = $this->requestAction('etats/get_list/1');
		$this->set(compact('applications','types','perimetres','etats'));                 
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }  
        
/**
 * export_xls
 * 
 */       
	function export_xls() {
		$data = $this->Session->read('xls_export');             
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}   
        
        public function saveHistory($id=null,$msg=null){
            if($id!=null && userAuth('id')!=null):
                $msg = $msg==null ? true : false;
                $this->Expressionbesoin->id = $id;
                $obj = $this->Expressionbesoin->read(); 
                $record['Historyexpb']['expressionbesoins_id']=$id;
                $record['Historyexpb']['etat_id']=$obj['Expressionbesoin']['etat_id'];
                $record['Historyexpb']['DATEFIN']=  CUSDate($obj['Expressionbesoin']['DATEFIN']);
                $record['Historyexpb']['DATELIVRAISON']=CUSDate($obj['Expressionbesoin']['DATELIVRAISON']);
                $record['Historyexpb']['MODIFIEDBY']= userAuth('id'); 
                $record['Historyexpb']['created']=date('Y-m-d H:i:s');
                $record['Historyexpb']['modified']=date('Y-m-d H:i:s');
                $this->Expressionbesoin->Historyexpb->create();
                if ($this->Expressionbesoin->Historyexpb->save($record)) {
                        if ($msg) : $this->Session->setFlash(__('Expression du besoin historisée',true),'flash_success'); endif;
                } else {
                        if ($msg) : $this->Session->setFlash(__('Historisation de l\'expression du besoin incorrecte, veuillez corriger l\'expression du besoin',true),'flash_failure'); endif;
                }
            else:
                $this->Session->setFlash(__('Historisation impossible l\'expression du besoin est incorecte.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;
        }    
        
        public function importCSV(){            
            $file = isset($this->data['Expressionbesoin']['file']['name']) ? $this->data['Expressionbesoin']['file']['name'] : '';
            $file_type = strrchr($file,'.');
            $completpath = WWW_ROOT.'files/upload/';
            if($this->data['Expressionbesoin']['file']['tmp_name']!='' && $file_type=='.csv'):
                $filename = $completpath.$this->data['Expressionbesoin']['file']['name'];
                move_uploaded_file($this->data['Expressionbesoin']['file']['tmp_name'],$filename);               
                $messages = $this->Expressionbesoin->importCSV($this->data['Expressionbesoin']['file']['name']);
                $allmsg = "Importation prise en compte, résultat ci-dessous :<ul>";
                foreach($messages as $message):
                    $x = 0;
                    foreach ($message as $msg):                    
                    $thismsg = !empty($msg) ? $msg : '';
                    $x++;
                    $allmsg .= "<li>".$thismsg."</li>";
                    endforeach;
                endforeach;
                $allmsg .= "</ul>";
                $this->Session->setFlash(__($allmsg,true),'flash_success');
            else :
                $this->Session->setFlash(__('Fichier <b>NON</b> reconnu',true),'flash_failure');
            endif;            
            $this->History->notmove();
        }   
        
        public function sendmailajout($expb){
            $valideurs = $this->requestAction('parameters/get_gestionnaireenvironnement');
            $to = explode(';', $valideurs['Parameter']['param']);
            $from = userAuth('MAIL');
            $objet = 'SAILL : Nouvelle demande d\'environnement ['.$expb['Application']['NOM'].']';
            $message = "Merci de traiter la demande suivnate: ".
                    '<ul>
                    <li>Application :'.$expb['Application']['NOM'].'</li>
                    <li>Composant :'.$expb['Composant']['NOM'].'</li>
                    <li>Périmètre :'.$expb['Perimetre']['NOM'].'</li> 
                    <li>Lot :'.$expb['Lot']['NOM'].'</li>       
                    </ul>';
            if(count($to) > 0):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($from)
                        ->to($to)
                        ->subject($objet)
                        ->send($message);
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
        }         
}
