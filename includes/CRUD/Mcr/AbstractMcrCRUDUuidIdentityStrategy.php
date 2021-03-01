<?php

namespace MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use JsonContent;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\CRUDContext;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use Title;
use WikiPage;

/**
 * Backs a {@link Persistent} with UUID identity.
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr
 */
class AbstractMcrCRUDUuidIdentityStrategy implements AbstractMcrCRUDIdentityStrategy {

	/**
	 * @inheritDoc
	 * @since 0.1.0
	 */
	public function getWikiPage(
		$identity,
		CRUDContext $context
	): WikiPage {
		// @todo When bumping MW core version to 1.36, use TitleFactory from context.
		$title = Title::newFromText(
			UUID::asHex( $identity ),
			NS_SPEECH_RECORDING
		);
		// @todo When bumping MW core version up to 1.36, use WikiPageFactory from context.
		return WikiPage::factory( $title );
	}

	/**
	 * @inheritDoc
	 * @since 0.1.0
	 */
	public function identityJsonContentFactory(
		$identity
	): JsonContent {
		// @todo JsonContent is not @newable. See https://phabricator.wikimedia.org/T275578
		return new JsonContent( '"' . UUID::asHex( $identity ) . '"' );
	}

	/**
	 * @inheritDoc
	 * @since 0.1.0
	 */
	public function identityFactory(
		Persistent $instance
	): void {
		$instance->setIdentity( UUID::v4BytesFactory() );
	}

}
