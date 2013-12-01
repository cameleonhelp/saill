<?php
App::uses('Refapplication', 'Model');

/**
 * Refapplication Test Case
 *
 */
class RefapplicationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.refapplication'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Refapplication = ClassRegistry::init('Refapplication');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Refapplication);

		parent::tearDown();
	}

}
