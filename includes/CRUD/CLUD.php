<?php

namespace MediaWiki\WikispeechSpeechDataCollector\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;

/**
 * Convenience class used to create, load, update and delete any {@link Persistent} instance.
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD
 * @since 0.1.0
 */
class CLUD {

	/**
	 * @var CRUDFactory Reused instance to save a couple of clock ticks.
	 * @note Consider implementing a flyweight pattern to reuse CRUDs returned by CRUDFactory.
	 *  That should probably be implemented as a reusable decorated CRUDFactory
	 *  rather than implemented directly in this class.
	 */
	private $crudFactory;

	/**
	 * @param CRUDFactory $crudFactory
	 */
	public function __construct(
		CRUDFactory $crudFactory
	) {
		$this->crudFactory = $crudFactory;
	}

	/**
	 * Will set new identity using {@link Persistent::setIdentity()}.
	 * @param Persistent $instance Instance to be inserted to the persistent layer.
	 */
	public function create( Persistent $instance ) {
		$instance
			->accept( $this->crudFactory )
			->create( $instance );
	}

	/**
	 * Expects identity is available via {@link Persistent::getIdentity()}.
	 * @param Persistent $instance Object instance to be loaded from persistent layer.
	 *  Identity must be set.
	 * @return bool true if found, false if not found.
	 */
	public function load( Persistent $instance ): bool {
		return $instance
			->accept( $this->crudFactory )
			->load( $instance );
	}

	/**
	 * @param Persistent $instance Object instance to be updated in persistent layer.
	 */
	public function update( Persistent $instance ): void {
		$instance
			->accept( $this->crudFactory )
			->update( $instance );
	}

	/**
	 * @param Persistent $instance Object instance to be updated in persistent layer.
	 */
	public function delete( Persistent $instance ): void {
		$instance
			->accept( $this->crudFactory )
			->delete( $instance->getIdentity() );
	}
}
