<?php
App::uses('AppModel', 'Model');
/**
 * Actioncontributeur Model
 *
 * @property Utilisateur $Utilisateur
 * @property Action $Action
 */
class Actioncontributeur extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'utilisateur_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'action_id' => array(
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
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'utilisateur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'action_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
