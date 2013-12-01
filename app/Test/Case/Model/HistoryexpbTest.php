<?php
App::uses('Historyexpb', 'Model');

/**
 * Historyexpb Test Case
 *
 */
class HistoryexpbTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historyexpb',
		'app.expressionbesoins',
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
		'app.architecture'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historyexpb = ClassRegistry::init('Historyexpb');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historyexpb);

		parent::tearDown();
	}

}
