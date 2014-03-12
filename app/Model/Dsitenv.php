<?php
App::uses('AppModel', 'Model');
/**
 * Dsitenv Model
 *
 * @property Entite $Entite
 * @property Application $Application
 * @property Assobienlogiciel $Assobienlogiciel
 * @property Expressionbesoin $Expressionbesoin
 */
class Dsitenv extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'application_id',
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
		'Assobienlogiciel' => array(
			'className' => 'Assobienlogiciel',
			'foreignKey' => 'dsitenv_id',
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
		'Expressionbesoin' => array(
			'className' => 'Expressionbesoin',
			'foreignKey' => 'dsitenv_id',
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

        public function afterFind($results, $primary = false) {
            foreach ($results as $key => $val) {
                if (isset($val['Dsitenv']['created'])) {
                    $results[$key]['Dsitenv']['created'] = $this->datetimeFormatAfterFind($val['Dsitenv']['created']);
                }      
                if (isset($val['Dsitenv']['modified'])) {
                    $results[$key]['Dsitenv']['modified'] = $this->datetimeFormatAfterFind($val['Dsitenv']['modified']);
                }            
                $results[$key]['Entite']['NOM'] = $this->get_entite_nom(@$val['Dsitenv']['entite_id']); 
            }
            return $results;
        }   
}
