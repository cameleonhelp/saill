<?php
App::uses('AppModel', 'Model');
/**
 * Wase Model
 *
 */
class Wase extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'VERSION' => array(
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
                if (isset($val['Wase']['created'])) {
                    $results[$key]['Wase']['created'] = $this->dateFormatAfterFind($val['Wase']['created']);
                }      
                if (isset($val['Wase']['modified'])) {
                    $results[$key]['Wase']['modified'] = $this->dateFormatAfterFind($val['Wase']['modified']);
                }            
            }
            return $results;
        }            
}
