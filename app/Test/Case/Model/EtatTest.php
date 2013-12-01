<?php
App::uses('Etat', 'Model');

/**
 * Etat Test Case
 *
 */
class EtatTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.etat',
		'app.expressionbesoin',
		'app.application',
		'app.intergrationapplicative',
		'app.logiciel',
		'app.composant',
		'app.perimetre',
		'app.lot',
		'app.type',
		'app.phase',
		'app.volumetrie',
		'app.puissance',
		'app.architecture',
		'app.historyexpb'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Etat = ClassRegistry::init('Etat');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Etat);

		parent::tearDown();
	}

}
