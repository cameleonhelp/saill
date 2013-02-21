<?php
App::uses('Livrable', 'Model');

/**
 * Livrable Test Case
 *
 */
class LivrableTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.livrable'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Livrable = ClassRegistry::init('Livrable');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Livrable);

		parent::tearDown();
	}

}
