<?php
App::uses('Expbrefpuissance', 'Model');

/**
 * Expbrefpuissance Test Case
 *
 */
class ExpbrefpuissanceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expbrefpuissance'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expbrefpuissance = ClassRegistry::init('Expbrefpuissance');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expbrefpuissance);

		parent::tearDown();
	}

}
