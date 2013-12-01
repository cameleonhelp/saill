<?php
App::uses('Logiciel', 'Model');

/**
 * Logiciel Test Case
 *
 */
class LogicielTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.logiciel',
		'app.bien',
		'app.modele',
		'app.chassis',
		'app.localite',
		'app.type',
		'app.usage',
		'app.lot',
		'app.outil',
		'app.utilisateur',
		'app.profil',
		'app.autorisation',
		'app.societe',
		'app.assistance',
		'app.materielinformatique',
		'app.typemateriel',
		'app.section',
		'app.dotation',
		'app.domaine',
		'app.action',
		'app.activite',
		'app.projet',
		'app.contrat',
		'app.tjmcontrat',
		'app.achat',
		'app.activitesreelle',
		'app.facturation',
		'app.affectation',
		'app.detailplancharge',
		'app.plancharge',
		'app.historybudget',
		'app.periodicite',
		'app.actionslivrable',
		'app.livrable',
		'app.suivilivrable',
		'app.historyaction',
		'app.site',
		'app.tjmagent',
		'app.dossierpartage',
		'app.utiliseoutil',
		'app.listediffusion',
		'app.historyutilisateur',
		'app.linkshared',
		'app.equipe',
		'app.application',
		'app.expressionbesoin',
		'app.composant',
		'app.perimetre',
		'app.etat',
		'app.historyexpb',
		'app.expressionbesoins',
		'app.phase',
		'app.volumetrie',
		'app.puissance',
		'app.architecture',
		'app.intergrationapplicative',
		'app.version',
		'app.historylogiciel'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Logiciel = ClassRegistry::init('Logiciel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Logiciel);

		parent::tearDown();
	}

}
