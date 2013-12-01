<?php
App::uses('AppModel', 'Model');
/**
 * Demandeabsence Model
 *
 * @property Utilisateur $Utilisateur
 */
class Demandeabsence extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'utilisateur_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'utilisateur_id',
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
            if (!empty($this->data['Demandeabsence']['DATEDU'])) {
                $this->data['Demandeabsence']['DATEDU'] = $this->dateFormatBeforeSave($this->data['Demandeabsence']['DATEDU']);
            }
            if (!empty($this->data['Demandeabsence']['DATEAU'])) {
                $this->data['Demandeabsence']['DATEAU'] = $this->dateFormatBeforeSave($this->data['Demandeabsence']['DATEAU']);
            }  
            if (!empty($this->data['Demandeabsence']['DATEDEMANDE'])) {
                $this->data['Demandeabsence']['DATEDEMANDE'] = $this->datetimeFormatBeforeSave($this->data['Demandeabsence']['DATEDEMANDE']);
            }
            if (!empty($this->data['Demandeabsence']['DATEREPONSE'])) {
                $this->data['Demandeabsence']['DATEREPONSE'] = $this->datetimeFormatBeforeSave($this->data['Demandeabsence']['DATEREPONSE']);
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
                if (isset($val['Demandeabsence']['created'])) {
                    $results[$key]['Demandeabsence']['created'] = $this->datetimeFormatAfterFind($val['Demandeabsence']['created']);
                }      
                if (isset($val['Demandeabsence']['modified'])) {
                    $results[$key]['Demandeabsence']['modified'] = $this->datetimeFormatAfterFind($val['Demandeabsence']['modified']);
                }                   
                if (isset($val['Demandeabsence']['DATEDU'])) {
                    $results[$key]['Demandeabsence']['DATEDU'] = $this->dateFormatAfterFind($val['Demandeabsence']['DATEDU']);
                }   
                if (isset($val['Demandeabsence']['DATEAU'])) {
                    $results[$key]['Demandeabsence']['DATEAU'] = $this->dateFormatAfterFind($val['Demandeabsence']['DATEAU']);
                }  
                if (isset($val['Demandeabsence']['DATEDEMANDE'])) {
                    $results[$key]['Demandeabsence']['DATEDEMANDE'] = $this->datetimeFormatAfterFind($val['Demandeabsence']['DATEDEMANDE']);
                }      
                if (isset($val['Demandeabsence']['DATEREPONSE'])) {
                    $results[$key]['Demandeabsence']['DATEREPONSE'] = $this->datetimeFormatAfterFind($val['Demandeabsence']['DATEREPONSE']);
                }    
                if (isset($val['Demandeabsence']['REPONSEBY'])) {
                    $results[$key]['Demandeabsence']['REPONSEBY_NOM'] = $this->getValideur($val['Demandeabsence']['REPONSEBY']);
                } else {
                    $results[$key]['Demandeabsence']['REPONSEBY_NOM'] = '';
                }             
            }
            return $results;
        }   
        
        public function getValideur($id){
            $value = '';
            if ($id != 0):
                $sql = 'SELECT CONCAT(NOM," ",PRENOM) AS NOMLONG FROM utilisateurs WHERE id="'.$id.'"';
                $result = $this->query($sql);
                if(count($result)>0):
                    $value =  isset($result[0][0]['NOMLONG']) ? $result[0][0]['NOMLONG'] : '';
                else:
                    $value = '';
                endif;
            else :
                $value = '';
            endif;
            return $value;
        }        
}
