<?php
/**
 * EnvversionFixture
 *
 */
class EnvversionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'envoutil_id' => array('type' => 'datetime', 'null' => false, 'default' => null, 'key' => 'index'),
		'VERSION' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_versions_outils1_idx' => array('column' => 'envoutil_id', 'unique' => 0)
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
			'envoutil_id' => '2013-09-06 09:03:07',
			'VERSION' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-09-06 09:03:07',
			'modified' => '2013-09-06 09:03:07'
		),
	);

}
