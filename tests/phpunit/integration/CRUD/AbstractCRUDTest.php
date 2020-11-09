<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\Logger\LoggerFactory;
use MediaWiki\MediaWikiServices;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CLUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Domain\PersistentEqualsConstraintFactory;
use MediaWikiIntegrationTestCase;
use Psr\Log\LoggerInterface;
use Wikimedia\Rdbms\ILoadBalancer;
use Wikimedia\TestingAccessWrapper;

/**
 * Class AbstractCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @todo Add helpers for testing listing and getting object by indices.
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\CLUD
 */
abstract class AbstractCRUDTest extends MediaWikiIntegrationTestCase {

	/** @var AbstractCRUD */
	private $crud;

	/** @var TestingAccessWrapper|AbstractCRUD */
	private $crudWrapper;

	/** @var LoggerInterface */
	private $logger;

	/** @var ILoadBalancer */
	private $dbLoadBalancer;

	/** @var CLUD */
	private $clud;

	protected function setUp(): void {
		parent::setUp();
		$this->logger = LoggerFactory::getInstance( __CLASS__ );
		$this->dbLoadBalancer = MediaWikiServices::getInstance()->getDBLoadBalancer();
		$this->crud = $this->crudFactory( $this->dbLoadBalancer );
		$this->crudWrapper = TestingAccessWrapper::newFromObject( $this->crud );
		$this->tablesUsed[] = $this->crudWrapper->getTable();
		$this->clud = new CLUD( $this->dbLoadBalancer );
	}

	/**
	 * Basic create-read-update-delete tests using CRUD.
	 * Ensures that serialization and deserialization match.
	 */
	public function testCRUD() {
		$instance = $this->crud->instanceFactory();
		$this->setInstance( $instance );

		$this->assertNull( $instance->getIdentity() );
		$this->crud->create( $instance );
		$this->assertNotNull( $instance->getIdentity() );

		$readInstance = $this->crud->read( $instance->getIdentity() );
		$this->logger->debug( 'Instance @ CRUD read#1 is ' . $readInstance );
		$this->assertSame( $instance->getIdentity(), $readInstance->getIdentity() );
		$this->assertThat( $instance,
			$readInstance->accept( new PersistentEqualsConstraintFactory() ) );

		$this->modifyInstance( $readInstance );
		$this->crud->update( $readInstance );

		$updatedInstance = $this->crud->read( $instance->getIdentity() );
		$this->logger->debug( 'Instance @ CRUD read#2 is ' . $updatedInstance );
		$this->assertSame( $instance->getIdentity(), $updatedInstance->getIdentity() );
		$this->assertThat( $readInstance,
			$updatedInstance->accept( new PersistentEqualsConstraintFactory() ) );

		$this->crud->delete( $instance->getIdentity() );
		$deletedInstance = $this->crud->read( $instance->getIdentity() );
		$this->logger->debug( 'Instance @ CRUD read#3 is ' . $deletedInstance );
		$this->assertNull( $deletedInstance );
	}

	/**
	 * Basic create-load-update-delete tests using CLUD.
	 * Ensures that serialization and deserialization match.
	 */
	public function testCLUD() {
		$instance = $this->crud->instanceFactory();
		$this->setInstance( $instance );

		$this->assertNull( $instance->getIdentity() );
		$this->clud->create( $instance );
		$this->assertNotNull( $instance->getIdentity() );

		$readInstance = $this->crud->instanceFactory();
		$readInstance->setIdentity( $instance->getIdentity() );
		$this->assertTrue( $this->clud->load( $readInstance ) );
		$this->logger->debug( 'Instance @ CLUD read#1 is ' . $readInstance );
		$this->assertSame( $instance->getIdentity(), $readInstance->getIdentity() );
		$this->assertThat( $instance,
			$readInstance->accept( new PersistentEqualsConstraintFactory() ) );

		$this->modifyInstance( $readInstance );
		$this->clud->update( $readInstance );

		$updatedInstance = $this->crud->instanceFactory();
		$updatedInstance->setIdentity( $instance->getIdentity() );
		$this->assertTrue( $this->clud->load( $updatedInstance ) );
		$this->logger->debug( 'Instance @ CLUD read#2 is ' . $updatedInstance );
		$this->assertSame( $instance->getIdentity(), $updatedInstance->getIdentity() );
		$this->assertThat( $readInstance,
			$updatedInstance->accept( new PersistentEqualsConstraintFactory() ) );

		$deletedInstance = $this->crud->instanceFactory();
		$deletedInstance->setIdentity( $instance->getIdentity() );
		$this->clud->delete( $deletedInstance );
		$this->assertFalse( $this->clud->load( $deletedInstance ) );
	}

	/**
	 * @param ILoadBalancer $dbLoadBalancer
	 * @return AbstractCRUD
	 */
	abstract protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD;

	/**
	 * Set valid values to all instance fields except the identity.
	 * Nullable values should at this point be set non null.
	 *
	 * @param Persistent $instance
	 * @return void
	 */
	abstract protected function setInstance(
		&$instance
	): void;

	/**
	 * Make valid changes to all instance fields except the identity.
	 * Nullable values should at this point be set to null.
	 *
	 * @param Persistent &$instance
	 */
	abstract protected function modifyInstance(
		&$instance
	): void;

}
