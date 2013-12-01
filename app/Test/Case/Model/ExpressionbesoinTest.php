<?php
App::uses('Expressionbesoin', 'Model');

/**
 * Expressionbesoin Test Case
 *
 */
class ExpressionbesoinTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expressionbesoin',
		'app.application',
		'app.composant',
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
		$this->Expressionbesoin = ClassRegistry::init('Expressionbesoin');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expressionbesoin);

		parent::tearDown();
	}

}
