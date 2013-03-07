<?php
App::uses('AppModel', 'Model');
/**
 * Action Model
 *
 * @property Domaine $Domaine
 * @property Activite $Activite
 * @property Utilisateur $Utilisateur
 * @property Action $Action
 * @property Historyaction $Historyaction
 */
class Action extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'domaine_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'activite_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
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
		'destinataire' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'OBJET' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		//'COMMENTAIRE' => array(
			//'notempty' => array(
				//'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		//),
		'DEBUT' => array(
			/*'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
		),
		'ECHEANCE' => array(
			/*'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Domaine' => array(
			'className' => 'Domaine',
			'foreignKey' => 'domaine_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Activite' => array(
			'className' => 'Activite',
			'foreignKey' => 'activite_id',
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
		'Livrable' => array(
			'className' => 'Livrable',
			'foreignKey' => 'livrable_id',
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
		'Historyaction' => array(
			'className' => 'Historyaction',
			'foreignKey' => 'action_id',
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
            if (!empty($this->data['Action']['ECHEANCE'])) {
                $this->data['Action']['ECHEANCE'] = $this->dateFormatBeforeSave($this->data['Action']['ECHEANCE']);
            }
            if (!empty($this->data['Action']['DEBUT'])) {
                $this->data['Action']['DEBUT'] = $this->dateFormatBeforeSave($this->data['Action']['DEBUT']);
            }
            if (!empty($this->data['Action']['DEBUTREELLE'])) {
                $this->data['Action']['DEBUTREELLE'] = $this->dateFormatBeforeSave($this->data['Action']['DEBUTREELLE']);
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
                if (isset($val['Action']['created'])) {
                    $results[$key]['Action']['created'] = $this->dateFormatAfterFind($val['Action']['created']);
                }      
                if (isset($val['Action']['modified'])) {
                    $results[$key]['Action']['modified'] = $this->dateFormatAfterFind($val['Action']['modified']);
                }                   
                if (isset($val['Action']['ECHEANCE'])) {
                    $results[$key]['Action']['ECHEANCE'] = $this->dateFormatAfterFind($val['Action']['ECHEANCE']);
                }      
                if (isset($val['Action']['DEBUTREELLE'])) {
                    $results[$key]['Action']['DEBUTREELLE'] = $this->dateFormatAfterFind($val['Action']['DEBUTREELLE']);
                }   
                if (isset($val['Action']['DEBUT'])) {
                    $results[$key]['Action']['DEBUT'] = $this->dateFormatAfterFind($val['Action']['DEBUT']);
                }                 
            }
            return $results;
        }  
}
