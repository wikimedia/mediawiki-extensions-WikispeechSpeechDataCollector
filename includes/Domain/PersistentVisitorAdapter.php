<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Domain;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use LogicException;

/**
 * An adapter pattern with no actual implementations on top of the persistent visitor.
 * For use with those implementations that only add support for some of the persistent subclasses.
 *
 * Throws an exception on any non overridden invocation.
 * @phan-file-suppress PhanPluginNeverReturnMethod
 *
 * @since 0.1.0
 */
abstract class PersistentVisitorAdapter implements PersistentVisitor {

	/**
	 * @inheritDoc
	 */
	public function visitLanguage(
		Language $language
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitManuscript(
		Manuscript $manuscript
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitManuscriptDomain(
		ManuscriptDomain $manuscriptDomain
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitManuscriptPrompt(
		ManuscriptPrompt $manuscriptPrompt
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitRecording(
		Recording $recording
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitRecordingAnnotations(
		RecordingAnnotations $recordingAnnotations
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitRecordingReview(
		RecordingReview $recordingReview
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitSkippedManuscriptPrompt(
		SkippedManuscriptPrompt $skippedManuscriptPrompt
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitUser(
		User $user
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitUserDialect(
		UserDialect $userDialect
	) {
		throw new LogicException( 'Not implemented' );
	}

	/**
	 * @inheritDoc
	 */
	public function visitUserLanguageProficiencyLevel(
		UserLanguageProficiencyLevel $languageProficiencyLevel
	) {
		throw new LogicException( 'Not implemented' );
	}
}
