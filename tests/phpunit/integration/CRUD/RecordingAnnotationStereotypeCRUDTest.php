<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingAnnotationStereotypeCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotationStereotype;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class RecordingAnnotationStereotypeCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingAnnotationStereotypeCRUD
 */
class RecordingAnnotationStereotypeCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new RecordingAnnotationStereotypeCRUD( $dbLoadBalancer );
	}

	/**
	 * @param RecordingAnnotationStereotype $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setDescription( 'A string' );
		$instance->setValueClass( 'string' );
	}

	/**
	 * @param RecordingAnnotationStereotype &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setDescription( 'An integer' );
		$instance->setValueClass( 'int' );
	}

	/**
	 * @param RecordingAnnotationStereotype $expected
	 * @param RecordingAnnotationStereotype $actual
	 */
	protected function assertPersistentEquals(
		$expected,
		$actual
	): void {
		$this->assertSame( $expected->getDescription(), $actual->getDescription() );
		$this->assertSame( $expected->getValueClass(), $actual->getValueClass() );
	}
}
