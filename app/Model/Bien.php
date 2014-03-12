<?php
App::uses('AppModel', 'Model');
/**
 * Bien Model
 *
 * @property Modele $Modele
 * @property Chassis $Chassis
 * @property Type $Type
 * @property Application $Application
 * @property Usage $Usage
 * @property Lot $Lot
 * @property Cpu $Cpu
 * @property Assobienlogiciel $Assobienlogiciel
 * @property Environnemntbien $Environnemntbien
 */
class Bien extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'modele_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'chassis_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'application_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'NOM' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Le nom du bien doit être unique, ce nom existe déjà.',
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
		'Modele' => array(
			'className' => 'Modele',
			'foreignKey' => 'modele_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Chassis' => array(
			'className' => 'Chassis',
			'foreignKey' => 'chassis_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'application_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Usage' => array(
			'className' => 'Usage',
			'foreignKey' => 'usage_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Lot' => array(
			'className' => 'Lot',
			'foreignKey' => 'lot_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cpus' => array(
			'className' => 'Cpus',
			'foreignKey' => 'cpu_id',
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
		'Assobienlogiciel' => array(
			'className' => 'Assobienlogiciel',
			'foreignKey' => 'bien_id',
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
                'Historybien' => array(
			'className' => 'Historybien',
			'foreignKey' => 'biens_id',
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
		'Environnemntbien' => array(
			'className' => 'Environnemntbien',
			'foreignKey' => 'bien_id',
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
        public function afterFind($results, $primary = false) {
            foreach ($results as $key => $val) {
                if (isset($val['Bien']['created'])) {
                    $results[$key]['Bien']['created'] = $this->dateFormatAfterFind($val['Bien']['created']);
                }      
                if (isset($val['Bien']['modified'])) {
                    $results[$key]['Bien']['modified'] = $this->dateFormatAfterFind($val['Bien']['modified']);
                }    
                if (isset($val['Bien']['DATECHECKINSTALL'])) {
                    $results[$key]['Bien']['DATECHECKINSTALL'] = $this->dateFormatAfterFind($val['Bien']['DATECHECKINSTALL']);
                }      
                if (isset($val['Bien']['DATEINSTALL'])) {
                    $results[$key]['Bien']['DATEINSTALL'] = $this->datetimeFormatAfterFind($val['Bien']['DATEINSTALL']);
                }                   
                if (isset($val['Bien']['CHECKBY'])) {
                    $results[$key]['Bien']['CHECKBY_NOM'] = $this->getValideur($val['Bien']['CHECKBY']);
                }       
                if (isset($val['Bien']['chassis_id'])) {
                    $results[$key]['Localite']['NOM'] = $this->getLocalite($val['Bien']['chassis_id']);
                } 
                $results[$key]['Entite']['NOM'] = $this->get_entite_nom(@$val['Bien']['entite_id']); 
            }
            return $results;
        } 
        
        public function getValideur($id){
            $value = false;
            if ($id != 0):
            $sql = 'SELECT CONCAT(NOM," ",PRENOM) AS NOMLONG FROM utilisateurs WHERE id="'.$id.'"';
            $result = $this->query($sql);
            $value =  isset($result[0][0]['NOMLONG']) ? $result[0][0]['NOMLONG'] : '';
            endif;
            return $value;
        }
        
        public function getLocalite($id){
            $value = false;
            if ($id != 0):
            $sql = 'SELECT localites.NOM FROM chassis LEFT JOIN localites on chassis.localite_id = localites.id WHERE chassis.id="'.$id.'"';
            $result = $this->query($sql);
            $value =  isset($result[0]['localites']['NOM']) ? $result[0]['localites']['NOM'] : '';
            endif;
            return $value;
        }        
        
 /**
 * beforeSave method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function beforeSave($options = array()) {
            if (!empty($this->data['Bien']['NOM'])) {
                $this->data['Bien']['NOM'] = mb_strtoupper($this->data['Bien']['NOM'],'UTF-8');
            }                   
            parent::beforeSave();
            return true;
        }          
}
