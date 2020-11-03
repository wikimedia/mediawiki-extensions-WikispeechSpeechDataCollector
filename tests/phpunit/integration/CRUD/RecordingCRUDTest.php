<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Recording;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
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
		$instance->setManuscriptPrompt( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setSpokenDialect( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setVoiceOf( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setRecorded( MWTimestamp::getInstance( 20200713145000 ) );
	}

	/**
	 * @param Recording &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setManuscriptPrompt( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setSpokenDialect( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setVoiceOf( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setRecorded( MWTimestamp::getInstance( 20200714145000 ) );
	}
}
