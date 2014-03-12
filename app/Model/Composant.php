<?php
App::uses('AppModel', 'Model');
/**
 * Composant Model
 *
 * @property Expressionbesoin $Expressionbesoin
 */
class Composant extends AppModel {

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
		'Expressionbesoin' => array(
			'className' => 'Expressionbesoin',
			'foreignKey' => 'composant_id',
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
 * afterFind method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function afterFind($results, $primary = false) {
            foreach ($results as $key => $val) {
                if (isset($val['Composant']['created'])) {
                    $results[$key]['Composant']['created'] = $this->dateFormatAfterFind($val['Composant']['created']);
                }      
                if (isset($val['Composant']['modified'])) {
                    $results[$key]['Composant']['modified'] = $this->dateFormatAfterFind($val['Composant']['modified']);
                }   
                $results[$key]['Entite']['NOM'] = $this->get_entite_nom(@$val['Composant']['entite_id']); 
            }
            return $results;
        }         
}
