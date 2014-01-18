<?php
App::uses('AppModel', 'Model');
/**
 * Architecture Model
 *
 * @property Expressionbesoin $Expressionbesoin
 */
class Architecture extends AppModel {

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
		'Expressionbesoin' => array(
			'className' => 'Expressionbesoin',
			'foreignKey' => 'architecture_id',
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
                if (isset($val['Architecture']['created'])) {
                    $results[$key]['Architecture']['created'] = $this->dateFormatAfterFind($val['Architecture']['created']);
                }      
                if (isset($val['Architecture']['modified'])) {
                    $results[$key]['Architecture']['modified'] = $this->dateFormatAfterFind($val['Architecture']['modified']);
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
            if (!empty($this->data['Architecture']['NOM'])) {
                $this->data['Architecture']['NOM'] = mb_strtoupper($this->data['Architecture']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }             
}
