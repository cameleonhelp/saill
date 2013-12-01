<?php
App::uses('Reflocalite', 'Model');

/**
 * Reflocalite Test Case
 *
 */
class ReflocaliteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reflocalite'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reflocalite = ClassRegistry::init('Reflocalite');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reflocalite);

		parent::tearDown();
	}

}
