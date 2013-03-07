<?php
App::uses('AppModel', 'Model');
/**
 * Utiliseoutil Model
 *
 * @property Utilisateur $Utilisateur
 * @property Outil $Outil
 * @property Listediffusion $Listediffusion
 * @property Dossierpartage $Dossierpartage
 */
class Utiliseoutil extends AppModel {

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
		),
		'Outil' => array(
			'className' => 'Outil',
			'foreignKey' => 'outil_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Listediffusion' => array(
			'className' => 'Listediffusion',
			'foreignKey' => 'listediffusion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Dossierpartage' => array(
			'className' => 'Dossierpartage',
			'foreignKey' => 'dossierpartage_id',
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
                if (isset($val['Utiliseoutil']['created'])) {
                    $results[$key]['Utiliseoutil']['created'] = $this->dateFormatAfterFind($val['Utiliseoutil']['created']);
                }      
                if (isset($val['Utiliseoutil']['modified'])) {
                    $results[$key]['Utiliseoutil']['modified'] = $this->dateFormatAfterFind($val['Utiliseoutil']['modified']);
                }            }
            return $results;
        }          
}
