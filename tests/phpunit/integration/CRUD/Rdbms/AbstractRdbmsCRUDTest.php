<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Rdbms;

use MediaWiki\MediaWikiServices;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDContext;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\AbstractRdbmsCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\AbstractCRUDTest;
use Wikimedia\TestingAccessWrapper;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD\Rdbms
 *
 * @todo Add helpers for testing listing and getting object by indices.
 *
 * @since 0.1.0
 * @group Database
 */
abstract class AbstractRdbmsCRUDTest extends AbstractCRUDTest {

	/** @var CRUDContext */
	private $context;

	protected function getCRUDContext(): CRUDContext {
		return $this->context;
	}

	/**
	 * @param CRUDContext $context
	 * @return AbstractRdbmsCRUD
	 */
	abstract protected function newCRUDInstance( CRUDContext $context ): AbstractCRUD;

	protected function setUp(): void {
		parent::setUp();
		$this->context = new CRUDContext(
			MediaWikiServices::getInstance()->getDBLoadBalancer(),
			null,
			null
		);
		$crudWrapper = TestingAccessWrapper::newFromObject( $this->newCRUDInstance( $this->context ) );
		$this->tablesUsed[] = $crudWrapper->getTable();
	}

}
