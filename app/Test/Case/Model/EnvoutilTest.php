<?php
App::uses('Envoutil', 'Model');

/**
 * Envoutil Test Case
 *
 */
class EnvoutilTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.envoutil',
		'app.envversion',
		'app.mw'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Envoutil = ClassRegistry::init('Envoutil');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Envoutil);

		parent::tearDown();
	}

}
