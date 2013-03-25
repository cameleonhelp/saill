<?php
App::uses('AppModel', 'Model');
/**
 * Activite Model
 *
 * @property Activite $Activite
 * @property Achat $Achat
 * @property Action $Action
 * @property Affectation $Affectation
 */
class Activite extends AppModel {

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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Projet' => array(
			'className' => 'Projet',
			'foreignKey' => 'projet_id',
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
		'Achat' => array(
			'className' => 'Achat',
			'foreignKey' => 'activite_id',
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
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'activite_id',
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
		'Affectation' => array(
			'className' => 'Affectation',
			'foreignKey' => 'activite_id',
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
        public function beforeSave() {      
            if (!empty($this->data['Activite']['DATEDEBUT'])) {
                $this->data['Activite']['DATEDEBUT'] = $this->dateFormatBeforeSave($this->data['Activite']['DATEDEBUT']);
            }
            if (!empty($this->data['Activite']['DATEFIN'])) {
                $this->data['Activite']['DATEFIN'] = $this->dateFormatBeforeSave($this->data['Activite']['DATEFIN']);
            }
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
        public function afterFind($results) {
            foreach ($results as $key => $val) {
                if (isset($val['Activite']['created'])) {
                    $results[$key]['Activite']['created'] = $this->dateFormatAfterFind($val['Activite']['created']);
                }      
                if (isset($val['Activite']['modified'])) {
                    $results[$key]['Activite']['modified'] = $this->dateFormatAfterFind($val['Activite']['modified']);
                }            
                 if (isset($val['Activite']['DATEDEBUT'])) {
                    $results[$key]['Activite']['DATEDEBUT'] = $this->dateFormatAfterFind($val['Activite']['DATEDEBUT']);
                } 
                 if (isset($val['Activite']['DATEFIN'])) {
                    $results[$key]['Activite']['DATEFIN'] = $this->dateFormatAfterFind($val['Activite']['DATEFIN']);
                } 
            }
            return $results;
        }  
}
