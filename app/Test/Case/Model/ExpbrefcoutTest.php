<?php
App::uses('Expbrefcout', 'Model');

/**
 * Expbrefcout Test Case
 *
 */
class ExpbrefcoutTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expbrefcout'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expbrefcout = ClassRegistry::init('Expbrefcout');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expbrefcout);

		parent::tearDown();
	}

}
