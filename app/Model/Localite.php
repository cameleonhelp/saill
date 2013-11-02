<?php
App::uses('AppModel', 'Model');
/**
 * Localite Model
 *
 * @property Chassis $Chassis
 */
class Localite extends AppModel {

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
		'Chassis' => array(
			'className' => 'Chassis',
			'foreignKey' => 'localite_id',
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
                if (isset($val['Localite']['created'])) {
                    $results[$key]['Localite']['created'] = $this->dateFormatAfterFind($val['Localite']['created']);
                }      
                if (isset($val['Localite']['modified'])) {
                    $results[$key]['Localite']['modified'] = $this->dateFormatAfterFind($val['Localite']['modified']);
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
            if (!empty($this->data['Localite']['NOM'])) {
                $this->data['Localite']['NOM'] = mb_strtoupper($this->data['Localite']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }    
        
}
