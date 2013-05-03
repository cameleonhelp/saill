<?php
App::uses('AppModel', 'Model');
/**
 * Detailplancharge Model
 *
 * @property Plancharge $Plancharge
 * @property Utilisateur $Utilisateur
 * @property Domaine $Domaine
 * @property Activite $Activite
 */
class Detailplancharge extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'plancharge_id' => array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Plancharge' => array(
			'className' => 'Plancharge',
			'foreignKey' => 'plancharge_id',
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
                if (isset($val['Detailplancharge']['created'])) {
                    $results[$key]['Detailplancharge']['created'] = $this->dateFormatAfterFind($val['Detailplancharge']['created']);
                }      
                if (isset($val['Detailplancharge']['modified'])) {
                    $results[$key]['Detailplancharge']['modified'] = $this->dateFormatAfterFind($val['Detailplancharge']['modified']);
                }                
                if (isset($val['Detailplancharge']['ETP'])) {
                    $results[$key]['Detailplancharge']['ETP'] = $this->changeSeparator($val['Detailplancharge']['ETP']);
                } 
                if (isset($val['Detailplancharge']['activite_id'])) {
                    $results[$key]['Detailplancharge']['projet_NOM'] = $this->getProjetForActivite($val['Detailplancharge']['activite_id']);
                }                
            }
            return $results;
        }   
        
        public function changeSeparator($value){
            $result = $value;
            $params = Router::getParams();
            if ($params['action'] == 'export_xls') $result = str_replace('.', ',', $value);
             return $result;
        }  
        
        public function getProjetForActivite($id){
            $sql = "SELECT projets.NOM FROM projets LEFT JOIN activites ON projets.id = activites.projet_id WHERE activites.id='".$id."'";
            $result = $this->query($sql);
            return $result[0]['projets']['NOM'];
        }           

}
