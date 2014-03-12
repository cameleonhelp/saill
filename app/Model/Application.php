<?php
App::uses('AppModel', 'Model');
/**
 * Application Model
 *
 * @property Expressionbesoin $Expressionbesoin
 * @property Intergrationapplicative $Intergrationapplicative
 * @property Logiciel $Logiciel
 */
class Application extends AppModel {

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
		'Expressionbesoin' => array(
			'className' => 'Expressionbesoin',
			'foreignKey' => 'application_id',
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
		'Intergrationapplicative' => array(
			'className' => 'Intergrationapplicative',
			'foreignKey' => 'application_id',
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
		'Logiciel' => array(
			'className' => 'Logiciel',
			'foreignKey' => 'application_id',
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
                if (isset($val['Application']['created'])) {
                    $results[$key]['Application']['created'] = $this->dateFormatAfterFind($val['Application']['created']);
                }      
                if (isset($val['Application']['modified'])) {
                    $results[$key]['Application']['modified'] = $this->dateFormatAfterFind($val['Application']['modified']);
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
            if (!empty($this->data['Application']['NOM'])) {
                $this->data['Application']['NOM'] = mb_strtoupper($this->data['Application']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }         
}
