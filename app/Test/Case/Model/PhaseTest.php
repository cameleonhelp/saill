<?php
App::uses('Phase', 'Model');

/**
 * Phase Test Case
 *
 */
class PhaseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.phase',
		'app.expressionbesoin',
		'app.application',
		'app.intergrationapplicative',
		'app.type',
		'app.version',
		'app.logiciel',
		'app.bien',
		'app.modele',
		'app.chassis',
		'app.localite',
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
		'app.historylogiciel',
		'app.composant',
		'app.perimetre',
		'app.etat',
		'app.historyexpb',
		'app.expressionbesoins',
		'app.volumetrie',
		'app.puissance',
		'app.architecture'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Phase = ClassRegistry::init('Phase');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Phase);

		parent::tearDown();
	}

}
