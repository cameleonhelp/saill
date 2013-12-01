<?php
App::uses('Localite', 'Model');

/**
 * Localite Test Case
 *
 */
class LocaliteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.localite',
		'app.chassis',
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
		$this->Localite = ClassRegistry::init('Localite');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Localite);

		parent::tearDown();
	}

}
