<?php
App::uses('Nfse', 'Model');

/**
 * Nfse Test Case
 *
 */
class NfseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nfse'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Nfse = ClassRegistry::init('Nfse');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nfse);

		parent::tearDown();
	}

}
