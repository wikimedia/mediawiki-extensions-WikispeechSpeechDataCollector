<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\UserLanguageProficiencyLevelCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\LanguageProficiencyLevel;
use MediaWiki\WikispeechSpeechDataCollector\Domain\UserLanguageProficiencyLevel;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class UserLanguageProficiencyLevelCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\UserLanguageProficiencyLevelCRUD
 */
class UserLanguageProficiencyLevelCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new UserLanguageProficiencyLevelCRUD( $dbLoadBalancer );
	}

	/**
	 * @param UserLanguageProficiencyLevel $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setUser( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setLanguage( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setProficiencyLevel( LanguageProficiencyLevel::ADVANCED );
	}

	/**
	 * @param UserLanguageProficiencyLevel &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setUser( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setLanguage( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setProficiencyLevel( LanguageProficiencyLevel::NEAR_NATIVE );
	}
}
