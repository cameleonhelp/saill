<?php
App::uses('AppModel', 'Model');
/**
 * Version Model
 *
 * @property Lot $Lot
 * @property Intergrationapplicative $Intergrationapplicative
 */
class Version extends AppModel {

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
		'lot_id' => array(
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
		'Lot' => array(
			'className' => 'Lot',
			'foreignKey' => 'lot_id',
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
		'Intergrationapplicative' => array(
			'className' => 'Intergrationapplicative',
			'foreignKey' => 'version_id',
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
                if (isset($val['Version']['created'])) {
                    $results[$key]['Version']['created'] = $this->dateFormatAfterFind($val['Version']['created']);
                }      
                if (isset($val['Version']['modified'])) {
                    $results[$key]['Version']['modified'] = $this->dateFormatAfterFind($val['Version']['modified']);
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
            if (!empty($this->data['Version']['NOM'])) {
                $this->data['Version']['NOM'] = mb_strtoupper($this->data['Version']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }           
}
