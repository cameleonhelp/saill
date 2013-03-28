<?php
App::uses('AppModel', 'Model');
/**
 * Actionslivrable Model
 *
 * @property Livrables $Livrables
 * @property Actions $Actions
 */
class Actionslivrable extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'livrables_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'actions_id' => array(
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
			'foreignKey' => 'livrables_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'actions_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
