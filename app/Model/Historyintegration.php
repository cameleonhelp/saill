<?php
App::uses('AppModel', 'Model');
/**
 * Historyintegration Model
 *
 * @property Intergrationapplicative $Intergrationapplicative
 */
class Historyintegration extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'intergrationapplicative_id' => array(
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
		'Intergrationapplicative' => array(
			'className' => 'Intergrationapplicative',
			'foreignKey' => 'intergrationapplicative_id',
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
        public function afterFind($results, $primary = false) {
            foreach ($results as $key => $val) {
                if (isset($val['Historyintegration']['created'])) {
                    $results[$key]['Historyintegration']['created'] = $this->datetimeFormatAfterFind($val['Historyintegration']['created']);
                }      
                if (isset($val['Historyintegration']['modified'])) {
                    $results[$key]['Historyintegration']['modified'] = $this->datetimeFormatAfterFind($val['Historyintegration']['modified']);
                }  
                if (isset($val['Historyintegration']['DATEINSTALL'])) {
                    $results[$key]['Historyintegration']['DATEINSTALL'] = $this->datetimeFormatAfterFind($val['Historyintegration']['DATEINSTALL']);
                }      
                if (isset($val['Historyintegration']['DATECHECK'])) {
                    $results[$key]['Historyintegration']['DATECHECK'] = $this->dateFormatAfterFind($val['Historyintegration']['DATECHECK']);
                }                   
                if (isset($val['Historyintegration']['MODIFIEDBY'])) {
                    $results[$key]['Historyintegration']['MODIFYBY_NOM'] = $this->getValideur($val['Historyintegration']['MODIFIEDBY']);
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
            if (!empty($this->data['Historyintegration']['DATEINSTALL'])) {
                $this->data['Historyintegration']['DATEINSTALL'] = $this->datetimeFormatBeforeSave($this->data['Historyintegration']['DATEINSTALL']);
            }   
            if (!empty($this->data['Historyintegration']['DATECHECK'])) {
                $this->data['Historyintegration']['DATECHECK'] = $this->dateFormatBeforeSave($this->data['Historyintegration']['DATECHECK']);
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
