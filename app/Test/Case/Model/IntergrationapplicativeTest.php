<?php
App::uses('Intergrationapplicative', 'Model');

/**
 * Intergrationapplicative Test Case
 *
 */
class IntergrationapplicativeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.intergrationapplicative',
		'app.application',
		'app.expressionbesoin',
		'app.composant',
		'app.perimetre',
		'app.lot',
		'app.etat',
		'app.historyexpb',
		'app.expressionbesoins',
		'app.type',
		'app.phase',
		'app.volumetrie',
		'app.puissance',
		'app.architecture',
		'app.logiciel',
		'app.version'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Intergrationapplicative = ClassRegistry::init('Intergrationapplicative');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Intergrationapplicative);

		parent::tearDown();
	}

}
