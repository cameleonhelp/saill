<?php
App::uses('AppModel', 'Model');
/**
 * Dossierpartage Model
 *
 * @property Utiliseoutil $Utiliseoutil
 */
class Dossierpartage extends AppModel {

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
		'Utiliseoutil' => array(
			'className' => 'Utiliseoutil',
			'foreignKey' => 'dossierpartage_id',
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
                if (isset($val['Dossierpartage']['created'])) {
                    $results[$key]['Dossierpartage']['created'] = $this->dateFormatAfterFind($val['Dossierpartage']['created']);
                }      
                if (isset($val['Dossierpartage']['modified'])) {
                    $results[$key]['Dossierpartage']['modified'] = $this->dateFormatAfterFind($val['Dossierpartage']['modified']);
                }            }
            return $results;
        } 
}
