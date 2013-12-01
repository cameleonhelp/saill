<?php
App::uses('Mw', 'Model');

/**
 * Mw Test Case
 *
 */
class MwTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mw',
		'app.envoutil',
		'app.envversion'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mw = ClassRegistry::init('Mw');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mw);

		parent::tearDown();
	}

}
