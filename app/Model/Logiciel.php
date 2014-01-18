<?php
App::uses('AppModel', 'Model');
/**
 * Logiciel Model
 *
 * @property Envoutil $Envoutil
 * @property Envversion $Envversion
 * @property Application $Application
 * @property Type $Type
 * @property Lot $Lot
 * @property Assobienlogiciel $Assobienlogiciel
 * @property Historylogiciel $Historylogiciel
 */
class Logiciel extends AppModel {

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
		'envoutil_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'envversion_id' => array(
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
		'lot_id' => array(
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
		'Envoutil' => array(
			'className' => 'Envoutil',
			'foreignKey' => 'envoutil_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Envversion' => array(
			'className' => 'Envversion',
			'foreignKey' => 'envversion_id',
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
		'Lot' => array(
			'className' => 'Lot',
			'foreignKey' => 'lot_id',
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
			'foreignKey' => 'logiciel_id',
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
                if (isset($val['Logiciel']['created'])) {
                    $results[$key]['Logiciel']['created'] = $this->dateFormatAfterFind($val['Logiciel']['created']);
                }      
                if (isset($val['Logiciel']['modified'])) {
                    $results[$key]['Logiciel']['modified'] = $this->dateFormatAfterFind($val['Logiciel']['modified']);
                }            
            }
            return $results;
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
                        $data['Logiciel']['entite_id']=userAuth('entite_id');
                        $row= explode(';',$row[0]);
                        $error = false;
 			foreach ($header as $k=>$head) {
 				if (strpos($head,'.')!==false) {
	 				$h = explode('.',$head);
	 				$data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
				} else {
                                        switch($head):
                                            case 'OUTIL':
                                                $obj = $this->Envoutil->findByNom(strtoupper(trim($row[$k])));
                                                $data['Logiciel']['envoutil_id']=(isset($obj['Envoutil']['id'])) ? $obj['Envoutil']['id'] : null;
                                                break;
                                            case 'VERSION':
                                                $version = (isset($row[$k])) ? trim($row[$k]) : '';
                                                break;
                                            case 'EDITION':
                                                $edition = (isset($row[$k])) ? trim($row[$k]) : '';
                                                $obj = $this->Envversion->find('first',array('conditions'=>array('Envversion.VERSION'=>$version,'Envversion.EDITION'=>$edition),'recursive'=>-1));
                                                $data['Logiciel']['envversion_id']=(isset($obj['Envversion']['id'])) ? $obj['Envversion']['id'] : 0;                                                
                                                break;
                                            case 'APPLICATION':
                                                $obj = $this->Application->findByNom(strtoupper(trim($row[$k])));
                                                $data['Logiciel']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                                
                                                break;
                                            case 'LOT':
                                                $obj = $this->Lot->findByNom(strtoupper(trim($row[$k])));
                                                $data['Logiciel']['lot_id']=(isset($obj['Lot']['id'])) ? $obj['Lot']['id'] : null;                                                
                                                break;
                                            default:
                                                $data['Logiciel'][$head]=(isset($row[$k])) ? trim($row[$k]) : '';
                                        endswitch;
				}
 			}	
 			$id = isset($data['Logiciel']['id']) ? $data['Logiciel']['id'] : false;
 			if ($id) {
	 			$this->id = $id;
			} else {
	 			$this->create();
			}
			$this->set($data);
			if (!$this->validates()) {
				//$this->Session->flash('warning');
                                $error = true;
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
