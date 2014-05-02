<?php
App::uses('AppModel', 'Model');
/**
 * Action Model
 *
 * @property Utilisateur $Utilisateur
 * @property Domaine $Domaine
 * @property Activite $Activite
 * @property Periodicite $Periodicite
 * @property Actionslivrable $Actionslivrable
 * @property Activitesreelle $Activitesreelle
 * @property Historyaction $Historyaction
 */
class Action extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'utilisateur_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'destinataire' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'domaine_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'activite_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'OBJET' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'utilisateur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Destinataire' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'destinataire',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),            
		'Domaine' => array(
			'className' => 'Domaine',
			'foreignKey' => 'domaine_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Activite' => array(
			'className' => 'Activite',
			'foreignKey' => 'activite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Periodicite' => array(
			'className' => 'Periodicite',
			'foreignKey' => 'periodicite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Actionslivrable' => array(
			'className' => 'Actionslivrable',
			'foreignKey' => 'action_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Activitesreelle' => array(
			'className' => 'Activitesreelle',
			'foreignKey' => 'action_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Historyaction' => array(
			'className' => 'Historyaction',
			'foreignKey' => 'action_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

/**
 * beforeSave method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function beforeSave($options = array()) {
            if (!empty($this->data['Action']['ECHEANCE'])) {
                $this->data['Action']['ECHEANCE'] = $this->dateFormatBeforeSave($this->data['Action']['ECHEANCE']);
            } else {
                $this->data['Action']['ECHEANCE'] = $this->dateFormatBeforeSave(date('d/m/Y'));
            }  
            if (!empty($this->data['Action']['DEBUT'])) {
                $this->data['Action']['DEBUT'] = $this->dateFormatBeforeSave($this->data['Action']['DEBUT']);
            } else {
                $this->data['Action']['DEBUT'] = $this->dateFormatBeforeSave(date('d/m/Y'));
            }            
            if (!empty($this->data['Action']['DEBUTREELLE'])) {
                $this->data['Action']['DEBUTREELLE'] = $this->dateFormatBeforeSave($this->data['Action']['DEBUTREELLE']);
            }
            if (empty($this->data['Action']['PRIORITE'])) {
                $this->data['Action']['PRIORITE'] = 'normale';
            }
            if (empty($this->data['Action']['STATUT'])) {
                $this->data['Action']['STATUT'] = 'en cours';
            }            
            parent::beforeSave();
            return true;
        }
        
/**
 * afterFind method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function afterFind($results, $primary = false) {
            foreach ($results as $key => $val) {
                if (isset($val['Action']['created'])) {
                    $results[$key]['Action']['created'] = $this->dateFormatAfterFind($val['Action']['created']);
                }      
                if (isset($val['Action']['modified'])) {
                    $results[$key]['Action']['modified'] = $this->dateFormatAfterFind($val['Action']['modified']);
                }                   
                if (isset($val['Action']['ECHEANCE'])) {
                    $results[$key]['Action']['ECHEANCE'] = $this->dateFormatAfterFind($val['Action']['ECHEANCE']);
                }      
                if (isset($val['Action']['DEBUTREELLE'])) {
                    $results[$key]['Action']['DEBUTREELLE'] = $this->dateFormatAfterFind($val['Action']['DEBUTREELLE']);
                }   
                if (isset($val['Action']['DEBUT'])) {
                    $results[$key]['Action']['DEBUT'] = $this->dateFormatAfterFind($val['Action']['DEBUT']);
                }  
                if (isset($val['Action']['destinataire'])) {
                    $destinataire = $this->getDestinataire($val['Action']['destinataire']);
                    $results[$key]['Action']['destinataire_nom'] = $destinataire['Action']['NOMLONG'];
                    $results[$key]['Action']['destinataire_mail'] = $destinataire['Action']['MAIL'];
                }       
                if (isset($val['Action']['activite_id'])) {
                    $results[$key]['Action']['projet_nom'] = $this->getProjet($val['Action']['activite_id']);
                }                   
            }
            return $results;
        } 
        
        public function getDestinataire($id){
            $value = false;
            if ($id != 0):
            $sql = 'SELECT CONCAT(NOM," ",PRENOM) AS NOMLONG, MAIL FROM utilisateurs WHERE id="'.$id.'"';
            $result = $this->query($sql);
            $value['Action']['NOMLONG'] =  $result[0][0]['NOMLONG'];
            $value['Action']['MAIL'] =  $result[0]['utilisateurs']['MAIL'];
            endif;
            return $value;
        }
        
        public function getProjet($id){
            $value = false;
            if ($id != 0):
            $sql = 'SELECT projets.NOM AS NOM FROM projets LEFT JOIN activites ON activites.projet_id = projets.id WHERE activites.id='.$id;
            $result = $this->query($sql);
            $value =  $result[0]['projets']['NOM'];
            endif;
            return $value;
        }        
}
