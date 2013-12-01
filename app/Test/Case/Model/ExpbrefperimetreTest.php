<?php
App::uses('Expbrefperimetre', 'Model');

/**
 * Expbrefperimetre Test Case
 *
 */
class ExpbrefperimetreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expbrefperimetre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expbrefperimetre = ClassRegistry::init('Expbrefperimetre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expbrefperimetre);

		parent::tearDown();
	}

}
