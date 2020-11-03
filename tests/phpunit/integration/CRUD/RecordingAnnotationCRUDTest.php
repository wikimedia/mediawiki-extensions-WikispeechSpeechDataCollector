<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingAnnotationCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotation;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class RecordingAnnotationCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingAnnotationCRUD
 */
class RecordingAnnotationCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new RecordingAnnotationCRUD( $dbLoadBalancer );
	}

	/**
	 * @param RecordingAnnotation $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setRecording( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setStart( 1 );
		$instance->setEnd( 2 );
		$instance->setStereotype( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
		$instance->setValue( 'Value' );
	}

	/**
	 * @param RecordingAnnotation &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setRecording( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setStart( 3 );
		$instance->setEnd( 4 );
		$instance->setStereotype( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
		$instance->setValue( 'Updated value' );
	}
}
