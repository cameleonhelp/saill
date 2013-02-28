<?php
App::uses('AppModel', 'Model');
/**
 * Utilisateur Model
 *
 * @property Profil $Profil
 * @property Societe $Societe
 * @property Assistance $Assistance
 * @property Section $Section
 * @property Utilisateur $Utilisateur
 * @property Domaine $Domaine
 * @property Site $Site
 * @property Tjmagent $Tjmagent
 * @property Dotation $Dotation
 * @property Action $Action
 * @property Affectation $Affectation
 * @property Dotation $Dotation
 * @property Historyaction $Historyaction
 * @property Historyutilisateur $Historyutilisateur
 * @property Linkshared $Linkshared
 * @property Listediffusion $Listediffusion
 * @property Livrable $Livrable
 * @property Outil $Outil
 * @property Section $Section
 * @property Utilisateur $Utilisateur
 * @property Utiliseoutil $Utiliseoutil
 */
class Utilisateur extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'profil_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ACTIF' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'NAISSANCE' => array(
			/*'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
		),
		'NOM' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'PRENOM' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'WORKCAPACITY' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'CONGE' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'RQ' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'VT' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'HIERARCHIQUE' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'GESTIONABSENCES' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
		'Profil' => array(
			'className' => 'Profil',
			'foreignKey' => 'profil_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Societe' => array(
			'className' => 'Societe',
			'foreignKey' => 'societe_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Assistance' => array(
			'className' => 'Assistance',
			'foreignKey' => 'assistance_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Hierarchique' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'utilisateur_id',
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
		'Site' => array(
			'className' => 'Site',
			'foreignKey' => 'site_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tjmagent' => array(
			'className' => 'Tjmagent',
			'foreignKey' => 'tjmagent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Dotation' => array(
			'className' => 'Dotation',
			'foreignKey' => 'dotation_id',
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
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'utilisateur_id',
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
		'Affectation' => array(
			'className' => 'Affectation',
			'foreignKey' => 'utilisateur_id',
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
		'Dotation' => array(
			'className' => 'Dotation',
			'foreignKey' => 'utilisateur_id',
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
			'foreignKey' => 'utilisateur_id',
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
		'Dossierpartage' => array(
			'className' => 'Dossierpartage',
			'foreignKey' => '',
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
		'Activite' => array(
			'className' => 'Activite',
			'foreignKey' => '',
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
                'Historyutilisateur' => array(
			'className' => 'Historyutilisateur',
			'foreignKey' => 'utilisateur_id',
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
		'Linkshared' => array(
			'className' => 'Linkshared',
			'foreignKey' => 'utilisateur_id',
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
		'Listediffusion' => array(
			'className' => 'Listediffusion',
			'foreignKey' => 'utilisateur_id',
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
		'Livrable' => array(
			'className' => 'Livrable',
			'foreignKey' => 'utilisateur_id',
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
		'Outil' => array(
			'className' => 'Outil',
			'foreignKey' => 'utilisateur_id',
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
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'utilisateur_id',
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
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'utilisateur_id',
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
		'Utiliseoutil' => array(
			'className' => 'Utiliseoutil',
			'foreignKey' => 'utilisateur_id',
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

        public $virtualFields = array(
            'NOMLONG' => 'CONCAT(Utilisateur.NOM, " ", Utilisateur.PRENOM)'
        );
 /**
 * beforeSave method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function beforeSave() {
            if (!empty($this->data['Utilisateur']['password'])) {
                $this->data['Utilisateur']['password'] = md5($this->data['Utilisateur']['password']); 
            }
            if (!empty($this->data['Utilisateur']['NAISSANCE'])) {
                $this->data['Utilisateur']['NAISSANCE'] = $this->dateFormatBeforeSave($this->data['Utilisateur']['NAISSANCE']);
            }
            if (!empty($this->data['Utilisateur']['FINMISSION'])) {
                $this->data['Utilisateur']['FINMISSION'] = $this->dateFormatBeforeSave($this->data['Utilisateur']['FINMISSION']);
            }
            if (!empty($this->data['Utilisateur']['DATEDEBUTACTIF'])) {
                $this->data['Utilisateur']['DATEDEBUTACTIF'] = $this->dateFormatBeforeSave($this->data['Utilisateur']['DATEDEBUTACTIF']);
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
        public function afterFind($results) {
            foreach ($results as $key => $val) {
                if (isset($val['Utilisateur']['created'])) {
                    $results[$key]['Utilisateur']['created'] = $this->dateFormatAfterFind($val['Utilisateur']['created']);
                }      
                if (isset($val['Utilisateur']['modified'])) {
                    $results[$key]['Utilisateur']['modified'] = $this->dateFormatAfterFind($val['Utilisateur']['modified']);
                }            
                if (isset($val['Utilisateur']['NAISSANCE'])) {
                    $results[$key]['Utilisateur']['NAISSANCE'] = $this->dateFormatAfterFind($val['Utilisateur']['NAISSANCE']);
                } 
                if (isset($val['Utilisateur']['FINMISSION'])) {
                    $results[$key]['Utilisateur']['FINMISSION'] = $this->dateFormatAfterFind($val['Utilisateur']['FINMISSION']);
                } 
                if (isset($val['Utilisateur']['DATEDEBUTACTIF'])) {
                    $results[$key]['Utilisateur']['DATEDEBUTACTIF'] = $this->dateFormatAfterFind($val['Utilisateur']['DATEDEBUTACTIF']);
                } 
            }
            return $results;
        }          
}
