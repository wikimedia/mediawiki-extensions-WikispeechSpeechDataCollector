<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\ManuscriptPromptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptPrompt;
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
		$instance->setManuscript( 'Manuscript' );
		$instance->setIndex( 1 );
		$instance->setContent( 'Content' );
	}

	/**
	 * @param ManuscriptPrompt &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setManuscript( 'UpdatedManuscript' );
		$instance->setIndex( 2 );
		$instance->setContent( 'Updated content' );
	}

	/**
	 * @param ManuscriptPrompt $expected
	 * @param ManuscriptPrompt $actual
	 */
	protected function assertPersistentEquals(
		$expected,
		$actual
	): void {
		$this->assertSame( $expected->getManuscript(), $actual->getManuscript() );
		$this->assertSame( $expected->getIndex(), $actual->getIndex() );
		$this->assertSame( $expected->getContent(), $actual->getContent() );
	}
}
