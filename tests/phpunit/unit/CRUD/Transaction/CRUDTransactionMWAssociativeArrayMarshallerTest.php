<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\CRUD\Transaction;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use MediaWiki\WikispeechSpeechDataCollector\CRUD\Transaction\CRUDTransactionMWAssociativeArrayMarshaller;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Transaction\CRUDTransactionResponse;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentMWAssociateArrayDeserializer;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentMWAssociativeArraySerializer;
use MediaWiki\WikispeechSpeechDataCollector\Domain\User;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Domain\PersistentCompleteOneBuilder;
use MediaWiki\WikispeechSpeechDataCollector\Tests\Domain\PersistentEqualsConstraintFactory;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use MediaWikiUnitTestCase;

/**
 * @todo This is part of an internal development API. It should be removed before deployment.
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\CRUD\Transaction
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\Transaction\CRUDTransactionMWAssociativeArrayMarshaller
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\Transaction\CRUDTransactionResponse
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\Transaction\CRUDTransactionRequest
 */
class CRUDTransactionMWAssociativeArrayMarshallerTest extends MediaWikiUnitTestCase {

	public function testDeserializeRequest_singleUsers_equalsSerializedRequest() {
		$createUser = new User();
		$createUser->accept( new PersistentCompleteOneBuilder() );

		$readUser = new User();
		$readUser->setIdentity( UUID::v4BytesFactory() );

		$updateUser = new User();
		$updateUser->setIdentity( UUID::v4BytesFactory() );
		$updateUser->accept( new PersistentCompleteOneBuilder() );

		$deleteUser = new User();
		$deleteUser->setIdentity( UUID::v4BytesFactory() );

		$array = [
			'reference' => 'reference',
			'create' => [
				'User' => [
					$createUser->accept(
						new PersistentMWAssociativeArraySerializer() )
				]
			],
			'read' => [
				'User' => [
						UUID::asHex( $readUser->getIdentity() )
				]
			],
			'update' => [
				'User' => [
					$updateUser->accept(
						new PersistentMWAssociativeArraySerializer() )
				]
			],
			'delete' => [
				'User' => [
					UUID::asHex( $deleteUser->getIdentity() )
				]
			]
		];

		$marshaller = new CRUDTransactionMWAssociativeArrayMarshaller();
		$request = $marshaller->deserializeRequest( $array );

		$this->assertSame( 'reference', $request->getReference() );

		$this->assertCount( 1, $request->getCreate() );
		$this->assertThat(
			$createUser,
			$request->getCreate()[0]->accept(
				new PersistentEqualsConstraintFactory() )
		);

		$this->assertCount( 1, $request->getRead() );
		$this->assertThat(
			$readUser,
			$request->getRead()[0]->accept(
				new PersistentEqualsConstraintFactory() )
		);

		$this->assertCount( 1, $request->getUpdate() );
		$this->assertThat(
			$updateUser,
			$request->getUpdate()[0]->accept(
				new PersistentEqualsConstraintFactory() )
		);

		$this->assertCount( 1, $request->getDelete() );
		$this->assertThat(
			$deleteUser,
			$request->getDelete()[0]->accept(
				new PersistentEqualsConstraintFactory() )
		);
	}

	public function testSerializeResponse_singleUsers_equalsOriginalResponse() {
		$createdUser = new User();
		$createdUser->setIdentity( UUID::v4BytesFactory() );
		$createdUser->accept( new PersistentCompleteOneBuilder() );

		$readUser = new User();
		$readUser->setIdentity( UUID::v4BytesFactory() );
		$readUser->accept( new PersistentCompleteOneBuilder() );

		$updatedUser = new User();
		$updatedUser->setIdentity( UUID::v4BytesFactory() );
		$updatedUser->accept( new PersistentCompleteOneBuilder() );

		$deletedUser = new User();
		$deletedUser->setIdentity( UUID::v4BytesFactory() );
		$deletedUser->accept( new PersistentCompleteOneBuilder() );

		$response = new CRUDTransactionResponse();
		$response->setReference( 'reference' );
		$response->addCreated( $createdUser );
		$response->addRead( $readUser );
		$response->addUpdated( $updatedUser );
		$response->addDeleted( $deletedUser );

		$marshaller = new CRUDTransactionMWAssociativeArrayMarshaller();
		$array = $marshaller->serializeResponse( $response );

		$this->assertSame( $response->getReference(), $array['reference'] );

		$this->assertCount( 1, $array['created'] );
		$this->assertCount( 1, $array['created']['User'] );
		$deserializedCreatedUser = new User();
		$deserializedCreatedUser->accept(
			new PersistentMWAssociateArrayDeserializer(
				$array['created']['User'][0] ) );
		$this->assertThat(
			$createdUser,
			$deserializedCreatedUser->accept(
				new PersistentEqualsConstraintFactory() )
		);

		$this->assertCount( 1, $array['read'] );
		$this->assertCount( 1, $array['read']['User'] );
		$deserializedReadUser = new User();
		$deserializedReadUser->accept(
			new PersistentMWAssociateArrayDeserializer(
				$array['read']['User'][0] ) );
		$this->assertThat(
			$readUser,
			$deserializedReadUser->accept(
				new PersistentEqualsConstraintFactory() )
		);

		$this->assertCount( 1, $array['updated'] );
		$this->assertCount( 1, $array['updated']['User'] );
		$deserializedUpdatedUser = new User();
		$deserializedUpdatedUser->accept(
			new PersistentMWAssociateArrayDeserializer(
				$array['updated']['User'][0] ) );
		$this->assertThat(
			$updatedUser,
			$deserializedUpdatedUser->accept(
				new PersistentEqualsConstraintFactory() ) );

		$this->assertCount( 1, $array['deleted'] );
		$this->assertCount( 1, $array['deleted']['User'] );
		$this->assertSame(
			UUID::asBytes( $deletedUser->getIdentity() ),
			UUID::asBytes( $array['deleted']['User'][0] )
		);
	}

}
