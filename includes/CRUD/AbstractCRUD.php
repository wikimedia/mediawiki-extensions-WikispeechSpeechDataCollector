<?php

namespace MediaWiki\WikispeechSpeechDataCollector\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD
 *
 * Abstract access for instances of the corresponding underlying subclass of {@link Persistent}.
 *
 * @since 0.1.0
 */
abstract class AbstractCRUD implements CRUD {

	/**
	 * Creates a new instance
	 * of the corresponding underlying subclass of {@link Persistent}.
	 *
	 * @return Persistent
	 */
	abstract public function instanceFactory(): Persistent;

	/**
	 * Given an identity,
	 * retrieves a persistent domain object from the database.
	 *
	 * @see load()
	 * @param mixed $identity
	 * @return Persistent|null
	 */
	public function read(
		$identity
	): ?Persistent {
		$instance = $this->instanceFactory();
		$instance->setIdentity( $identity );
		return $this->load( $instance ) ? $instance : null;
	}
}
