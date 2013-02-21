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
			'foreignKey' => 'materielinformatique_id',
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
        public function beforeSave() {
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
                if (isset($val['Materielinformatique']['created'])) {
                    $results[$key]['Materielinformatique']['created'] = $this->dateFormatAfterFind($val['Materielinformatique']['created']);
                }      
                if (isset($val['Materielinformatique']['modified'])) {
                    $results[$key]['Materielinformatique']['modified'] = $this->dateFormatAfterFind($val['Materielinformatique']['modified']);
                }            }
            return $results;
        } 
}
