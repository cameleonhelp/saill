<?php
App::uses('AppModel', 'Model');
/**
 * Suivilivrable Model
 *
 * @property Livrable $Livrable
 */
class Suivilivrable extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'livrable_id' => array(
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
		'Livrable' => array(
			'className' => 'Livrable',
			'foreignKey' => 'livrable_id',
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
            if (!empty($this->data['Suivilivrable']['ECHEANCE'])) {
                $this->data['Suivilivrable']['ECHEANCE'] = $this->dateFormatBeforeSave($this->data['Suivilivrable']['ECHEANCE']);
            }
            if (!empty($this->data['Suivilivrable']['DATELIVRAISON'])) {
                $this->data['Suivilivrable']['DATELIVRAISON'] = $this->dateFormatBeforeSave($this->data['Suivilivrable']['DATELIVRAISON']);
            }
            if (!empty($this->data['Suivilivrable']['DATEVALIDATION'])) {
                $this->data['Suivilivrable']['DATEVALIDATION'] = $this->dateFormatBeforeSave($this->data['Suivilivrable']['DATEVALIDATION']);
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
                if (isset($val['Suivilivrable']['created'])) {
                    $results[$key]['Suivilivrable']['created'] = $this->dateFormatAfterFind($val['Suivilivrable']['created']);
                }      
                if (isset($val['Suivilivrable']['modified'])) {
                    $results[$key]['Suivilivrable']['modified'] = $this->dateFormatAfterFind($val['Suivilivrable']['modified']);
                }            
                if (isset($val['Suivilivrable']['ECHEANCE'])) {
                    $results[$key]['Suivilivrable']['ECHEANCE'] = $this->dateFormatAfterFind($val['Suivilivrable']['ECHEANCE']);
                } 
                if (isset($val['Suivilivrable']['DATELIVRAISON'])) {
                    $results[$key]['Suivilivrable']['DATELIVRAISON'] = $this->dateFormatAfterFind($val['Suivilivrable']['DATELIVRAISON']);
                } 
                if (isset($val['Suivilivrable']['DATEVALIDATION'])) {
                    $results[$key]['Suivilivrable']['DATEVALIDATION'] = $this->dateFormatAfterFind($val['Suivilivrable']['DATEVALIDATION']);
                } 
            }
            return $results;
        }          
}
