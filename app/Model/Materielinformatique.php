<?php
App::uses('AppModel', 'Model');
/**
 * Materielinformatique Model
 *
 * @property Typemateriel $Typemateriel
 * @property Section $Section
 * @property Assistance $Assistance
 * @property Dotation $Dotation
 */
class Materielinformatique extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'typemateriel_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'section_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'assistance_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Typemateriel' => array(
			'className' => 'Typemateriel',
			'foreignKey' => 'typemateriel_id',
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
		'Assistance' => array(
			'className' => 'Assistance',
			'foreignKey' => 'assistance_id',
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
		'Dotation' => array(
			'className' => 'Dotation',
			'foreignKey' => 'materielinformatiques_id',
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
                if (isset($val['Materielinformatique']['created'])) {
                    $results[$key]['Materielinformatique']['created'] = $this->dateFormatAfterFind($val['Materielinformatique']['created']);
                }      
                if (isset($val['Materielinformatique']['modified'])) {
                    $results[$key]['Materielinformatique']['modified'] = $this->dateFormatAfterFind($val['Materielinformatique']['modified']);
                }   
                if (isset($val['Materielinformatique']['id'])) {
                    $resultat = $this->getUtilisateurFromMateriel($val['Materielinformatique']['id']);
                    $results[$key]['Materielinformatique']['utilisateur_NOMLONG'] = $resultat['NOMLONG'];
                    $results[$key]['Materielinformatique']['utilisateur_id'] = $resultat['id'];
                }                   
            }
            return $results;
        } 
        
        public function getUtilisateurFromMateriel($id){
            $resultat = array();
            $sql = "SELECT utilisateurs.id,CONCAT( NOM, ' ', PRENOM ) AS NOMLONG FROM utilisateurs WHERE utilisateurs.id IN (SELECT dotations.utilisateur_id FROM dotations WHERE dotations.materielinformatiques_id =".$id.")";
            $result = $this->query($sql);
            $resultat['id']=!empty($result) ? $result[0]['utilisateurs']['id'] : "";
            $resultat['NOMLONG']=!empty($result) ? $result[0][0]['NOMLONG'] : "";
            return $resultat;            
        }
}
