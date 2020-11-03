<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\ManuscriptPromptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptPrompt;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class ManuscriptPromptCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\ManuscriptPromptCRUD
 */
class ManuscriptPromptCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new ManuscriptPromptCRUD( $dbLoadBalancer );
	}

	/**
	 * @param ManuscriptPrompt $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setManuscript( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setIndex( 1 );
		$instance->setContent( 'Content' );
	}

	/**
	 * @param ManuscriptPrompt &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setManuscript( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setIndex( 2 );
		$instance->setContent( 'Updated content' );
	}
}
