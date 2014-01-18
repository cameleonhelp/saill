<?php
App::uses('AppModel', 'Model');
/**
 * Modele Model
 *
 * @property Bien $Bien
 */
class Modele extends AppModel {

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
			'foreignKey' => 'modele_id',
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
                if (isset($val['Modele']['created'])) {
                    $results[$key]['Modele']['created'] = $this->dateFormatAfterFind($val['Modele']['created']);
                }      
                if (isset($val['Modele']['modified'])) {
                    $results[$key]['Modele']['modified'] = $this->dateFormatAfterFind($val['Modele']['modified']);
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
            if (!empty($this->data['Modele']['NOM'])) {
                $this->data['Modele']['NOM'] = mb_strtoupper($this->data['Modele']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }         
}
