<?php
App::uses('Reflot', 'Model');

/**
 * Reflot Test Case
 *
 */
class ReflotTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reflot'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reflot = ClassRegistry::init('Reflot');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reflot);

		parent::tearDown();
	}

}
