<?php
App::uses('AppModel', 'Model');
/**
 * Historybien Model
 *
 * @property Biens $Biens
 */
class Historybien extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'biens_id' => array(
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
		'Biens' => array(
			'className' => 'Biens',
			'foreignKey' => 'biens_id',
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
                if (isset($val['Historybien']['created'])) {
                    $results[$key]['Historybien']['created'] = $this->datetimeFormatAfterFind($val['Historybien']['created']);
                }      
                if (isset($val['Historybien']['modified'])) {
                    $results[$key]['Historybien']['modified'] = $this->datetimeFormatAfterFind($val['Historybien']['modified']);
                }  
                if (isset($val['Historybien']['DATEINSTALL'])) {
                    $results[$key]['Historybien']['DATEINSTALL'] = $this->datetimeFormatAfterFind($val['Historybien']['DATEINSTALL']);
                }      
                if (isset($val['Historybien']['DATECHECKINSTALL'])) {
                    $results[$key]['Historybien']['DATECHECKINSTALL'] = $this->dateFormatAfterFind($val['Historybien']['DATECHECKINSTALL']);
                }                   
                if (isset($val['Historybien']['MODIFIEDBY'])) {
                    $results[$key]['Historybien']['MODIFYBY_NOM'] = $this->getValideur($val['Historybien']['MODIFIEDBY']);
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
            if (!empty($this->data['Historybien']['DATEINSTALL'])) {
                $this->data['Historybien']['DATEINSTALL'] = $this->datetimeFormatBeforeSave($this->data['Historybien']['DATEINSTALL']);
            }   
            if (!empty($this->data['Historybien']['DATECHECKINSTALL'])) {
                $this->data['Historybien']['DATECHECKINSTALL'] = $this->dateFormatBeforeSave($this->data['Historybien']['DATECHECKINSTALL']);
            }               
            parent::beforeSave();
            return true;
        }    
        
        public function getValideur($id){
            $value = false;
            if ($id != 0 && $id!=null):
            $sql = 'SELECT CONCAT(NOM," ",PRENOM) AS NOMLONG FROM utilisateurs WHERE id="'.$id.'"';
            $result = $this->query($sql);
            $value =  isset($result[0][0]['NOMLONG']) ? $result[0][0]['NOMLONG'] : '';
            endif;
            return $value;
        }        
}
