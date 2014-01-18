<?php
App::uses('AppModel', 'Model');
/**
 * Assistance Model
 *
 * @property Materielinformatique $Materielinformatique
 * @property Utilisateur $Utilisateur
 */
class Assistance extends AppModel {

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
		'Materielinformatique' => array(
			'className' => 'Materielinformatique',
			'foreignKey' => 'assistance_id',
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
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'assistance_id',
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
                if (isset($val['Assistance']['created'])) {
                    $results[$key]['Assistance']['created'] = $this->dateFormatAfterFind($val['Assistance']['created']);
                }      
                if (isset($val['Assistance']['modified'])) {
                    $results[$key]['Assistance']['modified'] = $this->dateFormatAfterFind($val['Assistance']['modified']);
                }            }
            return $results;
        }         
}
