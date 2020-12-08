<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain;

use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentVisitorAdapter;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotationStereotype;

/**
 * Class RecordingAnnotationStereotypeTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain
 * @covers \MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotationStereotype
 * @since 0.1.0
 */
class RecordingAnnotationStereotypeTest extends AbstractPersistentTest {

	protected function instanceFactory(): Persistent {
		return new RecordingAnnotationStereotype();
	}

	protected function visitorTestFactory(): PersistentVisitorAdapter {
		return new class extends PersistentVisitorAdapter {
			public function visitRecordingAnnotationStereotype(
				RecordingAnnotationStereotype $recordingAnnotationStereotype
			): ?object {
				return null;
			}
		};
	}

}
