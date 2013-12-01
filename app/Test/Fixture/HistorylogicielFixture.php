<?php
/**
 * HistorylogicielFixture
 *
 */
class HistorylogicielFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'logiciel_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'INSTALL' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'DATECHECKINSTALL' => array('type' => 'date', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_historylogiciels_logiciels1_idx' => array('column' => 'logiciel_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'logiciel_id' => 1,
			'INSTALL' => 1,
			'DATECHECKINSTALL' => '2013-09-06',
			'created' => '2013-09-06 09:05:27',
			'modified' => '2013-09-06 09:05:27'
		),
	);

}
