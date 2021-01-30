<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain;

use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentMWAssociateArrayDeserializer;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentMWAssociativeArraySerializer;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentVisitorAdapter;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Domain\PersistentCompleteOneBuilder;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Domain\PersistentCompleteTwoBuilder;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Domain\PersistentEqualsConstraintFactory;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Domain\PersistentSetNullableNull;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use MediaWikiUnitTestCase;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain
 * @covers \MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentVisitorAdapter
 * @covers \MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentMWAssociateArrayDeserializer
 * @covers \MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentMWAssociativeArraySerializer
 * @since 0.1.0
 */
abstract class AbstractPersistentTest extends MediaWikiUnitTestCase {

	/**
	 * @return Persistent A new instance of the underlying Persistent class this test covers.
	 */
	abstract protected function instanceFactory(): Persistent;

	/**
	 * @return PersistentVisitorAdapter A visitor that throws an exception
	 *  when trying to accept anything but and instance
	 *  of the underlying Persistent class this test covers.
	 */
	abstract protected function visitorTestFactory(): PersistentVisitorAdapter;

	/**
	 * Asserts that the visitor accept function invokes
	 * the correct function in the visitor implementation.
	 */
	public function testAcceptVisitor_acceptingCoveredInstanceOnly_noExceptionThrown() {
		$instance = $this->instanceFactory();
		$instance->accept( $this->visitorTestFactory() );
		// no exception should have been thrown
		$this->addToAssertionCount( 1 );
	}

	/**
	 * Creates an instance and fills it with test data,
	 * serialize and deserialize to a new instance.
	 * Compares that the contained values are equal.
	 *
	 * @dataProvider provideTestSerializationPersistentBuilders
	 * @param array $builders Instances of PersistentVisitor that will modify content of Persistent.
	 */
	public function testArraySerialization_serializedAndDeserializedInstanceEqualOriginalInstance(
		array $builders
	) {
		$instance = $this->instanceFactory();
		$instance->setIdentity( UUID::v4BytesFactory() );

		foreach ( $builders as $builder ) {
			$instance->accept( $builder );
		}

		$array = $instance->accept( new PersistentMWAssociativeArraySerializer() );

		$this->assertNotNull( $array );
		$this->assertNotFalse( $array );

		$deserialized = $this->instanceFactory();
		$deserialized = $deserialized->accept( new PersistentMWAssociateArrayDeserializer( $array ) );

		$this->assertNotNull( $deserialized );

		$this->assertThat( $deserialized, $instance->accept( new PersistentEqualsConstraintFactory() ) );
	}

	public function provideTestSerializationPersistentBuilders() {
		return [
			'completeOne' => [
				[ new PersistentCompleteOneBuilder() ]
			],
			'completeOneSetNull' => [
				[ new PersistentCompleteOneBuilder(), new PersistentSetNullableNull() ]
			],
			'completeTwo' => [
				[ new PersistentCompleteTwoBuilder() ]
			],
			'completeTwoSetNull' => [
				[ new PersistentCompleteTwoBuilder(), new PersistentSetNullableNull() ]
			],
		];
	}

}