<?php
App::uses('Historylogiciel', 'Model');

/**
 * Historylogiciel Test Case
 *
 */
class HistorylogicielTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historylogiciel',
		'app.logiciel'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historylogiciel = ClassRegistry::init('Historylogiciel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historylogiciel);

		parent::tearDown();
	}

}
