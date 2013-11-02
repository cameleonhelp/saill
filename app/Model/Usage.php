<?php
App::uses('AppModel', 'Model');
/**
 * Usage Model
 *
 * @property Bien $Bien
 */
class Usage extends AppModel {

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
			'foreignKey' => 'usage_id',
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
                if (isset($val['Usage']['created'])) {
                    $results[$key]['Usage']['created'] = $this->dateFormatAfterFind($val['Usage']['created']);
                }      
                if (isset($val['Usage']['modified'])) {
                    $results[$key]['Usage']['modified'] = $this->dateFormatAfterFind($val['Usage']['modified']);
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
            if (!empty($this->data['Usage']['NOM'])) {
                $this->data['Usage']['NOM'] = mb_strtoupper($this->data['Usage']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }           
}
