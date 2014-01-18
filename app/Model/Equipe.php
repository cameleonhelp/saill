<?php
App::uses('AppModel', 'Model');
/**
 * Equipe Model
 *
 * @property Utilisateur $Utilisateur
 */
class Equipe extends AppModel {

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
		),
		'agent' => array(
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
		'Utilisateur' => array(
			'className' => 'Utilisateur',
			'foreignKey' => 'utilisateur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

        public function getAgent($id){
            $sql = "SELECT * FROM utilisateurs WHERE id='".$id."'";
            $result = $this->query($sql);
            return  !empty($result) ? $result[0] : "";
        }          
        
        public function getValideur($id){
            $sql = "SELECT * FROM utilisateurs WHERE id='".$id."'";
            $result = $this->query($sql);
            return  !empty($result) ? $result[0] : "";
        }  
        
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
                if (isset($val['Equipe']['created'])) {
                    $results[$key]['Equipe']['created'] = $this->dateFormatAfterFind($val['Equipe']['created']);
                }      
                if (isset($val['Equipe']['modified'])) {
                    $results[$key]['Equipe']['modified'] = $this->dateFormatAfterFind($val['Equipe']['modified']);
                }                   
                if (isset($val['Equipe']['agent'])) {
                    $results[$key]['Agent'] = $this->getAgent($val['Equipe']['agent']);
                }              
                if (isset($val['Equipe']['utilisateur_id'])) {
                    $results[$key]['Valideur'] = $this->getValideur($val['Equipe']['utilisateur_id']);
                }                   
            }
            return $results;
        }          
}
