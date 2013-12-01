<?php
App::uses('Cdc', 'Model');

/**
 * Cdc Test Case
 *
 */
class CdcTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cdc'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cdc = ClassRegistry::init('Cdc');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cdc);

		parent::tearDown();
	}

}
