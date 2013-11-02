<?php
App::uses('AppModel', 'Model');
/**
 * Volumetry Model
 *
 */
class Volumetry extends AppModel {

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
        public function afterFind($results) {
            foreach ($results as $key => $val) {
                if (isset($val['Volumetry']['created'])) {
                    $results[$key]['Volumetry']['created'] = $this->dateFormatAfterFind($val['Volumetry']['created']);
                }      
                if (isset($val['Volumetry']['modified'])) {
                    $results[$key]['Volumetry']['modified'] = $this->dateFormatAfterFind($val['Volumetry']['modified']);
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
            if (!empty($this->data['Volumetry']['NOM'])) {
                $this->data['Volumetry']['NOM'] = mb_strtoupper($this->data['Volumetry']['NOM'],'UTF-8');
            }                
            parent::beforeSave();
            return true;
        }         
}
