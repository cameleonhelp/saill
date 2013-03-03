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
		/*'Suivilivrable' => array(
			'className' => 'Suivilivrable',
			'foreignKey' => '',
			'conditions' => '', //Suivilivrable.livrable_id = livrable.id
			'fields' => '',
			'order' => '' //Suivilivrable.created as desc
		),     */       
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
                }            }
            return $results;
        }         
}
