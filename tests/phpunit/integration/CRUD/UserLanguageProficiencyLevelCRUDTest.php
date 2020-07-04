<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\UserLanguageProficiencyLevelCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\LanguageProficiencyLevel;
use MediaWiki\WikispeechSpeechDataCollector\Domain\UserLanguageProficiencyLevel;
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
		$instance->setUser( 'User' );
		$instance->setLanguage( 'Language' );
		$instance->setProficiencyLevel( LanguageProficiencyLevel::ADVANCED );
	}

	/**
	 * @param UserLanguageProficiencyLevel &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setUser( 'UpdatedUser' );
		$instance->setLanguage( 'UpdatedLanguage' );
		$instance->setProficiencyLevel( LanguageProficiencyLevel::NEAR_NATIVE );
	}

	/**
	 * @param UserLanguageProficiencyLevel $expected
	 * @param UserLanguageProficiencyLevel $actual
	 */
	protected function assertPersistentEquals(
		$expected,
		$actual
	): void {
		$this->assertSame( $expected->getUser(), $actual->getUser() );
		$this->assertSame( $expected->getLanguage(), $actual->getLanguage() );
		$this->assertSame( $expected->getProficiencyLevel(), $actual->getProficiencyLevel() );
	}
}
