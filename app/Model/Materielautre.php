<?php
App::uses('AppModel', 'Model');
/**
 * Materielautre Model
 *
 * @property Typemateriel $Typemateriel
 * @property Dotation $Dotation
 */
class Materielautre extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'typemateriel_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Typemateriel' => array(
			'className' => 'Typemateriel',
			'foreignKey' => 'typemateriel_id',
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
		'Dotation' => array(
			'className' => 'Dotation',
			'foreignKey' => 'materielautre_id',
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
                if (isset($val['Materielautre']['created'])) {
                    $results[$key]['Materielautre']['created'] = $this->dateFormatAfterFind($val['Materielautre']['created']);
                }      
                if (isset($val['Materielautre']['modified'])) {
                    $results[$key]['Materielautre']['modified'] = $this->dateFormatAfterFind($val['Materielautre']['modified']);
                }            }
            return $results;
        } 
}
