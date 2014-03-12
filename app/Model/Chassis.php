<?php
App::uses('AppModel', 'Model');
/**
 * Chassis Model
 *
 * @property Localite $Localite
 * @property Bien $Bien
 */
class Chassis extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'localite_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'NIVEAU' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Localite' => array(
			'className' => 'Localite',
			'foreignKey' => 'localite_id',
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
		'Bien' => array(
			'className' => 'Bien',
			'foreignKey' => 'chassis_id',
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
                if (isset($val['Chassis']['created'])) {
                    $results[$key]['Chassis']['created'] = $this->dateFormatAfterFind($val['Chassis']['created']);
                }      
                if (isset($val['Chassis']['modified'])) {
                    $results[$key]['Chassis']['modified'] = $this->dateFormatAfterFind($val['Chassis']['modified']);
                }  
                $results[$key]['Entite']['NOM'] = $this->get_entite_nom(@$val['Application']['entite_id']); 
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
            if (!empty($this->data['Chassis']['NOM'])) {
                $this->data['Chassis']['NOM'] = mb_strtoupper($this->data['Chassis']['NOM'],'UTF-8');
            }  
            if (!empty($this->data['Chassis']['NIVEAU'])) {
                $this->data['Chassis']['NIVEAU'] = mb_strtoupper($this->data['Chassis']['NIVEAU'],'UTF-8');
            }              
            parent::beforeSave();
            return true;
        }          
}
