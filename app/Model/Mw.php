<?php
App::uses('AppModel', 'Model');
/**
 * Mw Model
 *
 * @property Envoutil $Envoutil
 */
class Mw extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
                if (isset($val['Mw']['created'])) {
                    $results[$key]['Mw']['created'] = $this->dateFormatAfterFind($val['Mw']['created']);
                }      
                if (isset($val['Mw']['modified'])) {
                    $results[$key]['Mw']['modified'] = $this->dateFormatAfterFind($val['Mw']['modified']);
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
            if (!empty($this->data['Mw']['NOM'])) {
                $this->data['Mw']['NOM'] = mb_strtoupper($this->data['Mw']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }             
}
