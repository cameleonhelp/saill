<?php
App::uses('AppModel', 'Model');
/**
 * Lot Model
 *
 * @property Bien $Bien
 * @property Expressionbesoin $Expressionbesoin
 * @property Logiciel $Logiciel
 * @property Version $Version
 */
class Lot extends AppModel {

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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Bien' => array(
			'className' => 'Bien',
			'foreignKey' => 'lot_id',
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
		'Expressionbesoin' => array(
			'className' => 'Expressionbesoin',
			'foreignKey' => 'lot_id',
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
		'Logiciel' => array(
			'className' => 'Logiciel',
			'foreignKey' => 'lot_id',
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
		'Version' => array(
			'className' => 'Version',
			'foreignKey' => 'lot_id',
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
 * afterFind method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function afterFind($results) {
            foreach ($results as $key => $val) {
                if (isset($val['Lot']['created'])) {
                    $results[$key]['Lot']['created'] = $this->dateFormatAfterFind($val['Lot']['created']);
                }      
                if (isset($val['Lot']['modified'])) {
                    $results[$key]['Lot']['modified'] = $this->dateFormatAfterFind($val['Lot']['modified']);
                }            
            }
            return $results;
        }            
}
