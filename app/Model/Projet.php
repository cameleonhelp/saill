<?php
App::uses('AppModel', 'Model');
/**
 * Projet Model
 *
 * @property Contrat $Contrat
 * @property Activite $Activite
 */
class Projet extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'contrat_id' => array(
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
		'ACTIF' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
		'Activite' => array(
			'className' => 'Activite',
			'foreignKey' => 'projet_id',
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
            if (!empty($this->data['Projet']['DEBUT'])) {
                $this->data['Projet']['DEBUT'] = $this->dateFormatBeforeSave($this->data['Projet']['DEBUT']);
            }
            if (!empty($this->data['Projet']['FIN'])) {
                $this->data['Projet']['FIN'] = $this->dateFormatBeforeSave($this->data['Projet']['FIN']);
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
                if (isset($val['Projet']['created'])) {
                    $results[$key]['Projet']['created'] = $this->dateFormatAfterFind($val['Projet']['created']);
                }      
                if (isset($val['Projet']['modified'])) {
                    $results[$key]['Projet']['modified'] = $this->dateFormatAfterFind($val['Projet']['modified']);
                }            
                 if (isset($val['Projet']['DEBUT'])) {
                    $results[$key]['Projet']['DEBUT'] = $this->dateFormatAfterFind($val['Projet']['DEBUT']);
                } 
                 if (isset($val['Projet']['FIN'])) {
                    $results[$key]['Projet']['FIN'] = $this->dateFormatAfterFind($val['Projet']['FIN']);
                } 
            }
            return $results;
        }         
}
