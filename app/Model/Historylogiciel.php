<?php
App::uses('AppModel', 'Model');
/**
 * Historylogiciel Model
 *
 * @property Logiciel $Logiciel
 */
class Historylogiciel extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'logiciel_id' => array(
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
		'Assobienlogiciel' => array(
			'className' => 'Assobienlogiciel',
			'foreignKey' => 'Assobienlogiciel_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
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
                if (isset($val['Historylogiciel']['created'])) {
                    $results[$key]['Historylogiciel']['created'] = $this->dateFormatAfterFind($val['Historylogiciel']['created']);
                }      
                if (isset($val['Historylogiciel']['modified'])) {
                    $results[$key]['Historylogiciel']['modified'] = $this->dateFormatAfterFind($val['Historylogiciel']['modified']);
                }    
                if (isset($val['Historylogiciel']['DATEINSTALL'])) {
                    $results[$key]['Historylogiciel']['DATEINSTALL'] = $this->datetimeFormatAfterFind($val['Historylogiciel']['DATEINSTALL']);
                }   
                if (isset($val['Historylogiciel']['MODIFIEDBY'])) {
                    $results[$key]['Historylogiciel']['MODIFYBY_NOM'] = $this->getValideur($val['Historylogiciel']['MODIFIEDBY']);
                }    
                if (isset($val['Assobienlogiciel']['bien_id'])) {
                    $results[$key]['Historylogiciel']['BIEN_NOM'] = $this->getBien($val['Assobienlogiciel']['bien_id']);
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
            if (!empty($this->data['Historylogiciel']['DATEINSTALL'])) {
                $this->data['Historylogiciel']['DATEINSTALL'] = $this->datetimeFormatBeforeSave($this->data['Historylogiciel']['DATEINSTALL']);
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
        
        public function getBien($id){
            $value = false;
            if ($id != 0 && $id!=null):
            $sql = 'SELECT NOM FROM biens WHERE id="'.$id.'"';
            $result = $this->query($sql);
            $value =  isset($result[0]['biens']['NOM']) ? $result[0]['biens']['NOM'] : '';
            endif;
            return $value;
        }          
}
