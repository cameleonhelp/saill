<?php
App::uses('AppModel', 'Model');
/**
 * Contrat Model
 *
 * @property Tjmcontrat $Tjmcontrat
 * @property Projet $Projet
 */
class Contrat extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'ANNEEDEBUT' => array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tjmcontrat' => array(
			'className' => 'Tjmcontrat',
			'foreignKey' => 'tjmcontrat_id',
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
		'Projet' => array(
			'className' => 'Projet',
			'foreignKey' => 'contrat_id',
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
                if (isset($val['Contrat']['created'])) {
                    $results[$key]['Contrat']['created'] = $this->dateFormatAfterFind($val['Contrat']['created']);
                }      
                if (isset($val['Contrat']['modified'])) {
                    $results[$key]['Contrat']['modified'] = $this->dateFormatAfterFind($val['Contrat']['modified']);
                }            
                 if (isset($val['Contrat']['ANNEEFIN'])) {
                    $results[$key]['Contrat']['ANNEEFIN'] = $this->YearFormatAfterFind($val['Contrat']['ANNEEFIN']);
                } 
            }
            return $results;
        } 
}
