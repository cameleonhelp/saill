<?php
App::uses('AppModel', 'Model');
/**
 * Societe Model
 *
 * @property Utilisateur $Utilisateur
 */
class Societe extends AppModel {

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
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'societe_id',
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
                if (isset($val['Societe']['created'])) {
                    $results[$key]['Societe']['created'] = $this->dateFormatAfterFind($val['Societe']['created']);
                }      
                if (isset($val['Societe']['modified'])) {
                    $results[$key]['Societe']['modified'] = $this->dateFormatAfterFind($val['Societe']['modified']);
                }            }
            return $results;
        }  
}
