<?php
App::uses('AppModel', 'Model');
/**
 * Changelogreponse Model
 *
 * @property Changelogdemande $Changelogdemande
 * @property Utilisateur $Utilisateur
 */
class Changelogreponse extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'changelogdemande_id' => array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Changelogdemande' => array(
			'className' => 'Changelogdemande',
			'foreignKey' => 'changelogdemande_id',
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
 * afterFind method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function afterFind($results) {
            foreach ($results as $key => $val) {
                if (isset($val['Changelogreponse']['created'])) {
                    $results[$key]['Changelogreponse']['created'] = $this->datetimeFormatAfterFind($val['Changelogreponse']['created']);
                }      
                if (isset($val['Changelogreponse']['modified'])) {
                    $results[$key]['Changelogreponse']['modified'] = $this->datetimeFormatAfterFind($val['Changelogreponse']['modified']);
                }                   
                if (isset($val['Changelogreponse']['changelogdemande_id'])) {
                    $results[$key]['Changelogreponse']['COUNT'] = $this->countreponse($val['Changelogreponse']['changelogdemande_id']);
                }                  
            }
            return $results;
        }      
        
        
        public function countreponse($demande) {
            $sql = "SELECT COUNT(id) as NB FROM changelogreponses WHERE changelogdemande_id=".$demande;
            $obj = $this->query($sql);
            return $obj[0][0]['NB'];
        }
}
