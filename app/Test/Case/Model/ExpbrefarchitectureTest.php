<?php
App::uses('Expbrefarchitecture', 'Model');

/**
 * Expbrefarchitecture Test Case
 *
 */
class ExpbrefarchitectureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expbrefarchitecture'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expbrefarchitecture = ClassRegistry::init('Expbrefarchitecture');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expbrefarchitecture);

		parent::tearDown();
	}

}
