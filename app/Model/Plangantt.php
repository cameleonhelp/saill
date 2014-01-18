<?php
App::uses('AppModel', 'Model');
/**
 * Plangantt Model
 *
 * @property Planetape $Planetape
 * @property Planprojets $Planprojets
 * @property Utilisateurs $Utilisateurs
 */
class Plangantt extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'planetape_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'planprojets_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'NOM' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'DATEDEBUT' => array(
			'date' => array(
				'rule' => array('date'),
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
		'Planetape' => array(
			'className' => 'Planetape',
			'foreignKey' => 'planetape_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Planprojets' => array(
			'className' => 'Planprojets',
			'foreignKey' => 'planprojets_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Utilisateurs' => array(
			'className' => 'Utilisateurs',
			'foreignKey' => 'utilisateurs_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
