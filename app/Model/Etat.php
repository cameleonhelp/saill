<?php
App::uses('AppModel', 'Model');
/**
 * Etat Model
 *
 * @property Expressionbesoin $Expressionbesoin
 * @property Historyexpb $Historyexpb
 */
class Etat extends AppModel {

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
			'foreignKey' => 'etat_id',
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
		'Historyexpb' => array(
			'className' => 'Historyexpb',
			'foreignKey' => 'etat_id',
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
                if (isset($val['Etat']['created'])) {
                    $results[$key]['Etat']['created'] = $this->dateFormatAfterFind($val['Etat']['created']);
                }      
                if (isset($val['Etat']['modified'])) {
                    $results[$key]['Etat']['modified'] = $this->dateFormatAfterFind($val['Etat']['modified']);
                }    
                $results[$key]['Entite']['NOM'] = $this->get_entite_nom(@$val['Etat']['entite_id']);                  
            }
            return $results;
        }     
}
