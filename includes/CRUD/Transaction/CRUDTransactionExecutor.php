<?php

namespace MediaWiki\WikispeechSpeechDataCollector\CRUD\Transaction;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\CLUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDContext;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDFactory;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\PersistentRootGraphLoader;

/**
 * @todo This is part of an internal development API. It should be removed before deployment.
 *
 * A facade against {@link CLUD} to access and modify a set of
 * {@link Persistent} objects.
 *
 * The name <b>transaction</b> might be a bit misleading,
 * as this is not an ACID transaction with rollback on errors etc.
 * If your execution fails halfway through, the parts executed
 * will have been committed.
 *
 * Consider single object (atomic) calls in case you are uncertain
 * about the validity of the object you pass to the executor.
 *
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD\Transaction
 * @since 0.1.0
 */
class CRUDTransactionExecutor {

	/** @var CRUDContext */
	private $context;

	/** @var CLUD */
	private $clud;

	/**
	 * @param CRUDContext $context
	 * @since 0.1.0
	 */
	public function __construct( CRUDContext $context ) {
		$this->context = $context;
		$this->clud = new CLUD( new CRUDFactory( $context ) );
	}

	/**
	 * @param CRUDTransactionRequest $request
	 * @return CRUDTransactionResponse
	 * @throws CRUDTransactionException
	 * @since 0.1.0
	 */
	public function execute(
		CRUDTransactionRequest $request
	): CRUDTransactionResponse {
		$response = new CRUDTransactionResponse();
		$response->setReference( $request->getReference() );

		if ( $request->getCreate() ) {
			foreach ( $request->getCreate() as $instance ) {
				$this->clud->create( $instance );
				$response->addCreated( $instance );
			}
		}

		if ( $request->getRead() ) {
			foreach ( $request->getRead() as $instance ) {
				if ( $this->clud->load( $instance ) ) {
					$response->addRead( $instance );
				} else {
					throw new CRUDTransactionException( "Unable to read $instance" );
				}
			}
			if ( $request->isReadGraph() ) {
				$graphLoader = new PersistentRootGraphLoader( $this->context );
				foreach ( $response->getRead() as $instance ) {
					$instance->accept( $graphLoader );
				}
				$graphLoader->getLoadedInstances()->removeAll( $response->getRead() );
				foreach ( $graphLoader->getLoadedInstances()->toArray() as $instance ) {
					$response->addRead( $instance );
				}
			}
		}

		if ( $request->getUpdate() ) {
			foreach ( $request->getUpdate() as $instance ) {
				$this->clud->update( $instance );
				$response->addUpdated( $instance );
			}
		}

		if ( $request->getDelete() ) {
			foreach ( $request->getDelete() as $instance ) {
				$this->clud->delete( $instance );
				$response->addDeleted( $instance );
			}
		}

		return $response;
	}
}
