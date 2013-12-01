<?php
/**
 * RefmwFixture
 *
 */
class RefmwFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'outils_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'PVU' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 5),
		'COUTUNITAIRE' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 2),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_refmws_refoutils1_idx' => array('column' => 'outils_id', 'unique' => 0)
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
			'outils_id' => 1,
			'PVU' => 1,
			'COUTUNITAIRE' => 1,
			'created' => '2013-09-06 08:15:06',
			'modified' => '2013-09-06 08:15:06'
		),
	);

}
