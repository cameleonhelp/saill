<?php
App::uses('AppModel', 'Model');
/**
 * Suivilivrable Model
 *
 * @property Livrable $Livrable
 */
class Suivilivrable extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'livrable_id' => array(
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
		'Livrable' => array(
			'className' => 'Livrable',
			'foreignKey' => 'livrable_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
