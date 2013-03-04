<?php
App::uses('AppModel', 'Model');
/**
 * Livrable Model
 *
 * @property Utilisateur $Utilisateur
 * @property Action $Action
 * @property Suivilivrable $Suivilivrable
 */
class Livrable extends AppModel {

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
		'ETAT' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		), 
		'ECHEANCE' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'DATELIVRAISON' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'DATEVALIDATION' => array(
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
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'utilisateur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),   
	);
        
 /**
 * hasMany associations
 *
 * @var array
 */
	public $hasOne = array(
            
        );       

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'livrable_id',
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
		'Suivilivrable' => array(
			'className' => 'Suivilivrable',
			'foreignKey' => 'livrable_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Suivilivrable.created desc, Suivilivrable.id desc',
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
            if (!empty($this->data['Livrable']['ECHEANCE'])) {
                $this->data['Livrable']['ECHEANCE'] = $this->dateFormatBeforeSave($this->data['Livrable']['ECHEANCE']);
            }
            if (!empty($this->data['Livrable']['DATELIVRAISON'])) {
                $this->data['Livrable']['DATELIVRAISON'] = $this->dateFormatBeforeSave($this->data['Livrable']['DATELIVRAISON']);
            }
            if (!empty($this->data['Livrable']['DATEVALIDATION'])) {
                $this->data['Livrable']['DATEVALIDATION'] = $this->dateFormatBeforeSave($this->data['Livrable']['DATEVALIDATION']);
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
                if (isset($val['Livrable']['created'])) {
                    $results[$key]['Livrable']['created'] = $this->dateFormatAfterFind($val['Livrable']['created']);
                }      
                if (isset($val['Livrable']['modified'])) {
                    $results[$key]['Livrable']['modified'] = $this->dateFormatAfterFind($val['Livrable']['modified']);
                }                   
                if (isset($val['Livrable']['ECHEANCE'])) {
                    $results[$key]['Livrable']['ECHEANCE'] = $this->dateFormatAfterFind($val['Livrable']['ECHEANCE']);
                }      
                if (isset($val['Livrable']['DATEVALIDATION'])) {
                    $results[$key]['Livrable']['DATEVALIDATION'] = $this->dateFormatAfterFind($val['Livrable']['DATEVALIDATION']);
                }   
                if (isset($val['Livrable']['DATELIVRAISON'])) {
                    $results[$key]['Livrable']['DATELIVRAISON'] = $this->dateFormatAfterFind($val['Livrable']['DATELIVRAISON']);
                }                 
            }
            return $results;
        }         
}
