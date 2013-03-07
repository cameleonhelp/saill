<?php
App::uses('AppModel', 'Model');
/**
 * Historydotation Model
 *
 * @property Dotation $Dotation
 */
class Historydotation extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'dotation_id' => array(
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
		'Dotation' => array(
			'className' => 'Dotation',
			'foreignKey' => 'dotation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
