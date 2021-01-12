<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Rdbms;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptDomainCRUD;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class ManuscriptDomainCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptDomainCRUD
 */
class ManuscriptDomainCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new ManuscriptDomainCRUD( $dbLoadBalancer );
	}
}
