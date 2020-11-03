<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\SkippedManuscriptPromptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\SkippedManuscriptPrompt;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use MWTimestamp;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class SkippedManuscriptPromptCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\SkippedManuscriptPromptCRUD
 */
class SkippedManuscriptPromptCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new SkippedManuscriptPromptCRUD( $dbLoadBalancer );
	}

	/**
	 * @param SkippedManuscriptPrompt $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setSkipped( MWTimestamp::getInstance( 20200713145000 ) );
		$instance->setUser( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setManuscriptPrompt( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
	}

	/**
	 * @param SkippedManuscriptPrompt &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setSkipped( MWTimestamp::getInstance( 20200714145000 ) );
		$instance->setUser( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setManuscriptPrompt( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
	}
}
