<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\ManuscriptDomainCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptDomain;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class ManuscriptDomainCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\ManuscriptDomainCRUD
 */
class ManuscriptDomainCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new ManuscriptDomainCRUD( $dbLoadBalancer );
	}

	/**
	 * @param ManuscriptDomain $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setName( 'Name' );
		$instance->setParent( UUID::asBytes( '5f48b564-f127-4b09-a7cc-a784bed2aa52' ) );
	}

	/**
	 * @param ManuscriptDomain &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setName( 'Updated name' );
		$instance->setParent( UUID::asBytes( '20354d7a-e4fe-47af-8ff6-187bca92f3f9' ) );
	}
}
