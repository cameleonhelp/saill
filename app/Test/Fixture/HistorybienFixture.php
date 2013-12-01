<?php
/**
 * HistorybienFixture
 *
 */
class HistorybienFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'biens_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'INSTALL' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'DATECHECKINSTALL' => array('type' => 'date', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_historybiens_biens1_idx' => array('column' => 'biens_id', 'unique' => 0)
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
			'biens_id' => 1,
			'INSTALL' => 1,
			'DATECHECKINSTALL' => '2013-09-06',
			'created' => '2013-09-06 09:04:31',
			'modified' => '2013-09-06 09:04:31'
		),
	);

}
