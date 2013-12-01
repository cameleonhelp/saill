<?php
App::uses('Wase', 'Model');

/**
 * Wase Test Case
 *
 */
class WaseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.wase'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Wase = ClassRegistry::init('Wase');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Wase);

		parent::tearDown();
	}

}
