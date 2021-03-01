<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Domain;

use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Domain\User;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Domain
 */
class UserEqualsConstraint extends PersistentEqualsConstraint {

	/**
	 * @since 0.1.0
	 * @param User $expected
	 * @param User $actual
	 */
	protected function evaluateNonIdentityFields(
		Persistent $expected,
		Persistent $actual
	) {
		$this->matchIsSame( 'mediaWikiUser', $expected->getMediaWikiUser(), $actual->getMediaWikiUser() );
		$this->matchIsSame( 'yearBorn', $expected->getYearBorn(), $actual->getYearBorn() );
	}

}
