<?php
App::uses('AppModel', 'Model');
/**
 * Expressionbesoin Model
 *
 * @property Application $Application
 * @property Composant $Composant
 * @property Perimetre $Perimetre
 * @property Lot $Lot
 * @property Etat $Etat
 * @property Type $Type
 * @property Phase $Phase
 * @property Volumetrie $Volumetrie
 * @property Puissance $Puissance
 * @property Architecture $Architecture
 */
class Expressionbesoin extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'composant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'etat_id' => array(
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
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'application_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Composant' => array(
			'className' => 'Composant',
			'foreignKey' => 'composant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Perimetre' => array(
			'className' => 'Perimetre',
			'foreignKey' => 'perimetre_id',
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
		'Etat' => array(
			'className' => 'Etat',
			'foreignKey' => 'etat_id',
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
		'Phase' => array(
			'className' => 'Phase',
			'foreignKey' => 'phase_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Volumetrie' => array(
			'className' => 'Volumetrie',
			'foreignKey' => 'volumetrie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Puissance' => array(
			'className' => 'Puissance',
			'foreignKey' => 'puissance_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Architecture' => array(
			'className' => 'Architecture',
			'foreignKey' => 'architecture_id',
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
                'Historyexpb' => array(
			'className' => 'Historyexpb',
			'foreignKey' => 'expressionbesoins_id',
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
                if (isset($val['Expressionbesoin']['created'])) {
                    $results[$key]['Expressionbesoin']['created'] = $this->dateFormatAfterFind($val['Expressionbesoin']['created']);
                }      
                if (isset($val['Expressionbesoin']['modified'])) {
                    $results[$key]['Expressionbesoin']['modified'] = $this->dateFormatAfterFind($val['Expressionbesoin']['modified']);
                }            
                if (isset($val['Expressionbesoin']['DATELIVRAISON'])) {
                    $results[$key]['Expressionbesoin']['DATELIVRAISON'] = $this->dateFormatAfterFind($val['Expressionbesoin']['DATELIVRAISON']);
                }      
                if (isset($val['Expressionbesoin']['DATEFIN'])) {
                    $results[$key]['Expressionbesoin']['DATEFIN'] = $this->dateFormatAfterFind($val['Expressionbesoin']['DATEFIN']);
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
        public function beforeSave($options = array()) {
            if (!empty($this->data['Expressionbesoin']['DATELIVRAISON'])) {
                $this->data['Expressionbesoin']['DATELIVRAISON'] = $this->dateFormatBeforeSave($this->data['Expressionbesoin']['DATELIVRAISON']);
            }
            if (!empty($this->data['Expressionbesoin']['DATEFIN'])) {
                $this->data['Expressionbesoin']['DATEFIN'] = $this->dateFormatBeforeSave($this->data['Expressionbesoin']['DATEFIN']);
            }
            parent::beforeSave();
            return true;
        }   
        
        /**
         * import method
         * 
         * @param string $filename
         * @return type
         */
        public function importCSV($filename) {
		$filename = WWW_ROOT.'files'.DS.'upload'.DS.$filename;
 		$handle = fopen($filename, "r");
 		$header = fgetcsv($handle);
                $header= explode(';',$header[0]);
		$return = array(
			'messages' => array(),
			'errors' => array(),
		);
 		while (($row = fgetcsv($handle)) !== FALSE) {
 			@$i++;
 			$data = array();
                        $data['Expressionbesoin']['entite_id']=userAuth('entite_id');
                        $obj = $this->Etat->findByNom('A valider');
                        $data['Expressionbesoin']['etat_id']=$obj['Etat']['id'];
                        $row= explode(';',$row[0]);
                        $version = '';
 			foreach ($header as $k=>$head) {
 				if (strpos($head,'.')!==false) {
	 				$h = explode('.',$head);
	 				$data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
				} else {
                                        switch($head):
                                            case 'COMPOSANT':
                                                $obj = $this->Composant->findByNom(strtoupper(trim($row[$k])));
                                                $data['Expressionbesoin']['composant_id']=(isset($obj['Composant']['id'])) ? $obj['Composant']['id'] : null;
                                                break;
                                            case 'PERIMETRE':
                                                $obj = $this->Perimetre->findByNom(strtoupper(trim($row[$k])));
                                                $data['Expressionbesoin']['perimetre_id']=(isset($obj['Perimetre']['id'])) ? $obj['Perimetre']['id'] : null;                                                
                                                break;
                                            case 'APPLICATION':
                                                $obj = $this->Application->findByNom(strtoupper(trim($row[$k])));
                                                $data['Expressionbesoin']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                                
                                                break;
                                            case 'LOT':
                                                $obj = $this->Lot->findByNom(strtoupper(trim($row[$k])));
                                                $data['Expressionbesoin']['lot_id']=(isset($obj['Lot']['id'])) ? $obj['Lot']['id'] : null;                                                
                                                break;
                                            case 'TYPE ENVIRONNEMENT':
                                                $obj = $this->Type->findByNom(strtoupper(trim($row[$k])));
                                                $data['Expressionbesoin']['type_id']=(isset($obj['Type']['id'])) ? $obj['Type']['id'] : null;                                                
                                                break; 
                                            case 'PHASE':
                                                $obj = $this->Phase->findByNom(strtoupper(trim($row[$k])));
                                                $data['Expressionbesoin']['phase_id']=(isset($obj['Phase']['id'])) ? $obj['Phase']['id'] : null;                                                
                                                break;    
                                            case 'VOLUMETRIE':
                                                $obj = $this->Volumetrie->findByNom(strtoupper(trim($row[$k])));
                                                $data['Expressionbesoin']['volumetrie_id']=(isset($obj['Volumetrie']['id'])) ? $obj['Volumetrie']['id'] : null;                                                
                                                break;     
                                            case 'PUISSANCE':
                                                $obj = $this->Puissance->findByNom(strtoupper(trim($row[$k])));
                                                $data['Expressionbesoin']['puissance_id']=(isset($obj['Puissance']['id'])) ? $obj['Puissance']['id'] : null;                                                
                                                break; 
                                            case 'ARCHITECTURE':
                                                $obj = $this->Architecture->findByNom(strtoupper(trim($row[$k])));
                                                $data['Expressionbesoin']['architecture_id']=(isset($obj['Architecture']['id'])) ? $obj['Architecture']['id'] : null;                                                
                                                break;                                            
                                            default:
                                                $data['Expressionbesoin'][$head]=(isset($row[$k])) ? trim($row[$k]) : '';
                                        endswitch;
				}
 			}	
 			$id = isset($data['Expressionbesoin']['id']) ? $data['Expressionbesoin']['id'] : false;
 			if ($id) {
	 			$this->id = $id;
			} else {
	 			$this->create();
			}
			$this->set($data);
			if (!$this->validates()) {
				$return['errors'][] = __(sprintf('Ligne %d non valide.',$i), true);
			} else {
                            if (!$error && !$this->save($data)) {
                                    $return['errors'][] = __(sprintf('Ligne %d impossible à sauvegarder.',$i), true);
                            } else {
                                $return['messages'][] = __(sprintf('Ligne %d sauvegardée.',$i), true);
                            }
                        }
 		}
 		fclose($handle);
                unlink(realpath($filename));
 		return $return;
	}  
}
