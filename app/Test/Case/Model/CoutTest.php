<?php
App::uses('Cout', 'Model');

/**
 * Cout Test Case
 *
 */
class CoutTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cout'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cout = ClassRegistry::init('Cout');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cout);

		parent::tearDown();
	}

}
