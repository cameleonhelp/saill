<?php
App::uses('AppModel', 'Model');
/**
 * Historyaction Model
 *
 * @property Historyaction $Historyaction
 */
class Historyaction extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'action_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'AVANCEMENT' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'DEBUT' => array(
		),
		'DEBUTREELLE' => array(
		),
		'ECHEANCE' => array(
		),
		'CHARGEPREVUE' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'CHARGEREELLE' => array(
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'action_id',
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
            if (!empty($this->data['Historyaction']['ECHEANCE'])) {
                $this->data['Historyaction']['ECHEANCE'] = $this->dateFormatBeforeSave($this->data['Historyaction']['ECHEANCE']);
            }
            if (!empty($this->data['Historyaction']['DEBUT'])) {
                $this->data['Historyaction']['DEBUT'] = $this->dateFormatBeforeSave($this->data['Historyaction']['DEBUT']);
            }
            if (!empty($this->data['Historyaction']['DEBUTREELLE'])) {
                $this->data['Historyaction']['DEBUTREELLE'] = $this->dateFormatBeforeSave($this->data['Historyaction']['DEBUTREELLE']);
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
                if (isset($val['Historyaction']['created'])) {
                    $results[$key]['Historyaction']['created'] = $this->dateFormatAfterFind($val['Historyaction']['created']);
                }      
                if (isset($val['Historyaction']['modified'])) {
                    $results[$key]['Historyaction']['modified'] = $this->dateFormatAfterFind($val['Historyaction']['modified']);
                }                   
                if (isset($val['Historyaction']['ECHEANCE'])) {
                    $results[$key]['Historyaction']['ECHEANCE'] = $this->dateFormatAfterFind($val['Historyaction']['ECHEANCE']);
                }      
                if (isset($val['Historyaction']['DEBUTREELLE'])) {
                    $results[$key]['Historyaction']['DEBUTREELLE'] = $this->dateFormatAfterFind($val['Historyaction']['DEBUTREELLE']);
                }   
                if (isset($val['Historyaction']['DEBUT'])) {
                    $results[$key]['Historyaction']['DEBUT'] = $this->dateFormatAfterFind($val['Historyaction']['DEBUT']);
                }                 
            }
            return $results;
        }          
}
