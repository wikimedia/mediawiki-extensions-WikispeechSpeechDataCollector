<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Recording;
use MWTimestamp;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class RecordingCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingCRUD
 */
class RecordingCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new RecordingCRUD( $dbLoadBalancer );
	}

	/**
	 * @param Recording $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setManuscriptPrompt( 'ManuscriptPrompt' );
		$instance->setSpokenDialect( 'SpokenDialect' );
		$instance->setVoiceOf( 'VoiceOf' );
		$instance->setRecorded( MWTimestamp::getInstance( 20200713145000 ) );
	}

	/**
	 * @param Recording &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setManuscriptPrompt( 'UpdatedManuscriptPrompt' );
		$instance->setSpokenDialect( 'UpdatedSpokenDialect' );
		$instance->setVoiceOf( 'UpdatedVoiceOf' );
		$instance->setRecorded( MWTimestamp::getInstance( 20200714145000 ) );
	}

	/**
	 * @param Recording $expected
	 * @param Recording $actual
	 */
	protected function assertPersistentEquals(
		$expected,
		$actual
	): void {
		$this->assertSame( $expected->getManuscriptPrompt(), $actual->getManuscriptPrompt() );
		$this->assertSame( $expected->getSpokenDialect(), $actual->getSpokenDialect() );
		$this->assertSame( $expected->getVoiceOf(), $actual->getVoiceOf() );
		$this->assertEquals( $expected->getRecorded(), $actual->getRecorded() );
	}
}
