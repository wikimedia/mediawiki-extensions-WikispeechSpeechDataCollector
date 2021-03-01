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
use WikiPage;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr
 * @version 0.1.8
 */
interface AbstractMcrCRUDIdentityStrategy {

	/**
	 * @param mixed $identity
	 * @param CRUDContext $context
	 * @return WikiPage
	 * @since 0.1.0
	 */
	public function getWikiPage(
		$identity,
		CRUDContext $context
	): WikiPage;

	/**
	 * @param mixed $identity
	 * @return JsonContent
	 * @since 0.1.0
	 */
	public function identityJsonContentFactory(
		$identity
	): JsonContent;

	/**
	 * Sets a new identity to the instance.
	 * @param Persistent $instance
	 * @since 0.1.0
	 */
	public function identityFactory(
		Persistent $instance
	): void;
}
