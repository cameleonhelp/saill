<?php
App::uses('AppModel', 'Model');
/**
 * Type Model
 *
 * @property Bien $Bien
 * @property Expressionbesoin $Expressionbesoin
 * @property Intergrationapplicative $Intergrationapplicative
 * @property Logiciel $Logiciel
 */
class Type extends AppModel {

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
			'foreignKey' => 'type_id',
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
			'foreignKey' => 'type_id',
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
		'Intergrationapplicative' => array(
			'className' => 'Intergrationapplicative',
			'foreignKey' => 'type_id',
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
        public function afterFind($results, $primary = false) {
            foreach ($results as $key => $val) {
                if (isset($val['Type']['created'])) {
                    $results[$key]['Type']['created'] = $this->dateFormatAfterFind($val['Type']['created']);
                }      
                if (isset($val['Type']['modified'])) {
                    $results[$key]['Type']['modified'] = $this->dateFormatAfterFind($val['Type']['modified']);
                }            
            }
            return $results;
        }  
        
         /**
 * beforeSave method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function beforeSave($options = array()) {
            if (!empty($this->data['Type']['NOM'])) {
                $this->data['Type']['NOM'] = mb_strtoupper($this->data['Type']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }          
}
