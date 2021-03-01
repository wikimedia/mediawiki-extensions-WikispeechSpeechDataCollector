<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use MediaWiki\MediaWikiServices;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Mcr\RecordingAnnotationsCRUD;
use MediaWikiIntegrationTestCase;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\CRUD
 * @covers \MediaWiki\WikispeechSpeechDataCollector\Hooks\McrHooks
 * @since 0.1.0
 */
class McrHooksTest extends MediaWikiIntegrationTestCase {

	public function testSlotRoleRegistry_getMcrHooks_exists() {
		$definedRoles = MediaWikiServices::getInstance()->getSlotRoleRegistry()->getDefinedRoles();
		$this->assertContains( RecordingAnnotationsCRUD::SLOT_ROLE, $definedRoles );
	}

}
