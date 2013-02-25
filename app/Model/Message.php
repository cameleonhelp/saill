<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 */
class Message extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */    
	public $validate = array(
		'LIBELLE' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Le message est obligatoire',
				//'allowEmpty' => false,
				//'required' => false,
				'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'DATELIMITE' => array(
			//'date' => array(
				//'rule' => array('date'),
				//'message' => 'No message',
				//'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		),
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
            if (!empty($this->data['Message']['DATELIMITE'])) {
                $this->data['Message']['DATELIMITE'] = $this->dateFormatBeforeSave($this->data['Message']['DATELIMITE']);
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
                if (isset($val['Message']['DATELIMITE'])) {
                    $results[$key]['Message']['DATELIMITE'] = $this->dateFormatAfterFind($val['Message']['DATELIMITE']);
                }
                if (isset($val['Message']['created'])) {
                    $results[$key]['Message']['created'] = $this->dateFormatAfterFind($val['Message']['created']);
                }      
                if (isset($val['Message']['modified'])) {
                    $results[$key]['Message']['modified'] = $this->dateFormatAfterFind($val['Message']['modified']);
                }            }
            return $results;
        }
    
}
