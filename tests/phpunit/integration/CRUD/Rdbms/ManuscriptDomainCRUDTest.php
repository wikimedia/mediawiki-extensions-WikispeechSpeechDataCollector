<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Rdbms;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDContext;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptDomainCRUD;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD\Rdbms
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptDomainCRUD
 */
class ManuscriptDomainCRUDTest extends AbstractRdbmsCRUDTest {
	protected function newCRUDInstance(
		CRUDContext $context
	): AbstractCRUD {
		return new ManuscriptDomainCRUD( $context );
	}
}
