<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoprojetentites');
App::import('Controller', 'Projets');
App::import('Controller', 'Plancharges');
/**
 * Dashboards Controller
 *
 * @property Dashboard $Dashboard
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class DashboardsController extends AppController {
    public $components = array('History','Common');    
    
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Tableaux de bord" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }      
    
    public function index() {
            $this->set_title();
            if (isAuthorized('facturations', 'rapports') || isAuthorized('activitesreelles', 'rapports') || isAuthorized('plancharges', 'rapports')) :
                if ($this->request->is('post')):
                    $today = new DateTime();
                    $annee = $this->request->data['Dashboard']['ANNEE'] == '' ? $today->format('Y') : $this->request->data['Dashboard']['ANNEE'];
                    foreach ($this->request->data['Dashboard']['projet_id'] as &$value) {
                        @$projetslist .= $value.',';
                    }  
                    $projets = 'activites.projet_id IN ('.substr_replace(@$projetslist ,"",-1).') ';
                    if(!empty($this->request->data['Dashboard']['plancharge_id'])):
                    foreach ($this->request->data['Dashboard']['plancharge_id'] as &$value) {
                        @$planchargeslist .= $value.',';
                    }      
                    else:
                        @$planchargeslist = '0,';
                    endif;
                    $plancharges = 'plancharges.id IN ('.substr_replace(@$planchargeslist ,"",-1).') ';
                    $viewcontrat = "CREATE VIEW CONTRAT AS
                                    SELECT projets.id AS id,projets.NOM,tjmcontrats.TJM,SUM(historybudgets.REVU) AS BUDGET,TRUNCATE(SUM(historybudgets.REVU)/(TJM/1000),2) AS CHARGE
                                    FROM projets
                                    LEFT JOIN activites ON activites.projet_id = projets.id
                                    LEFT JOIN contrats ON contrats.id = projets.contrat_id
                                    LEFT JOIN tjmcontrats ON tjmcontrats.id = contrats.tjmcontrat_id
                                    LEFT JOIN historybudgets ON historybudgets.activite_id = activites.id
                                    WHERE ".$projets."
                                    AND activites.DELETABLE = 1
                                    AND historybudgets.ANNEE = ".$annee.
                                    //" AND historybudgets.ACTIF = 1".
                                    " GROUP BY projets.id
                                    ORDER BY projets.NOM;";
                    $viewprevu =   "CREATE VIEW PREVISION AS
                                    SELECT activites.projet_id AS id,SUM(detailplancharges.TOTAL) AS BUDGETPREVU,SUM(detailplancharges.TOTAL) AS CHARGEPREVUE
                                    FROM activites
                                    LEFT JOIN detailplancharges ON activites.id = detailplancharges.activite_id
                                    LEFT JOIN plancharges ON plancharges.id = detailplancharges.plancharge_id
                                    WHERE ".$projets."
                                    AND ".$plancharges."    
                                    GROUP BY activites.projet_id;";
                    $viewreel =    "CREATE VIEW CONSOMMATION AS
                                    SELECT activites.projet_id AS id,SUM(activitesreelles.TOTAL) AS BUDGETREEL,SUM(activitesreelles.TOTAL) AS CHARGEREELLE
                                    FROM activites
                                    LEFT JOIN activitesreelles ON activites.id = activitesreelles.activite_id
                                    WHERE ".$projets."
                                    AND activitesreelles.VEROUILLE = 0
                                    AND YEAR(activitesreelles.DATE) = ".$annee
                                    ." GROUP BY activites.projet_id;";
                    $viewfacture = "CREATE VIEW FACTURATION AS
                                    SELECT activites.projet_id AS id,SUM(facturations.TOTAL) AS BUDGETFACTURE,SUM(facturations.TOTAL) AS CHARGEFACTUREE
                                    FROM activites
                                    LEFT JOIN facturations ON activites.id = facturations.activite_id
                                    WHERE ".$projets."
                                    AND facturations.VISIBLE = 0
                                    AND YEAR(facturations.DATE) = ".$annee
                                    ." GROUP BY activites.projet_id;";
                    $viewachats = "CREATE VIEW ACHAT AS
                                    SELECT activites.projet_id as id,SUM(IF(achats.MONTANT IS NULL,0,achats.MONTANT)) AS COUTACHAT, ROUND(SUM(IF(achats.MONTANT IS NULL,0,achats.MONTANT))/IF(tjmcontrats.TJM IS NULL,1,tjmcontrats.TJM),2) AS CHARGEACHAT
                                    FROM activites
                                    LEFT JOIN achats ON activites.id = achats.activite_id
                                    LEFT JOIN projets ON projets.id = activites.projet_id
                                    LEFT JOIN contrats ON contrats.id = projets.contrat_id
                                    LEFT JOIN tjmcontrats ON tjmcontrats.id = contrats.tjmcontrat_id
                                    WHERE YEAR(achats.DATE) = ".$annee
                                    ." GROUP BY activites.projet_id;";
                    
                    $viewdomainereel = "CREATE VIEW REELBYDOMAINE AS "
                                    . "SELECT activites.projet_id AS id, activitesreelles.domaine_id as domaine_id,SUM(activitesreelles.TOTAL) AS DOMBUDGETREEL,SUM(activitesreelles.TOTAL) AS DOMCHARGEREELLE
                                    FROM activites
                                    LEFT JOIN activitesreelles ON activites.id = activitesreelles.activite_id
                                    WHERE ".$projets."
                                    AND activitesreelles.VEROUILLE = 0
                                    AND YEAR(activitesreelles.DATE) = ".$annee
                                    ." GROUP BY activites.projet_id,activitesreelles.domaine_id;";

                    $select =  "SELECT DISTINCT(CONTRAT.id),NOM,TJM,
                                BUDGET,TRUNCATE(((BUDGETFACTURE*(TJM/1000))/BUDGET)*100,2) AS AVANCEMENTBUDGET,TRUNCATE(BUDGETPREVU*(TJM/1000),2) AS BUDGETPREVU,(TRUNCATE(BUDGETREEL*(TJM/1000),2)+ROUND(IF(COUTACHAT IS NULL,0,(COUTACHAT/1000)),2)) AS BUDGETREEL,(TRUNCATE(BUDGETFACTURE*(TJM/1000),2)+ROUND(IF(COUTACHAT IS NULL,0,(COUTACHAT/1000)),2)) AS BUDGETFACTURE,
                                CHARGE,TRUNCATE(((CHARGEFACTUREE/CHARGE)*100),2) AS AVANCEMENTCHARGE,CHARGEPREVUE,(CHARGEREELLE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT)) AS TOTALCHARGEREELLE,((CHARGEREELLE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT))-CHARGEFACTUREE) AS ECART,(CHARGEFACTUREE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT)) AS TOTALCHARGEFACTUREE,
                                (CHARGEPREVUE-(CHARGEREELLE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT))) AS RAC,(CHARGE-(CHARGEFACTUREE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT))) AS RAF,COUTACHAT,CHARGEACHAT
                                FROM CONTRAT
                                LEFT JOIN PREVISION ON PREVISION.id = CONTRAT.id
                                LEFT JOIN CONSOMMATION ON CONSOMMATION.id = CONTRAT.id
                                LEFT JOIN FACTURATION ON FACTURATION.id = CONTRAT.id
                                LEFT JOIN ACHAT ON CONTRAT.id = ACHAT.id
                                ORDER BY NOM asc;";
                    
                    $selectdom =  "SELECT DISTINCT(CONTRAT.id),CONTRAT.NOM AS NOM,domaines.NOM AS DOMAINE,TJM,
                                BUDGET,TRUNCATE(((BUDGETFACTURE*(TJM/1000))/BUDGET)*100,2) AS AVANCEMENTBUDGET,TRUNCATE(BUDGETPREVU*(TJM/1000),2) AS BUDGETPREVU,(TRUNCATE(DOMBUDGETREEL*(TJM/1000),2)+ROUND(IF(COUTACHAT IS NULL,0,(COUTACHAT/1000)),2)) AS DOMBUDGETREEL,(TRUNCATE(BUDGETFACTURE*(TJM/1000),2)+ROUND(IF(COUTACHAT IS NULL,0,(COUTACHAT/1000)),2)) AS BUDGETFACTURE,
                                CHARGE,TRUNCATE(((CHARGEFACTUREE/CHARGE)*100),2) AS AVANCEMENTCHARGE,CHARGEPREVUE,(DOMCHARGEREELLE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT)) AS TOTALDOMCHARGEREELLE,((DOMCHARGEREELLE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT))-CHARGEFACTUREE) AS ECART,(CHARGEFACTUREE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT)) AS TOTALCHARGEFACTUREE,
                                (CHARGEPREVUE-(DOMCHARGEREELLE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT))) AS RAC,(CHARGE-(CHARGEFACTUREE+IF(CHARGEACHAT IS NULL,0,CHARGEACHAT))) AS RAF,COUTACHAT,CHARGEACHAT
                                FROM CONTRAT
                                LEFT JOIN PREVISION ON PREVISION.id = CONTRAT.id
                                LEFT JOIN REELBYDOMAINE ON REELBYDOMAINE.id = CONTRAT.id
                                LEFT JOIN FACTURATION ON FACTURATION.id = CONTRAT.id
                                LEFT JOIN ACHAT ON CONTRAT.id = ACHAT.id
                                LEFT JOIN domaines on REELBYDOMAINE.domaine_id = domaines.id
                                GROUP BY CONTRAT.NOM, domaines.NOM
                                ORDER BY CONTRAT.NOM asc;";                    

                    $this->Dashboard->query("DROP VIEW IF EXISTS CONTRAT;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS PREVISION;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS CONSOMMATION;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS FACTURATION;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS ACHAT;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS REELBYDOMAINE;");
                    $this->Dashboard->query($viewcontrat);
                    $this->Dashboard->query($viewprevu);
                    $this->Dashboard->query($viewreel);
                    $this->Dashboard->query($viewfacture);
                    $this->Dashboard->query($viewachats);
                    $this->Dashboard->query($viewdomainereel);
                    $results = $this->Dashboard->query($select);
                    $resultsdom = $this->Dashboard->query($selectdom);
                    $this->set(compact('results','resultsdom'));
                    $this->Dashboard->query("DROP VIEW IF EXISTS CONTRAT;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS PREVISION;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS CONSOMMATION;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS FACTURATION;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS ACHAT;");
                    $this->Dashboard->query("DROP VIEW IF EXISTS REELBYDOMAINE;");
                    
                    $this->Session->delete('rapportresults');  
                    $this->Session->write('rapportresults',$results);
                endif;
                $ObjAssoprojetentites = new AssoprojetentitesController();	
                $ObjProjets = new ProjetsController();	
                $ObjPlancharges = new PlanchargesController();	
                $listprojetsvisible = $ObjAssoprojetentites->json_get_all_projets(userAuth('id'));
                $listprojets = $ObjProjets->get_list_id_nom_projets($listprojetsvisible);   
                $listplancharges = $ObjPlancharges->get_list_plancharge_visibility();
                $this->set(compact('listplancharges','listprojets'));                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                     
    }
    
	function export_doc() {
            if($this->Session->check('rapportresults')):
                $data = $this->Session->read('rapportresults');
                $this->set('rowsrapport',$data);              
		$this->render('export_doc','export_doc');
            else:
                $this->Session->setFlash(__('Rapport impossible à éditer veuillez renouveler le calcul du rapport',true),'flash_failure');             
                $this->redirect(array('action'=>'rapport'));
            endif;
        }        
}

?>
