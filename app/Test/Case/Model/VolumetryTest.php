<?php
App::uses('Volumetry', 'Model');

/**
 * Volumetry Test Case
 *
 */
class VolumetryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.volumetry'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Volumetry = ClassRegistry::init('Volumetry');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Volumetry);

		parent::tearDown();
	}

}
