<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Hooks;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use DatabaseUpdater;
use MediaWiki\Installer\Hook\LoadExtensionSchemaUpdatesHook;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\LanguageCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptDomainCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptPromptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingAnnotationCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingAnnotationStereotypeCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingReviewCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\SkippedManuscriptPromptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\UserCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\UserDialectCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\UserLanguageProficiencyLevelCRUD;

/**
 * Class WikispeechSpeechDataCollectorHooks
 *
 * @since 0.1.0
 */
class DatabaseHooks
	implements LoadExtensionSchemaUpdatesHook
{
	/**
	 * Creates database tables.
	 *
	 * @since 0.1.0
	 * @param DatabaseUpdater $updater
	 */
	public function onLoadExtensionSchemaUpdates( $updater ) {
		$this->addCRUDExtensionTable( $updater, LanguageCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, ManuscriptCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, ManuscriptDomainCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, ManuscriptPromptCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, RecordingAnnotationCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, RecordingAnnotationStereotypeCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, RecordingCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, RecordingReviewCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, SkippedManuscriptPromptCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, UserCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, UserDialectCRUD::TABLE );
		$this->addCRUDExtensionTable( $updater, UserLanguageProficiencyLevelCRUD::TABLE );
	}

	/**
	 * Creates a database table for the CRUD pattern.
	 *
	 * @since 0.1.0
	 * @param DatabaseUpdater $updater
	 * @param string $tableName
	 */
	private function addCRUDExtensionTable(
		DatabaseUpdater $updater,
		string $tableName
	) {
		$updater->addExtensionTable(
			$tableName,
			__DIR__ . '/../../sql/' . $tableName . '.sql'
		);
	}

}
