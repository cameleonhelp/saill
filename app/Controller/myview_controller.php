<?php
class MyviewsController extends AppController {

	var $name = 'Myview';

	// ...
	// Some code and methods
	// ... 
	function export_xls() {
		$this->Myview->recursive = 1;
		$data = $this->Myview->find('all');
		
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');

	}
	// ...
	// Some code and methods
	// ...
}
?>