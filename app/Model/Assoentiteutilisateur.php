<?php
App::uses('AppModel', 'Model');
/**
 * Assoentiteutilisateur Model
 *
 * @property Entite $Entite
 * @property Utilisateur $Utilisateur
 */
class Assoentiteutilisateur extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'entite_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Entite' => array(
			'className' => 'Entite',
			'foreignKey' => 'entite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'utilisateur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
