<?php
App::uses('Refmodele', 'Model');

/**
 * Refmodele Test Case
 *
 */
class RefmodeleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.refmodele'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Refmodele = ClassRegistry::init('Refmodele');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Refmodele);

		parent::tearDown();
	}

}
