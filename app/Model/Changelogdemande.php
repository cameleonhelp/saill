<?php
App::uses('AppModel', 'Model');
/**
 * Changelogdemande Model
 *
 * @property Changelogversion $Changelogversion
 * @property Utilisateur $Utilisateur
 * @property Changelogreponse $Changelogreponse
 */
class Changelogdemande extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'OPEN' => array(
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
		'Changelogversion' => array(
			'className' => 'Changelogversion',
			'foreignKey' => 'changelogversion_id',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Changelogreponse' => array(
			'className' => 'Changelogreponse',
			'foreignKey' => 'changelogdemande_id',
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
        public function afterFind($results) {
            foreach ($results as $key => $val) {
                if (isset($val['Changelogdemande']['created'])) {
                    $results[$key]['Changelogdemande']['created'] = $this->datetimeFormatAfterFind($val['Changelogdemande']['created']);
                }      
                if (isset($val['Changelogdemande']['modified'])) {
                    $results[$key]['Changelogdemande']['modified'] = $this->datetimeFormatAfterFind($val['Changelogdemande']['modified']);
                }            
                if (isset($val['Changelogdemande']['id'])) {
                    $results[$key]['Changelogdemande']['COUNT'] = $this->countreponse($val['Changelogdemande']['id']);
                }  
                if (isset($val['Changelogdemande']['DATEPREVUE'])) {
                    $results[$key]['Changelogdemande']['DATEPREVUE'] = $this->datetimeToDateAfterFind($val['Changelogdemande']['DATEPREVUE']);
                }      
                if (isset($val['Changelogdemande']['DATEREELLE'])) {
                    $results[$key]['Changelogdemande']['DATEREELLE'] = $this->datetimeToDateAfterFind($val['Changelogdemande']['DATEREELLE']);
                }                     
            }
            return $results;
        }      
        
/**
 * beforeSave method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function beforeSave() {
            if (!empty($this->data['Changelogdemande']['DATEPREVUE'])) {
                $this->data['Changelogdemande']['DATEPREVUE'] = $this->dateToDatetimeBeforeSave($this->data['Changelogdemande']['DATEPREVUE']);
            } 
            if (!empty($this->data['Changelogdemande']['DATEREELLE'])) {
                $this->data['Changelogdemande']['DATEREELLE'] = $this->datetimeFormatBeforeSave($this->data['Changelogdemande']['DATEREELLE']);
            } 
            parent::beforeSave();
            return true;
        }
        
        public function countreponse($demande) {
            $sql = "SELECT COUNT(id) as NB FROM changelogreponses WHERE changelogdemande_id=".$demande;
            $obj = $this->query($sql);
            return $obj[0][0]['NB'];
        }
}
