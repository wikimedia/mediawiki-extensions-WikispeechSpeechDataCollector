<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain;

use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentVisitorAdapter;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotation;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain
 * @covers \MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotation
 * @since 0.1.0
 */
class RecordingAnnotationTest extends AbstractPersistentTest {

	protected function instanceFactory(): Persistent {
		return new RecordingAnnotation();
	}

	protected function visitorTestFactory(): PersistentVisitorAdapter {
		return new class extends PersistentVisitorAdapter {
			public function visitRecordingAnnotation(
				RecordingAnnotation $recordingAnnotation
			) {
				return null;
			}
		};
	}

}
