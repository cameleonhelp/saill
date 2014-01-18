<?php
App::uses('AppModel', 'Model');
/**
 * Tjmcontrat Model
 *
 * @property Contrat $Contrat
 */
class Tjmcontrat extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ANNEE' => array(
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
		'Contrat' => array(
			'className' => 'Contrat',
			'foreignKey' => 'tjmcontrat_id',
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
        public function beforeSave($options = array()) {      
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
        public function afterFind($results, $primary = false) {
            foreach ($results as $key => $val) {
                if (isset($val['Tjmcontrat']['created'])) {
                    $results[$key]['Tjmcontrat']['created'] = $this->dateFormatAfterFind($val['Tjmcontrat']['created']);
                }      
                if (isset($val['Tjmcontrat']['modified'])) {
                    $results[$key]['Tjmcontrat']['modified'] = $this->dateFormatAfterFind($val['Tjmcontrat']['modified']);
                }            
                 if (isset($val['Tjmcontrat']['ANNEE'])) {
                    $results[$key]['Tjmcontrat']['ANNEE'] = $this->yearFormatAfterFind($val['Tjmcontrat']['ANNEE']);
                } 
            }
            return $results;
        }         
}
