<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Rdbms;

use MediaWiki\MediaWikiServices;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDContext;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\AbstractCRUDTest;
use Wikimedia\TestingAccessWrapper;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD\Rdbms
 *
 * @todo Add helpers for testing listing and getting object by indices.
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\CLUD
 */
abstract class AbstractRdbmsCRUDTest extends AbstractCRUDTest {

	/** @var CRUDContext */
	private $context;

	protected function getCRUDContext(): CRUDContext {
		return $this->context;
	}

	protected function setUp(): void {
		parent::setUp();
		$this->context = new CRUDContext(
			MediaWikiServices::getInstance()->getDBLoadBalancer()
		);
		$crudWrapper = TestingAccessWrapper::newFromObject( $this->newCRUDInstance( $this->context ) );
		$this->tablesUsed[] = $crudWrapper->getTable();
	}

}
