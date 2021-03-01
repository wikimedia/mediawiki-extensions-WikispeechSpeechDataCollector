<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Domain;

use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptPrompt;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;

/**
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Domain
 * @since 0.1.0
 */
class ManuscriptPromptEqualsConstraint extends PersistentEqualsConstraint {

	/**
	 * @since 0.1.0
	 * @param ManuscriptPrompt $expected
	 * @param ManuscriptPrompt $actual
	 */
	protected function evaluateNonIdentityFields(
		Persistent $expected,
		Persistent $actual
	) {
		$this->matchIsSame( 'index', $expected->getIndex(), $actual->getIndex() );
		$this->matchIsSame( 'content', $expected->getContent(), $actual->getContent() );
		$this->matchIsSame( 'manuscript', $expected->getManuscript(), $actual->getManuscript() );
	}

}
