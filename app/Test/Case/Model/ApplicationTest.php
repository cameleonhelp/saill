<?php
App::uses('Application', 'Model');

/**
 * Application Test Case
 *
 */
class ApplicationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.application',
		'app.expressionbesoin',
		'app.composant',
		'app.perimetre',
		'app.lot',
		'app.etat',
		'app.type',
		'app.phase',
		'app.volumetrie',
		'app.puissance',
		'app.architecture',
		'app.intergrationapplicative',
		'app.logiciel'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Application = ClassRegistry::init('Application');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Application);

		parent::tearDown();
	}

}
