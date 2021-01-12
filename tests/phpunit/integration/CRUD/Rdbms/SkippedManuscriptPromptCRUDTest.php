<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Rdbms;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\AbstractRdbmsCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\SkippedManuscriptPromptCRUD;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD\Rdbms
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\SkippedManuscriptPromptCRUD
 */
class SkippedManuscriptPromptCRUDTest extends AbstractRdbmsCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractRdbmsCRUD {
		return new SkippedManuscriptPromptCRUD( $dbLoadBalancer );
	}
}
