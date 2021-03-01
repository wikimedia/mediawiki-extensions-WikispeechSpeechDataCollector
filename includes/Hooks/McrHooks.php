<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Hooks;

use MediaWiki\Hook\MediaWikiServicesHook;
use MediaWiki\MediaWikiServices;
use MediaWiki\Revision\SlotRoleRegistry;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr\RecordingAnnotationsCRUD;

/**
 * Registers multi content revision slot roles,
 * i.e. name and content type of slots used by this extension.
 *
 * @since 0.1.0
 * @package MediaWiki\WikispeechSpeechDataCollector\Hooks
 */
class McrHooks implements MediaWikiServicesHook {
	/**
	 * @param MediaWikiServices $services
	 * @return bool|void
	 * @since 0.1.0
	 */
	public function onMediaWikiServices( $services ) {
		$services->addServiceManipulator(
			'SlotRoleRegistry',
			function ( SlotRoleRegistry $registry ) {
				$registry->defineRoleWithModel(
					RecordingAnnotationsCRUD::SLOT_ROLE,
					CONTENT_MODEL_JSON
				);
			}
		);
	}
}
