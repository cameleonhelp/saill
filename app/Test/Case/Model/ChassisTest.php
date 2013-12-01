<?php
App::uses('Chassis', 'Model');

/**
 * Chassis Test Case
 *
 */
class ChassisTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.chassis',
		'app.localite',
		'app.bien',
		'app.modele',
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
		$this->Chassis = ClassRegistry::init('Chassis');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Chassis);

		parent::tearDown();
	}

}
