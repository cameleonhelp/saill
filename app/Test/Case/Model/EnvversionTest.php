<?php
App::uses('Envversion', 'Model');

/**
 * Envversion Test Case
 *
 */
class EnvversionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.envversion',
		'app.envoutil',
		'app.mw'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Envversion = ClassRegistry::init('Envversion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Envversion);

		parent::tearDown();
	}

}
