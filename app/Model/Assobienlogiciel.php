<?php
App::uses('AppModel', 'Model');
/**
 * Assobienlogiciel Model
 *
 * @property Bien $Bien
 * @property Logiciel $Logiciel
 */
class Assobienlogiciel extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'bien_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'logiciel_id' => array(
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
		'Bien' => array(
			'className' => 'Bien',
			'foreignKey' => 'bien_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Logiciel' => array(
			'className' => 'Logiciel',
			'foreignKey' => 'logiciel_id',
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

                'Historylogiciel' => array(
			'className' => 'Historylogiciel',
			'foreignKey' => 'assobienlogiciel_id',
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
                if (isset($val['Assobienlogiciel']['created'])) {
                    $results[$key]['Assobienlogiciel']['created'] = $this->dateFormatAfterFind($val['Assobienlogiciel']['created']);
                }      
                if (isset($val['Assobienlogiciel']['modified'])) {
                    $results[$key]['Assobienlogiciel']['modified'] = $this->dateFormatAfterFind($val['Assobienlogiciel']['modified']);
                } 
                if (isset($val['Assobienlogiciel']['DATEINSTALL'])) {
                    $results[$key]['Assobienlogiciel']['DATEINSTALL'] = $this->datetimeFormatAfterFind($val['Assobienlogiciel']['DATEINSTALL']);
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
            if (!empty($this->data['Assobienlogiciel']['ENVDSIT'])) {
                $this->data['Assobienlogiciel']['ENVDSIT'] = mb_strtoupper($this->data['Assobienlogiciel']['ENVDSIT'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }           
}
