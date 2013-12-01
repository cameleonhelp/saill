<?php
App::uses('Architecture', 'Model');

/**
 * Architecture Test Case
 *
 */
class ArchitectureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.architecture',
		'app.expressionbesoin',
		'app.application',
		'app.intergrationapplicative',
		'app.logiciel',
		'app.composant',
		'app.perimetre',
		'app.lot',
		'app.etat',
		'app.type',
		'app.phase',
		'app.volumetrie',
		'app.puissance'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Architecture = ClassRegistry::init('Architecture');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Architecture);

		parent::tearDown();
	}

}
