<?php
App::uses('AppModel', 'Model');
/**
 * Nfse Model
 *
 */
class Nfse extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'NB' => array(
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
                if (isset($val['Nfse']['created'])) {
                    $results[$key]['Nfse']['created'] = $this->dateFormatAfterFind($val['Nfse']['created']);
                }      
                if (isset($val['Nfse']['modified'])) {
                    $results[$key]['Nfse']['modified'] = $this->dateFormatAfterFind($val['Nfse']['modified']);
                }            
            }
            return $results;
        }            
}
