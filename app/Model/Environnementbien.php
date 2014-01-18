<?php
App::uses('AppModel', 'Model');
/**
 * Environnementbien Model
 *
 * @property Expressionbesoin $Expressionbesoin
 * @property Bien $Bien
 */
class Environnementbien extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'expressionbesoin_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'bien_id' => array(
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
		'Expressionbesoin' => array(
			'className' => 'Expressionbesoin',
			'foreignKey' => 'expressionbesoin_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Bien' => array(
			'className' => 'Bien',
			'foreignKey' => 'bien_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
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
        public function afterFind($results, $primary = false) {
            foreach ($results as $key => $val) {
                if (isset($val['Environnementbien']['created'])) {
                    $results[$key]['Environnementbien']['created'] = $this->dateFormatAfterFind($val['Environnementbien']['created']);
                }      
                if (isset($val['Environnementbien']['modified'])) {
                    $results[$key]['Environnementbien']['modified'] = $this->dateFormatAfterFind($val['Environnementbien']['modified']);
                }            
            }
            return $results;
        }            
}
