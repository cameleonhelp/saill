<?php
App::uses('Modele', 'Model');

/**
 * Modele Test Case
 *
 */
class ModeleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.modele',
		'app.bien',
		'app.chassis',
		'app.localite',
		'app.type',
		'app.usage',
		'app.lot',
		'app.expressionbesoin',
		'app.application',
		'app.intergrationapplicative',
		'app.version',
		'app.logiciel',
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
		'app.phase',
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
		$this->Modele = ClassRegistry::init('Modele');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Modele);

		parent::tearDown();
	}

}
