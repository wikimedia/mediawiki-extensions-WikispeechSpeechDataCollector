<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\SkippedManuscriptPromptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\SkippedManuscriptPrompt;
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
		$instance->setUser( 'User' );
		$instance->setManuscriptPrompt( 'ManuscriptPrompt' );
	}

	/**
	 * @param SkippedManuscriptPrompt &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setSkipped( MWTimestamp::getInstance( 20200714145000 ) );
		$instance->setUser( 'UpdatedUser' );
		$instance->setManuscriptPrompt( 'UpdatedManuscriptPrompt' );
	}
}
