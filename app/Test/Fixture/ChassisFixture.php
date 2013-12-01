<?php
/**
 * ChassisFixture
 *
 */
class ChassisFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'localite_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'NOM' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'NIVEAU' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ARMOIRE' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'PVU' => array('type' => 'integer', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_chassis_localites1_idx' => array('column' => 'localite_id', 'unique' => 0)
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
			'localite_id' => 1,
			'NOM' => 'Lorem ipsum dolor sit amet',
			'NIVEAU' => 'Lorem ipsum dolor sit amet',
			'ARMOIRE' => 'Lorem ipsum dolor sit amet',
			'PVU' => 1,
			'created' => '2013-09-06 09:00:16',
			'modified' => '2013-09-06 09:00:16'
		),
	);

}
