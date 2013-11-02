<?php
class CommonComponent extends Object {

	var $components = array('Session');
	
	function initialize(&$controller, $settings = array()) 
	{        
		// saving the controller reference for later use        
		$this->controller =& $controller;    
	}
	
	function customize_error_msg($errors = array(), $main_msg = 'Une erreur empêche la poursuite normale de votre navigation') 
	{        
		$return_msg = "<ul>"; //<h4>" . $main_msg . "</h4>
		
		foreach($errors as $key => $value):
                    if($value!=''):
			$return_msg .= "<li>{$value}</li>";
                    endif;
		endforeach;
		
		$return_msg .= "</ul>";
		$this->Session->setFlash($return_msg, 'flash_failure');
	}
        
    function beforeRedirect(){
        
    }
    
    function beforeRender(){
        
    }
    
    function startup(){ 
       
    }
    
    function shutdown(){ 
       
    }
    
}
