<?php
App::uses('AppModel', 'Model');
/**
 * Envversion Model
 *
 * @property Envoutil $Envoutil
 */
class Envversion extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'envoutil_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'VERSION' => array(
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
		'Envoutil' => array(
			'className' => 'Envoutil',
			'foreignKey' => 'envoutil_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public $virtualFields = array(
            'VERSIONEDITION' => 'CONCAT(Envversion.VERSION, " ", Envversion.EDITION)'
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
                if (isset($val['Envversion']['created'])) {
                    $results[$key]['Envversion']['created'] = $this->dateFormatAfterFind($val['Envversion']['created']);
                }      
                if (isset($val['Envversion']['modified'])) {
                    $results[$key]['Envversion']['modified'] = $this->dateFormatAfterFind($val['Envversion']['modified']);
                }            
            }
            return $results;
        }            
}
