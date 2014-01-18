<?php
App::uses('AppModel', 'Model');
/**
 * Historyutilisateur Model
 *
 * @property Utilisateur $Utilisateur
 */
class Historyutilisateur extends AppModel {

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
                if (isset($val['Historyutilisateur']['created'])) {
                    $results[$key]['Historyutilisateur']['created'] = $this->dateFormatAfterFind($val['Historyutilisateur']['created']);
                }      
                if (isset($val['Historyutilisateur']['modified'])) {
                    $results[$key]['Historyutilisateur']['modified'] = $this->dateFormatAfterFind($val['Historyutilisateur']['modified']);
                }            
            }
            return $results;
        }          
}
