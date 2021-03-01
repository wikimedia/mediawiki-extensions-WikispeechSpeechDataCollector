<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Mcr;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use MediaWiki\WikispeechSpeechDataCollector\CRUD\AbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDContext;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr\RecordingAnnotationsCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Tests\CRUD\DecoratedAbstractCRUD;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use MWException;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD\Mcr
 * @covers \MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr\RecordingAnnotationsCRUD
 * @since 0.1.0
 */
class RecordingAnnotationsMcrCRUDTest extends AbstractMcrCRUDTest {
	/**
	 * @todo Need to add identity on CRUD::create in the CRUDFactory of the CLUD in the test.
	 * Until then, this test is disabled.
	 *
	 * https://phabricator.wikimedia.org/T274827
	 *
	 * Composite parts inherit their identity from the composite owner.
	 * Composite owners set identity on CRUD::create,
	 * while composite parts has an identity which is manually set by the developer.
	 * Thus in order to share test code between owners and parts, the tests of parts
	 * need to be modified in a way that they add a new identity on create.
	 *
	 * This is quite OK to skip though. CLUD is a generic facade against CRUD,
	 * so as long as the CRUD test of this class works while CLUD tests of
	 * other classes work, everything is known to be healthy.
	 */
	public function testCLUD() {
		$this->markTestSkipped( 'Need to add identity on CRUD::create for test to work' );
		// nop
	}

	/**
	 * @todo Need to add identity on CRUD::create in the CRUDFactory of the CLUD in the test.
	 * Until then, this test is disabled.
	 *
	 * https://phabricator.wikimedia.org/T274827
	 *
	 * Composite parts inherit their identity from the composite owner.
	 * Composite owners set identity on CRUD::create,
	 * while composite parts has an identity which is manually set by the developer.
	 * Thus in order to share test code between owners and parts, the tests of parts
	 * need to be modified in a way that they add a new identity on create.
	 *
	 * This is quite OK to skip though. testCRUDTransactionExecutor is a generic facade against CRUD,
	 * so as long as the CRUD test of this class works while testCRUDTransactionExecutor tests of
	 * other classes work, everything is known to be healthy.
	 */
	public function testCRUDTransactionExecutor() {
		$this->markTestSkipped( 'Need to add identity on CRUD::create for test to work' );
		// nop
	}

	protected function newCRUDInstance(
		CRUDContext $context
	): AbstractCRUD {
		// The idea here is implement a sub class of DecoratedAbstractCRUD
		// that replace the below create function for any MCR composite part CRUD.
		// @todo Replace this anonymous inner class with that when adding new MCR composite part CRUDs.
		return new class( new RecordingAnnotationsCRUD( $context ) ) extends DecoratedAbstractCRUD {
			/**
			 * Adds identity to instance before calling decoration.
			 *
			 * @param Persistent $instance
			 * @throws MWException If identity is already set.
			 */
			public function create( Persistent $instance ): void {
				if ( $instance->getIdentity() !== null ) {
					throw new MWException( 'Identity is already set!' );
				}
				$instance->setIdentity( UUID::v4BytesFactory() );
				parent::create( $instance );
			}
		};
	}
}
