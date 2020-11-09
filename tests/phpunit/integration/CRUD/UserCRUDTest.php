<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\UserCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\User;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class UserCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\UserCRUD
 */
class UserCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new UserCRUD( $dbLoadBalancer );
	}

	/**
	 * @param User $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setYearBorn( 1911 );
		$instance->setMediaWikiUser( 123 );
	}

	/**
	 * @param User &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setYearBorn( 1914 );
		$instance->setMediaWikiUser( 234 );
	}
}
