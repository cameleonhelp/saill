<?php
App::uses('AppModel', 'Model');
/**
 * Intergrationapplicative Model
 *
 * @property Application $Application
 * @property Type $Type
 * @property Version $Version
 */
class Intergrationapplicative extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'application_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'version_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'DATE' => array(
			'date' => array(
				'rule' => array('date'),
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
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'application_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Lot' => array(
			'className' => 'Lot',
			'foreignKey' => 'lot_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Version' => array(
			'className' => 'Version',
			'foreignKey' => 'version_id',
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
                'Historyintegration' => array(
			'className' => 'Historyintegration',
			'foreignKey' => 'intergrationapplicative_id',
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
                if (isset($val['Intergrationapplicative']['created'])) {
                    $results[$key]['Intergrationapplicative']['created'] = $this->dateFormatAfterFind($val['Intergrationapplicative']['created']);
                }      
                if (isset($val['Intergrationapplicative']['modified'])) {
                    $results[$key]['Intergrationapplicative']['modified'] = $this->dateFormatAfterFind($val['Intergrationapplicative']['modified']);
                }            
                if (isset($val['Intergrationapplicative']['DATECHECK'])) {
                    $results[$key]['Intergrationapplicative']['DATECHECK'] = $this->dateFormatAfterFind($val['Intergrationapplicative']['DATECHECK']);
                }      
                if (isset($val['Intergrationapplicative']['DATEINSTALL'])) {
                    $results[$key]['Intergrationapplicative']['DATEINSTALL'] = $this->datetimeFormatAfterFind($val['Intergrationapplicative']['DATEINSTALL']);
                }                                    
            }
            return $results;
        } 
        
          
}
