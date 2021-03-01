<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\CRUD;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDContext;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;

/**
 * Decorator pattern implementation for {@link AbstractCRUD}.
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\CRUD
 * @since 0.1.0
 */
class DecoratedAbstractCRUD extends AbstractCRUD {

	/** @var AbstractCRUD */
	private $decorated;

	/**
	 * @param AbstractCRUD $decorated
	 * @since 0.1.0
	 */
	public function __construct( AbstractCRUD $decorated ) {
		$this->decorated = $decorated;
	}

	/** @inheritDoc */
	public function instanceFactory(): Persistent {
		return $this->decorated->instanceFactory();
	}

	/** @inheritDoc */
	public function create( Persistent $instance ): void {
		$this->decorated->create( $instance );
	}

	/** @inheritDoc */
	public function load( Persistent $instance ): bool {
		return $this->decorated->load( $instance );
	}

	/** @inheritDoc */
	public function update( Persistent $instance ): void {
		$this->decorated->update( $instance );
	}

	/** @inheritDoc */
	public function delete( $identity ): void {
		$this->decorated->delete( $identity );
	}

	/** @inheritDoc */
	public function getContext(): CRUDContext {
		return $this->decorated->getContext();
	}

	/** @inheritDoc */
	public function read( $identity ): ?Persistent {
		return $this->decorated->read( $identity );
	}

}
