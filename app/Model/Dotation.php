<?php
App::uses('AppModel', 'Model');
/**
 * Dotation Model
 *
 * @property Materielinformatique $Materielinformatique
 * @property Utilisateur $Utilisateur
 * @property Historydotation $Historydotation
 * @property Utilisateur $Utilisateur
 */
class Dotation extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'materielinformatique_id' => array(
			/*'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
		),
		'typemateriel_id' => array(
			/*'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
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
		'Materielinformatique' => array(
			'className' => 'Materielinformatique',
			'foreignKey' => 'materielinformatique_id',
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
		),
		'Typemateriel' => array(
			'className' => 'Typemateriel',
			'foreignKey' => 'typemateriel_id',
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
		'Historydotation' => array(
			'className' => 'Historydotation',
			'foreignKey' => 'dotation_id',
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
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'dotation_id',
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
            if (!empty($this->data['Dotation']['DATERECEPTION'])) {
                $this->data['Dotation']['DATERECEPTION'] = $this->dateFormatBeforeSave($this->data['Dotation']['DATERECEPTION']);
            }
            if (!empty($this->data['Dotation']['DATEREMISE'])) {
                $this->data['Dotation']['DATEREMISE'] = $this->dateFormatBeforeSave($this->data['Dotation']['DATEREMISE']);
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
                if (isset($val['Dotation']['DATERECEPTION'])) {
                    $results[$key]['Dotation']['DATERECEPTION'] = $this->dateFormatAfterFind($val['Dotation']['DATERECEPTION']);
                }
                if (isset($val['Dotation']['DATEREMISE'])) {
                    $results[$key]['Dotation']['DATEREMISE'] = $this->dateFormatAfterFind($val['Dotation']['DATEREMISE']);
                }
                if (isset($val['Dotation']['created'])) {
                    $results[$key]['Dotation']['created'] = $this->dateFormatAfterFind($val['Dotation']['created']);
                }      
                if (isset($val['Dotation']['modified'])) {
                    $results[$key]['Message']['modified'] = $this->dateFormatAfterFind($val['Dotation']['modified']);
                }            }
            return $results;
        }        
}
