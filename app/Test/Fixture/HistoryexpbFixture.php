<?php
/**
 * HistoryexpbFixture
 *
 */
class HistoryexpbFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'expressionbesoins_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'etat_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'DATEFIN' => array('type' => 'date', 'null' => true, 'default' => null),
		'DATELIVRAISON' => array('type' => 'date', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_historyexpbs_etats1_idx' => array('column' => 'etat_id', 'unique' => 0),
			'fk_historyexpbs_expressionbesoins1_idx' => array('column' => 'expressionbesoins_id', 'unique' => 0)
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
			'expressionbesoins_id' => 1,
			'etat_id' => 1,
			'DATEFIN' => '2013-09-06',
			'DATELIVRAISON' => '2013-09-06',
			'created' => '2013-09-06 09:04:56',
			'modified' => '2013-09-06 09:04:56'
		),
	);

}
