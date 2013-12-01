<?php
App::uses('Expbrefphase', 'Model');

/**
 * Expbrefphase Test Case
 *
 */
class ExpbrefphaseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expbrefphase'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expbrefphase = ClassRegistry::init('Expbrefphase');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expbrefphase);

		parent::tearDown();
	}

}
