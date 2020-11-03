<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\ManuscriptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Manuscript;
use MWTimestamp;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class ManuscriptCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\ManuscriptCRUD
 */
class ManuscriptCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new ManuscriptCRUD( $dbLoadBalancer );
	}

	/**
	 * @param Manuscript $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setLanguage( 'Language' );
		$instance->setDomain( 'Domain' );
		$instance->setDisabled( null );
		$instance->setName( 'Manuscript name' );
		$instance->setCreated( MWTimestamp::getInstance( 20200711145000 ) );
	}

	/**
	 * @param Manuscript &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setLanguage( 'UpdatedLanguage' );
		$instance->setDomain( 'UpdatedDomain' );
		$instance->setDisabled( MWTimestamp::getInstance( 20200713145000 ) );
		$instance->setName( 'Updated manuscript name' );
		$instance->setCreated( MWTimestamp::getInstance( 20200712145000 ) );
	}
}
