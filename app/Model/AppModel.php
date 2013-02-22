<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
 /**
 * dateFormatAfterFind method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $dateString
 * @return date au format français pour affichage
 */  
        public function dateFormatAfterFind($dateString) {
            return date('d/m/Y', strtotime($dateString));
        }
        
/**
 * dateFormatBeforeSave method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $dateString
 * @return date au format anglais pour enregistrer dans la base
 */           
        public function dateFormatBeforeSave($dateString) {
            $d = explode('/',$dateString);
            return date('Y-m-d', mktime(0, 0, 0, $d[1], $d[0], $d[2]));
            //return strftime("%Y-%m-%d", strtotime($dateString));
        } 
        
/**
 * htmlTextFormatBeforeSave method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $string
 * @return text au format html décomposé
 */  
        public function htmlTextFormatBeforeSave($string) {
            return  htmlentities($string, ENT_IGNORE, "UTF-8");
        }  
        
/**
 * htmlTextFormatAfterFind method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $string
 * @return text au format html décomposé
 */  
        public function htmlTextFormatAfterFind($string) {
            //return html_entity_decode($string, ENT_IGNORE, "UTF-8");
            return $string;
        } 
        
/**
 * fillSelectWhithBlankLine method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $model,$value
 * @return array
 */  
        public function fillSelectWhithBlankLine($array,$value) {
            $lignevide = array(""=>$value);
            return array_merge($lignevide,$array);
        }         
     
/**
 * findAllTables method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $model
 * @return array
 */  
        public function findAllTables($model) {
                $db = $model->getDataSource();
                $tables = $db->listSources();
                $result=array();
                foreach ($tables as $key=>$value)
                {
                    $result[$value] = $value;
                }            
            return $result;
        }      
}
