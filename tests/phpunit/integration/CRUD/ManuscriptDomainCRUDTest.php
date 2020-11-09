<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\ManuscriptDomainCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptDomain;
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
		$instance->setParent( 'Parent' );
	}

	/**
	 * @param ManuscriptDomain &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setName( 'Updated name' );
		$instance->setParent( 'UpdatedParent' );
	}
}
