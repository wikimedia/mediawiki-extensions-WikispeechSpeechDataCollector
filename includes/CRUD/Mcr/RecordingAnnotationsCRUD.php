<?php

namespace MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr;

use JsonContent;
use MediaWiki\Storage\PageUpdater;
use MediaWiki\Storage\RevisionRecord;
use MediaWiki\Storage\SlotRecord;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDContext;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentJsonDeserializer;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentJsonSerializer;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotations;
use MWException;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr
 *
 * Multi Content Revision mapping and access for {@link RecordingAnnotations}
 *
 * @since 0.1.0
 */
class RecordingAnnotationsCRUD extends AbstractCompositePartMcrCRUD {

	public const SLOT_ROLE = 'ws_sdc_recording_annotations';

	/**
	 * @param CRUDContext $context
	 * @since 0.1.0
	 */
	public function __construct(
		CRUDContext $context
	) {
		parent::__construct(
			$context,
			new AbstractMcrCRUDUuidIdentityStrategy()
		);
	}

	/**
	 * @inheritDoc
	 * @since 0.1.0
	 */
	public function instanceFactory(): Persistent {
		return new RecordingAnnotations();
	}

	/**
	 * @inheritDoc
	 * @since 0.1.0
	 */
	public function serialize( Persistent $instance, PageUpdater $pageUpdater ): void {
		$slotRecord = SlotRecord::newUnsaved(
			self::SLOT_ROLE,
			// @todo JsonContent is not @newable. See https://phabricator.wikimedia.org/T275578
			new JsonContent( $instance->accept( new PersistentJsonSerializer() ) )
		);
		$pageUpdater->setSlot( $slotRecord );
	}

	/**
	 * @param Persistent $instance
	 * @param RevisionRecord $revisionRecord
	 * @return bool
	 * @throws MWException If MCR content is not an instance of {@link JsonContent}.
	 * @since 0.1.0
	 */
	public function deserialize( Persistent $instance, RevisionRecord $revisionRecord ): bool {
		if ( !$revisionRecord->hasSlot( self::SLOT_ROLE ) ) {
			return false;
		}
		$slotRecord = $revisionRecord->getSlot(
			self::SLOT_ROLE,
			RevisionRecord::FOR_PUBLIC
		);
		$content = $slotRecord->getContent();
		if ( !( $content instanceof JsonContent ) ) {
			throw new MWException(
				'Expected slot content to be an instance of JsonContent but got ' .
				get_class( $content ) . ' instead.'
			);
		}
		return $instance->accept( new PersistentJsonDeserializer( $content->getText() ) ) !== null;
	}

}
