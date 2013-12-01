<?php
App::uses('Composant', 'Model');

/**
 * Composant Test Case
 *
 */
class ComposantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.composant',
		'app.expressionbesoin',
		'app.application',
		'app.intergrationapplicative',
		'app.logiciel',
		'app.perimetre',
		'app.lot',
		'app.etat',
		'app.type',
		'app.phase',
		'app.volumetrie',
		'app.puissance',
		'app.architecture'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Composant = ClassRegistry::init('Composant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Composant);

		parent::tearDown();
	}

}
