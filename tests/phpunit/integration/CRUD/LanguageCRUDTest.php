<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\LanguageCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Language;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Class LanguageCRUDTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\CRUD
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\LanguageCRUD
 */
class LanguageCRUDTest extends AbstractCRUDTest {
	protected function crudFactory(
		ILoadBalancer $dbLoadBalancer
	): AbstractCRUD {
		return new LanguageCRUD( $dbLoadBalancer );
	}

	/**
	 * @param Language $instance
	 * @return void
	 */
	protected function setInstance(
		&$instance
	): void {
		$instance->setNativeName( 'Svenska' );
		$instance->setIso639a1( 'sv' );
		$instance->setIso639a2b( 's2b' );
		$instance->setIso639a2t( 's2t' );
		$instance->setIso639a3( 's3' );
	}

	/**
	 * @param Language &$instance
	 */
	protected function modifyInstance(
		&$instance
	): void {
		$instance->setNativeName( 'English' );
		$instance->setIso639a1( 'en' );
		$instance->setIso639a2b( 'e2b' );
		$instance->setIso639a2t( 'e2t' );
		$instance->setIso639a3( 'e3' );
	}

	/**
	 * @param Language $expected
	 * @param Language $actual
	 */
	protected function assertPersistentEquals(
		$expected,
		$actual
	): void {
		$this->assertSame( $expected->getNativeName(), $actual->getNativeName() );
		$this->assertSame( $expected->getIso639a1(), $actual->getIso639a1() );
		$this->assertSame( $expected->getIso639a2b(), $actual->getIso639a2b() );
		$this->assertSame( $expected->getIso639a2t(), $actual->getIso639a2t() );
		$this->assertSame( $expected->getIso639a3(), $actual->getIso639a3() );
	}
}
