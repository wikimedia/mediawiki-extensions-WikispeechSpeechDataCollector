<?php

namespace MediaWiki\WikispeechSpeechDataCollector\CRUD\Transaction;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

/**
 * @todo This is part of an internal development API. It should be removed before deployment.
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD\Transaction
 * @since 0.1.0
 */
interface CRUDTransactionMarshaller {

	/**
	 * @param mixed $serializedRequest
	 * @return CRUDTransactionRequest
	 * @throws CRUDTransactionException
	 */
	public function deserializeRequest( $serializedRequest ): CRUDTransactionRequest;

	/**
	 * @param CRUDTransactionResponse $response
	 * @return mixed
	 * @throws CRUDTransactionException
	 */
	public function serializeResponse( CRUDTransactionResponse $response );

}
