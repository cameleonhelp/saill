<?php
App::uses('Expbrefvolumetry', 'Model');

/**
 * Expbrefvolumetry Test Case
 *
 */
class ExpbrefvolumetryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expbrefvolumetry'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expbrefvolumetry = ClassRegistry::init('Expbrefvolumetry');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expbrefvolumetry);

		parent::tearDown();
	}

}
