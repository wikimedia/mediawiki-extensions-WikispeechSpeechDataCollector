<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingAnnotationCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotation;
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
		$instance->setRecording( 'Recording' );
		$instance->setStart( 1 );
		$instance->setEnd( 2 );
		$instance->setStereotype( 'Stereotype' );
		$instance->setValue( 'Value' );
	}

	/**
	 * @param RecordingAnnotation &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setRecording( 'UpdatedRecording' );
		$instance->setStart( 3 );
		$instance->setEnd( 4 );
		$instance->setStereotype( 'UpdatedStereotype' );
		$instance->setValue( 'Updated value' );
	}
}
