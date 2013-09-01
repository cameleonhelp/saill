<?php
App::uses('AppModel', 'Model');
/**
 * Periodicite Model
 *
 * @property Action $Action
 */
class Periodicite extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'END' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'REPEATALL' => array(
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
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'periodicite_id',
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
            if (!empty($this->data['Periodicite']['END'])) {
                $this->data['Periodicite']['END'] = $this->dateFormatBeforeSave($this->data['Periodicite']['END']);
            }
            if (!empty($this->data['Periodicite']['created'])) {
                $this->data['Periodicite']['created'] = $this->dateFormatBeforeSave($this->data['Periodicite']['created']);
            }          
            if (!empty($this->data['Periodicite']['modified'])) {
                $this->data['Periodicite']['modified'] = $this->dateFormatBeforeSave($this->data['Periodicite']['modified']);
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
                if (isset($val['Periodicite']['created'])) {
                    $results[$key]['Periodicite']['created'] = $this->dateFormatAfterFind($val['Periodicite']['created']);
                }      
                if (isset($val['Periodicite']['modified'])) {
                    $results[$key]['Periodicite']['modified'] = $this->dateFormatAfterFind($val['Periodicite']['modified']);
                }                   
                if (isset($val['Periodicite']['END'])) {
                    $results[$key]['Periodicite']['END'] = $this->dateFormatAfterFind($val['Periodicite']['END']);
                }                      
            }
            return $results;
        }         
}
