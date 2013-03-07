<?php
App::uses('AppModel', 'Model');
/**
 * Achat Model
 *
 * @property Activite $Activite
 */
class Achat extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'LIBELLEACHAT' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'DATE' => array(
			/*'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
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
            if (!empty($this->data['Achat']['DATE'])) {
                $this->data['Achat']['DATE'] = $this->dateFormatBeforeSave($this->data['Achat']['DATE']);
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
                if (isset($val['Achat']['created'])) {
                    $results[$key]['Achat']['created'] = $this->dateFormatAfterFind($val['Achat']['created']);
                }      
                if (isset($val['Achat']['modified'])) {
                    $results[$key]['Achat']['modified'] = $this->dateFormatAfterFind($val['Achat']['modified']);
                }            
                 if (isset($val['Achat']['DATE'])) {
                    $results[$key]['Achat']['DATE'] = $this->dateFormatAfterFind($val['Achat']['DATE']);
                } 
            }
            return $results;
        }   
}
