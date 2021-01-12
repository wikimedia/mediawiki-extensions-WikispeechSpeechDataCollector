<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Rdbms;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\AbstractRdbmsCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingCRUD;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD\Rdbms
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingCRUD
 */
class RecordingCRUDTest extends AbstractRdbmsCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractRdbmsCRUD {
		return new RecordingCRUD( $dbLoadBalancer );
	}
}
