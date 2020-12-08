<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain;

use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptDomain;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentVisitorAdapter;

/**
 * Class ManuscriptDomainTest
 * @package MediaWiki\WikispeechSpeechDataCollector\Tests\Unit\Domain
 * @covers \MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptDomain
 * @since 0.1.0
 */
class ManuscriptDomainTest extends AbstractPersistentTest {

	protected function instanceFactory(): Persistent {
		return new ManuscriptDomain();
	}

	protected function visitorTestFactory(): PersistentVisitorAdapter {
		return new class extends PersistentVisitorAdapter {
			public function visitManuscriptDomain( ManuscriptDomain $manuscriptDomain ): ?object {
				return null;
			}
		};
	}

}
