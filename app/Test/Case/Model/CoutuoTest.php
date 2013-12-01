<?php
App::uses('Coutuo', 'Model');

/**
 * Coutuo Test Case
 *
 */
class CoutuoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.coutuo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Coutuo = ClassRegistry::init('Coutuo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Coutuo);

		parent::tearDown();
	}

}
