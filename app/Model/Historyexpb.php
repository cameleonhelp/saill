<?php
App::uses('AppModel', 'Model');
/**
 * Historyexpb Model
 *
 * @property Expressionbesoins $Expressionbesoins
 * @property Etat $Etat
 */
class Historyexpb extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'expressionbesoins_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'etat_id' => array(
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
		'Expressionbesoins' => array(
			'className' => 'Expressionbesoins',
			'foreignKey' => 'expressionbesoins_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Etat' => array(
			'className' => 'Etat',
			'foreignKey' => 'etat_id',
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
                if (isset($val['Historyexpb']['created'])) {
                    $results[$key]['Historyexpb']['created'] = $this->dateFormatAfterFind($val['Historyexpb']['created']);
                }      
                if (isset($val['Historyexpb']['modified'])) {
                    $results[$key]['Historyexpb']['modified'] = $this->dateFormatAfterFind($val['Historyexpb']['modified']);
                }  
                if (isset($val['Historyexpb']['DATEFIN'])) {
                    $results[$key]['Historyexpb']['DATEFIN'] = $this->dateFormatAfterFind($val['Historyexpb']['DATEFIN']);
                }      
                if (isset($val['Historyexpb']['DATELIVRAISON'])) {
                    $results[$key]['Historyexpb']['DATELIVRAISON'] = $this->dateFormatAfterFind($val['Historyexpb']['DATELIVRAISON']);
                }    
                if (isset($val['Historyexpb']['MODIFIEDBY'])) {
                    $results[$key]['Historyexpb']['MODIFYBY_NOM'] = $this->getValideur($val['Historyexpb']['MODIFIEDBY']);
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
            if (!empty($this->data['Historyexpb']['DATELIVRAISON'])) {
                $this->data['Historyexpb']['DATELIVRAISON'] = $this->dateFormatBeforeSave($this->data['Historyexpb']['DATELIVRAISON']);
            }
            if (!empty($this->data['Historyexpb']['DATEFIN'])) {
                $this->data['Historyexpb']['DATEFIN'] = $this->dateFormatBeforeSave($this->data['Historyexpb']['DATEFIN']);
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
