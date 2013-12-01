<?php
App::uses('AppModel', 'Model');
/**
 * Changelogversion Model
 *
 * @property Changelogdemande $Changelogdemande
 */
class Changelogversion extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'VERSION' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ETAT' => array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Changelogdemande' => array(
			'className' => 'Changelogdemande',
			'foreignKey' => 'changelogversion_id',
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
                if (isset($val['Changelogversion']['DATEREELLE'])) {
                    $results[$key]['Changelogversion']['DATEREELLE'] = $this->datetimeFormatAfterFind($val['Changelogversion']['DATEREELLE']);
                }   
                if (isset($val['Changelogversion']['DATEPREVUE'])) {
                    $results[$key]['Changelogversion']['DATEPREVUE'] = $this->datetimeToDateAfterFind($val['Changelogversion']['DATEPREVUE']);
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
        public function beforeSave() {
            if (!empty($this->data['Changelogversion']['DATEPREVUE'])) {
                $this->data['Changelogversion']['DATEPREVUE'] = $this->dateToDatetimeBeforeSave($this->data['Changelogversion']['DATEPREVUE']);
            } 
            parent::beforeSave();
            return true;
        }        
}
