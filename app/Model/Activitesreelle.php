<?php
App::uses('AppModel', 'Model');
/**
 * Activitesreelle Model
 *
 * @property Utilisateur $Utilisateur
 * @property Action $Action
 * @property Activite $Activite
 */
class Activitesreelle extends AppModel {

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
		'activite_id' => array(
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
		),
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'action_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
                        'type'=>'left'
		),
		'Activite' => array(
			'className' => 'Activite',
			'foreignKey' => 'activite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        /*public $virtualFields = array(
            'NBACTIVITE' => 'COUNT( Activitesreelle.DATE )'
        );*/

 /**
 * beforeSave method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
        public function beforeSave() {
            if (!empty($this->data['Activitesreelle']['DATE'])) {
                $this->data['Activitesreelle']['DATE'] = $this->dateFormatBeforeSave($this->debutsem($this->data['Activitesreelle']['DATE']));
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
                if (isset($val['Activitesreelle']['created'])) {
                    $results[$key]['Activitesreelle']['created'] = $this->dateFormatAfterFind($val['Activitesreelle']['created']);
                }      
                if (isset($val['Activitesreelle']['modified'])) {
                    $results[$key]['Activitesreelle']['modified'] = $this->dateFormatAfterFind($val['Activitesreelle']['modified']);
                }                   
                if (isset($val['Activitesreelle']['DATE'])) {
                    $results[$key]['Activitesreelle']['DATE'] = $this->dateFormatAfterFind($val['Activitesreelle']['DATE']);
                }                    
            }
            return $results;
        }  
        
/**
 * debutsem method
 * 
 * @param type $date
 * @return date de début de semaine au format français
 */        
        public function debutsem($date) {
            $d = explode('/',$date);
            $year = $d[2];
            $month = $d[1];
            $day = $d[0];
            $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
            $premier_jour = mktime(0,0,0, $month,$day-(!$num_day?7:$num_day)+1,$year);
            $datedeb      = date('d/m/Y', $premier_jour);
            return $datedeb;
        }  
        
/**
 * CUSDate method
 * 
 * @param type $frdate
 * @return date au format US
 */
        public function CUSDate($frdate){
            $day = explode('/',$frdate);
            return $day[2]."-".$day[1]."-".$day[0];
        }
        
/**
 * CFRDate method
 * 
 * @param type $usdate
 * @return date au format US
 */
        public function CFRDate($usdate){
            $day = explode('-',$usdate);
            return $day[0]."/".$day[1]."/".$day[2];
        }        
}
