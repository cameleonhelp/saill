<?php
App::uses('AppModel', 'Model');
/**
 * Envoutil Model
 *
 * @property Envversion $Envversion
 * @property Mw $Mw
 */
class Envoutil extends AppModel {

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
		'Envversion' => array(
			'className' => 'Envversion',
			'foreignKey' => 'envoutil_id',
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
		'Mw' => array(
			'className' => 'Mw',
			'foreignKey' => 'envoutil_id',
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
            if (!empty($this->data['Envoutil']['NOM'])) {
                $this->data['Envoutil']['NOM'] = mb_strtoupper($this->data['Envoutil']['NOM'],'UTF-8');
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
                if (isset($val['Envoutil']['created'])) {
                    $results[$key]['Envoutil']['created'] = $this->dateFormatAfterFind($val['Envoutil']['created']);
                }      
                if (isset($val['Envoutil']['modified'])) {
                    $results[$key]['Envoutil']['modified'] = $this->dateFormatAfterFind($val['Envoutil']['modified']);
                }                    
            }
            return $results;
        }            
}
