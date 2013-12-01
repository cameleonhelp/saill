<?php
App::uses('Refcoutuo', 'Model');

/**
 * Refcoutuo Test Case
 *
 */
class RefcoutuoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.refcoutuo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Refcoutuo = ClassRegistry::init('Refcoutuo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Refcoutuo);

		parent::tearDown();
	}

}
