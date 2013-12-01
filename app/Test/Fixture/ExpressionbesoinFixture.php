<?php
/**
 * ExpressionbesoinFixture
 *
 */
class ExpressionbesoinFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'application_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'composant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'perimetre_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'lot_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'etat_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'type_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 15, 'key' => 'index'),
		'phase_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 15, 'key' => 'index'),
		'volumetrie_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 15, 'key' => 'index'),
		'puissance_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 15, 'key' => 'index'),
		'architecture_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 15, 'key' => 'index'),
		'COMMENTAIRE' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'USAGE' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'NOMUSAGE' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'DATELIVRAISON' => array('type' => 'date', 'null' => true, 'default' => null),
		'DATEFIN' => array('type' => 'date', 'null' => true, 'default' => null),
		'PVU' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 5),
		'COUTWPS' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'COUTWTX' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_expressionbesoin_expbrefapplication1_idx' => array('column' => 'application_id', 'unique' => 0),
			'fk_expressionbesoin_expbrefcomposant1_idx' => array('column' => 'composant_id', 'unique' => 0),
			'fk_expressionbesoin_expbrefperimetre1_idx' => array('column' => 'perimetre_id', 'unique' => 0),
			'fk_expressionbesoin_expbreftype1_idx' => array('column' => 'type_id', 'unique' => 0),
			'fk_expressionbesoin_expbrefphase1_idx' => array('column' => 'phase_id', 'unique' => 0),
			'fk_expressionbesoin_expbreflot1_idx' => array('column' => 'lot_id', 'unique' => 0),
			'fk_expressionbesoin_expbrefetat1_idx' => array('column' => 'etat_id', 'unique' => 0),
			'fk_expressionbesoin_expbrefvolumetrie1_idx' => array('column' => 'volumetrie_id', 'unique' => 0),
			'fk_expressionbesoin_expbrefpuissance1_idx' => array('column' => 'puissance_id', 'unique' => 0),
			'fk_expressionbesoin_expbrefarchitecture1_idx' => array('column' => 'architecture_id', 'unique' => 0)
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
			'composant_id' => 1,
			'perimetre_id' => 1,
			'lot_id' => 1,
			'etat_id' => 1,
			'type_id' => 1,
			'phase_id' => 1,
			'volumetrie_id' => 1,
			'puissance_id' => 1,
			'architecture_id' => 1,
			'COMMENTAIRE' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'USAGE' => 'Lorem ipsum dolor sit amet',
			'NOMUSAGE' => 'Lorem ipsum dolor sit amet',
			'DATELIVRAISON' => '2013-09-06',
			'DATEFIN' => '2013-09-06',
			'PVU' => 1,
			'COUTWPS' => 'Lorem ipsum dolor sit amet',
			'COUTWTX' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-09-06 08:11:16',
			'modified' => '2013-09-06 08:11:16'
		),
	);

}
