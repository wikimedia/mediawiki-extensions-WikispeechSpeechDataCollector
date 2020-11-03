<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\UserDialectCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\LanguageProficiencyLevel;
use MediaWiki\WikispeechSpeechDataCollector\Domain\UserDialect;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class UserDialectCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\UserDialectCRUD
 */
class UserDialectCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new UserDialectCRUD( $dbLoadBalancer );
	}

	/**
	 * @param UserDialect $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setUser( 'User' );
		$instance->setLanguage( 'Language' );
		$instance->setSpokenProficiencyLevel( LanguageProficiencyLevel::NATIVE );
		$instance->setLocation( 'Location' );
	}

	/**
	 * @param UserDialect &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setUser( 'UpdatedUser' );
		$instance->setLanguage( 'UpdatedLanguage' );
		$instance->setSpokenProficiencyLevel( LanguageProficiencyLevel::BASIC );
		$instance->setLocation( 'UpdatedLocation' );
	}
}
