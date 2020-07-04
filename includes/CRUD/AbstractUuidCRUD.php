<?php

namespace MediaWiki\WikispeechSpeechDataCollector\CRUD;

use Exception;
use ExternalStoreException;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;

/**
 * Class AbstractUuidCRUD
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD
 * @since 0.1.0
 *
 * Assigns a UUID as identity in local scope before insert to table.
 */
abstract class AbstractUuidCRUD extends AbstractCRUD {

	/**
	 * @todo implement better and perhaps deterministic v4 uuids?
	 * @return string
	 * @throws Exception If it was not possible to gather enough entropy
	 */
	private function uuidFactory() {
		return random_bytes( 16 );
	}

	/**
	 * Given a persistent domain object instance with at least identity set,
	 * creates representation in database to correspond to the data set in the domain object.
	 *
	 * @param Persistent &$instance
	 * @throws ExternalStoreException If instance identity is already set
	 */
	public function create(
		Persistent &$instance
	): void {
		if ( $instance->getIdentity() ) {
			throw new ExternalStoreException( 'Identity already set' );
		}
		$instance->setIdentity( $this->uuidFactory() );
		$rows = [];
		$this->serializeFields( $instance, $rows );
		$rows[ $this->getIdentityColumn() ] = $instance->getIdentity();
		$dbw = $this->dbLoadBalancer->getConnectionRef( DB_MASTER );
		$dbw->insert( $this->getTable(), $rows );
	}

	/**
	 * @param Persistent &$instance
	 * @param array $row
	 */
	protected function deserializeRowIdentity(
		Persistent &$instance,
		$row
	): void {
		$instance->setIdentity( strval( $row[ $this->getIdentityColumn() ] ) );
	}

	/**
	 * @param string $identity
	 * @return Persistent|null
	 */
	public function read(
		$identity
	): ?object {
		return parent::read( $identity );
	}

	/**
	 * @param string $identity
	 */
	public function delete(
		$identity
	): void {
		parent::delete( $identity );
	}

}
