<?php
App::uses('AppModel', 'Model');
/**
 * Facturation Model
 *
 * @property Utilisateur $Utilisateur
 * @property Activite $Activite
 * @property Activitesreelle $Activitesreelle
 * @property Activitesreelle $Activitesreelle
 */
class Facturation extends AppModel {

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
		'activitesreelle_id' => array(
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
		'Activite' => array(
			'className' => 'Activite',
			'foreignKey' => 'activite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Activitesreelle' => array(
			'className' => 'Activitesreelle',
			'foreignKey' => 'activitesreelle_id',
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
		'Activitesreelle' => array(
			'className' => 'Activitesreelle',
			'foreignKey' => 'facturation_id',
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

        public $virtualFields = array(
            //'MAXVERSION' => 'MAX(Facturation.VERSION)'
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
            if (!empty($this->data['Facturation']['DATE'])) {
                $this->data['Facturation']['DATE'] = $this->dateFormatBeforeSave($this->data['Facturation']['DATE']);
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
                if (isset($val['Facturation']['created'])) {
                    $results[$key]['Facturation']['created'] = $this->dateFormatAfterFind($val['Facturation']['created']);
                }      
                if (isset($val['Facturation']['modified'])) {
                    $results[$key]['Facturation']['modified'] = $this->dateFormatAfterFind($val['Facturation']['modified']);
                }                   
                if (isset($val['Facturation']['DATE'])) {
                    $results[$key]['Facturation']['DATE'] = $this->dateFormatAfterFind($val['Facturation']['DATE']);
                }   
                if (isset($val['Activite']['projet_id'])) {
                    $results[$key]['Facturation']['projet_NOM'] = $this->getProjetForActivite($val['Activite']['projet_id']);
                }      
                if (isset($val['Facturation']['TOTAL'])) {
                    $results[$key]['Facturation']['TOTAL'] = $this->changeSeparator($val['Facturation']['TOTAL']);
                }                  
            }
            return $results;
        } 
        
        public function getProjetForActivite($id){
            $sql = "SELECT NOM FROM projets WHERE id='".$id."'";
            $result = $this->query($sql);
            return $result[0]['projets']['NOM'];
        }
        
        public function changeSeparator($value){
             return str_replace('.', ',', $value);
        }
}
