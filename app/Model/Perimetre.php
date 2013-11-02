<?php
App::uses('AppModel', 'Model');
/**
 * Perimetre Model
 *
 * @property Expressionbesoin $Expressionbesoin
 */
class Perimetre extends AppModel {

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
			'foreignKey' => 'perimetre_id',
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
            if (!empty($this->data['Perimetre']['NOM'])) {
                $this->data['Perimetre']['NOM'] = mb_strtoupper($this->data['Perimetre']['NOM'],'UTF-8');
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
                if (isset($val['Perimetre']['created'])) {
                    $results[$key]['Perimetre']['created'] = $this->dateFormatAfterFind($val['Perimetre']['created']);
                }      
                if (isset($val['Perimetre']['modified'])) {
                    $results[$key]['Perimetre']['modified'] = $this->dateFormatAfterFind($val['Perimetre']['modified']);
                }            
            }
            return $results;
        }           
}
