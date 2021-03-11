<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Crud\Mcr;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use JsonContent;
use MediaWiki\WikispeechSpeechDataCollector\Crud\CrudContext;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Uuid;
use Title;
use WikiPage;

/**
 * Backs a {@link Persistent} with UUID identity.
 * @package MediaWiki\WikispeechSpeechDataCollector\Crud\Mcr
 */
class AbstractMcrCrudUuidIdentityStrategy implements AbstractMcrCrudIdentityStrategy {

	/**
	 * @inheritDoc
	 * @since 0.1.0
	 */
	public function getWikiPage(
		$identity,
		CrudContext $context
	): WikiPage {
		// @todo When bumping MW core version to 1.36, use TitleFactory from context.
		$title = Title::newFromText(
			Uuid::asHex( $identity ),
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
		return new JsonContent( '"' . Uuid::asHex( $identity ) . '"' );
	}

	/**
	 * @inheritDoc
	 * @since 0.1.0
	 */
	public function identityFactory(
		Persistent $instance
	): void {
		$instance->setIdentity( Uuid::v4BytesFactory() );
	}

}
