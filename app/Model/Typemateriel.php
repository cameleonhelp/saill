<?php
App::uses('AppModel', 'Model');
/**
 * Typemateriel Model
 *
 * @property Materielautre $Materielautre
 * @property Materielinformatique $Materielinformatique
 */
class Typemateriel extends AppModel {

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
		'Materielautre' => array(
			'className' => 'Materielautre',
			'foreignKey' => 'typemateriel_id',
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
		'Materielinformatique' => array(
			'className' => 'Materielinformatique',
			'foreignKey' => 'typemateriel_id',
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
                if (isset($val['Typemateriel']['created'])) {
                    $results[$key]['Typemateriel']['created'] = $this->dateFormatAfterFind($val['Typemateriel']['created']);
                }      
                if (isset($val['Typemateriel']['modified'])) {
                    $results[$key]['Typemateriel']['modified'] = $this->dateFormatAfterFind($val['Typemateriel']['modified']);
                }            }
            return $results;
        }  
}
