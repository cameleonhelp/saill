<?php
App::uses('Historybien', 'Model');

/**
 * Historybien Test Case
 *
 */
class HistorybienTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historybien',
		'app.biens'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historybien = ClassRegistry::init('Historybien');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historybien);

		parent::tearDown();
	}

}
