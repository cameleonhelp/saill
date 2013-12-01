<?php
App::uses('Bien', 'Model');

/**
 * Bien Test Case
 *
 */
class BienTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bien',
		'app.modele',
		'app.chassis',
		'app.type',
		'app.usage',
		'app.lot',
		'app.logiciel'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Bien = ClassRegistry::init('Bien');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bien);

		parent::tearDown();
	}

}
