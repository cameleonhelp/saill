<?php
/**
 * BienFixture
 *
 */
class BienFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'modele_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'chassis_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index', 'comment' => 'Environnement'),
		'usage_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 15, 'key' => 'index'),
		'lot_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 15, 'key' => 'index'),
		'NOM' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'COEUR' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 2),
		'COEURSOFT' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 2),
		'RAM' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'COUT' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 2),
		'CHECK' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'CHECKBY' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 15),
		'INSTALL' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'DATECHECKINSTALL' => array('type' => 'date', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'NOM_UNIQUE' => array('column' => 'NOM', 'unique' => 1),
			'fk_biens_refmodeles1_idx' => array('column' => 'modele_id', 'unique' => 0),
			'fk_biens_refchassiss1_idx' => array('column' => 'chassis_id', 'unique' => 0),
			'fk_biens_refusages1_idx' => array('column' => 'usage_id', 'unique' => 0),
			'fk_biens_reflots1_idx' => array('column' => 'lot_id', 'unique' => 0),
			'fk_biens_reftypes1_idx' => array('column' => 'type_id', 'unique' => 0)
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
			'modele_id' => 1,
			'chassis_id' => 1,
			'type_id' => 1,
			'usage_id' => 1,
			'lot_id' => 1,
			'NOM' => 'Lorem ipsum dolor sit amet',
			'COEUR' => 1,
			'COEURSOFT' => 1,
			'RAM' => 1,
			'COUT' => 1,
			'CHECK' => 1,
			'CHECKBY' => 1,
			'INSTALL' => 1,
			'DATECHECKINSTALL' => '2013-09-06',
			'created' => '2013-09-06 07:39:20',
			'modified' => '2013-09-06 07:39:20'
		),
	);

}
