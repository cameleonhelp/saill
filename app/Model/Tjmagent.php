<?php
App::uses('AppModel', 'Model');
/**
 * Tjmagent Model
 *
 * @property Utilisateur $Utilisateur
 */
class Tjmagent extends AppModel {

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
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'tjmagent_id',
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
                if (isset($val['Tjmagent']['created'])) {
                    $results[$key]['Tjmagent']['created'] = $this->dateFormatAfterFind($val['Tjmagent']['created']);
                }      
                if (isset($val['Tjmagent']['modified'])) {
                    $results[$key]['Tjmagent']['modified'] = $this->dateFormatAfterFind($val['Tjmagent']['modified']);
                }            
                 if (isset($val['Tjmagent']['ANNEE'])) {
                    $results[$key]['Tjmagent']['ANNEE'] = $this->yearFormatAfterFind($val['Tjmagent']['ANNEE']);
                } 
            }
            return $results;
        }   
}
