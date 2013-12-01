<?php
/**
 * LogicielFixture
 *
 */
class LogicielFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'bien_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'outil_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'application_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'lot_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'ENVIRONNEMENT' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'INSTALL' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'DATECHECKINSTALL' => array('type' => 'date', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_logiciels_biens1_idx' => array('column' => 'bien_id', 'unique' => 0),
			'fk_logiciels_outils1_idx' => array('column' => 'outil_id', 'unique' => 0),
			'fk_logiciels_applications1_idx' => array('column' => 'application_id', 'unique' => 0),
			'fk_logiciels_types1_idx' => array('column' => 'type_id', 'unique' => 0),
			'fk_logiciels_lots1_idx' => array('column' => 'lot_id', 'unique' => 0)
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
			'bien_id' => 1,
			'outil_id' => 1,
			'application_id' => 1,
			'type_id' => 1,
			'lot_id' => 1,
			'ENVIRONNEMENT' => 'Lorem ipsum dolor sit amet',
			'INSTALL' => 1,
			'DATECHECKINSTALL' => '2013-09-06',
			'modified' => '2013-09-06 09:06:22',
			'created' => '2013-09-06 09:06:22'
		),
	);

}
