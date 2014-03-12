<?php
App::uses('AppModel', 'Model');
/**
 * Plancharge Model
 *
 * @property Projet $Projet
 * @property Detailplancharge $Detailplancharge
 */
class Plancharge extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'projet_id' => array(
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
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ANNEE' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'TJM' => array(
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
		'Contrat' => array(
			'className' => 'Contrat',
			'foreignKey' => 'contrat_id',
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
		'Detailplancharge' => array(
			'className' => 'Detailplancharge',
			'foreignKey' => 'plancharge_id',
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
 * beforeSave method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function beforeSave($options = array()) {
            parent::beforeSave();
            return true;
        }
        
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
                if (isset($val['Plancharge']['created'])) {
                    $results[$key]['Plancharge']['created'] = $this->dateFormatAfterFind($val['Plancharge']['created']);
                }      
                if (isset($val['Plancharge']['modified'])) {
                    $results[$key]['Plancharge']['modified'] = $this->dateFormatAfterFind($val['Plancharge']['modified']);
                }    
                $results[$key]['Entite']['NOM'] = $this->get_entite_nom(@$val['Plancharge']['entite_id']); 
            }
            return $results;
        }   
        
        public function changeSeparator($value){
             return str_replace('.', ',', $value);
        }        
}
