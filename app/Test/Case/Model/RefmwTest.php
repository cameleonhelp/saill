<?php
App::uses('Refmw', 'Model');

/**
 * Refmw Test Case
 *
 */
class RefmwTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.refmw',
		'app.outils'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Refmw = ClassRegistry::init('Refmw');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Refmw);

		parent::tearDown();
	}

}
