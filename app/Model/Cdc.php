<?php
App::uses('AppModel', 'Model');
/**
 * Cdc Model
 *
 */
class Cdc extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'VERSION' => array(
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
}
