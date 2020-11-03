<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\UserDialectCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\LanguageProficiencyLevel;
use MediaWiki\WikispeechSpeechDataCollector\Domain\UserDialect;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
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
		$instance->setUser( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setLanguage( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setSpokenProficiencyLevel( LanguageProficiencyLevel::NATIVE );
		$instance->setLocation( 'Location' );
	}

	/**
	 * @param UserDialect &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setUser( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setLanguage( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setSpokenProficiencyLevel( LanguageProficiencyLevel::BASIC );
		$instance->setLocation( 'UpdatedLocation' );
	}
}
