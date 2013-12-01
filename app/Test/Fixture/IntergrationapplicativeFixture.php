<?php
/**
 * IntergrationapplicativeFixture
 *
 */
class IntergrationapplicativeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'application_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index', 'comment' => 'environnements'),
		'version_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'DATE' => array('type' => 'date', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_intergrationapplicatives_applications1_idx' => array('column' => 'application_id', 'unique' => 0),
			'fk_intergrationapplicatives_types1_idx' => array('column' => 'type_id', 'unique' => 0),
			'fk_intergrationapplicatives_intappversions1_idx' => array('column' => 'version_id', 'unique' => 0)
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
			'application_id' => 1,
			'type_id' => 1,
			'version_id' => 1,
			'DATE' => '2013-09-06',
			'modified' => '2013-09-06 09:05:47',
			'created' => '2013-09-06 09:05:47'
		),
	);

}
