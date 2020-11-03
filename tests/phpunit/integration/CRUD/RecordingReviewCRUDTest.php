<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingReviewCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingReview;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingReviewValue;
use MWTimestamp;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class RecordingReviewCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\RecordingReviewCRUD
 */
class RecordingReviewCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new RecordingReviewCRUD( $dbLoadBalancer );
	}

	/**
	 * @param RecordingReview $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setCreated( MWTimestamp::getInstance( 20200713145000 ) );
		$instance->setReviewer( 'Reviewer' );
		$instance->setRecording( 'Recording' );
		$instance->setValue( RecordingReviewValue::THUMB_UP );
	}

	/**
	 * @param RecordingReview &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setCreated( MWTimestamp::getInstance( 20200714145000 ) );
		$instance->setReviewer( 'UpdatedReviewer' );
		$instance->setRecording( 'UpdatedRecording' );
		$instance->setValue( RecordingReviewValue::THUMB_DOWN );
	}
}
