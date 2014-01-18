<?php
App::uses('AppModel', 'Model');
/**
 * Cpus Model
 *
 */
class Cpus extends AppModel {

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
                if (isset($val['Cpus']['created'])) {
                    $results[$key]['Cpus']['created'] = $this->dateFormatAfterFind($val['Cpus']['created']);
                }      
                if (isset($val['Cpus']['modified'])) {
                    $results[$key]['Cpus']['modified'] = $this->dateFormatAfterFind($val['Cpus']['modified']);
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
            if (!empty($this->data['Cpus']['NOM'])) {
                $this->data['Cpus']['NOM'] = mb_strtoupper($this->data['Cpus']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }           
}
