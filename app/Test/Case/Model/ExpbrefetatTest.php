<?php
App::uses('Expbrefetat', 'Model');

/**
 * Expbrefetat Test Case
 *
 */
class ExpbrefetatTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expbrefetat'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expbrefetat = ClassRegistry::init('Expbrefetat');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expbrefetat);

		parent::tearDown();
	}

}
