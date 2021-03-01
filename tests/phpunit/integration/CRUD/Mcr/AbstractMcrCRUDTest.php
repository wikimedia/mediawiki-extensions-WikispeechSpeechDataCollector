<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Mcr;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use MediaWiki\MediaWikiServices;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDContext;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr\AbstractMcrCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\AbstractCRUDTest;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Mcr
 * @since 0.1.0
 */
abstract class AbstractMcrCRUDTest extends AbstractCRUDTest {

	/** @var CRUDContext */
	private $context;

	protected function getCRUDContext(): CRUDContext {
		return $this->context;
	}

	/**
	 * @param CRUDContext $context
	 * @return AbstractMcrCRUD
	 */
	abstract protected function newCRUDInstance( CRUDContext $context ): AbstractCRUD;

	protected function setUp(): void {
		parent::setUp();
		$this->context = new CRUDContext(
			null,
			self::getTestUser()->getUser(),
			MediaWikiServices::getInstance()->getRevisionStore()
		);
	}
}
