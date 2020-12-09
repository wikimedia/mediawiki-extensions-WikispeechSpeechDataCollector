<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Rdbms;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingAnnotationStereotypeCRUD;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class RecordingAnnotationStereotypeCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingAnnotationStereotypeCRUD
 */
class RecordingAnnotationStereotypeCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new RecordingAnnotationStereotypeCRUD( $dbLoadBalancer );
	}
}
