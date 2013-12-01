<?php
App::uses('Expbrefcomposant', 'Model');

/**
 * Expbrefcomposant Test Case
 *
 */
class ExpbrefcomposantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expbrefcomposant'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expbrefcomposant = ClassRegistry::init('Expbrefcomposant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expbrefcomposant);

		parent::tearDown();
	}

}
