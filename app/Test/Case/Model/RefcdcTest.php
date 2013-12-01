<?php
App::uses('Refcdc', 'Model');

/**
 * Refcdc Test Case
 *
 */
class RefcdcTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.refcdc'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Refcdc = ClassRegistry::init('Refcdc');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Refcdc);

		parent::tearDown();
	}

}
