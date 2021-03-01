<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Integration\Crud\Rdbms;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use MediaWiki\WikispeechSpeechDataCollector\Crud\AbstractCrud;
use MediaWiki\WikispeechSpeechDataCollector\Crud\CrudContext;
use MediaWiki\WikispeechSpeechDataCollector\Crud\Rdbms\UserLanguageProficiencyLevelCrud;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Test\Integration\Crud\Rdbms
 *
 * @since 0.1.0
 * @group Database
 * @covers \MediaWiki\WikispeechSpeechDataCollector\Crud\Rdbms\UserLanguageProficiencyLevelCrud
 */
class UserLanguageProficiencyLevelCrudTest extends AbstractRdbmsCrudTest {
	protected function newCrudInstance(
		CrudContext $context
	): AbstractCrud {
		return new UserLanguageProficiencyLevelCrud( $context );
	}
}
