<?php
App::uses('AppModel', 'Model');
/**
 * Phase Model
 *
 * @property Expressionbesoin $Expressionbesoin
 */
class Phase extends AppModel {

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
			'foreignKey' => 'phase_id',
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
                if (isset($val['Phase']['created'])) {
                    $results[$key]['Phase']['created'] = $this->dateFormatAfterFind($val['Phase']['created']);
                }      
                if (isset($val['Phase']['modified'])) {
                    $results[$key]['Phase']['modified'] = $this->dateFormatAfterFind($val['Phase']['modified']);
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
            if (!empty($this->data['Phase']['NOM'])) {
                $this->data['Phase']['NOM'] = mb_strtoupper($this->data['Phase']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }   
    
}
