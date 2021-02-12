<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain;

use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentVisitorAdapter;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotations;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain
 * @covers \MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotations
 * @since 0.1.0
 */
class RecordingAnnotationsTest extends AbstractPersistentTest {

	protected function instanceFactory(): Persistent {
		return new RecordingAnnotations();
	}

	protected function visitorTestFactory(): PersistentVisitorAdapter {
		return new class extends PersistentVisitorAdapter {
			public function visitRecordingAnnotations(
				RecordingAnnotations $recordingAnnotations
			) {
				return null;
			}
		};
	}

}
