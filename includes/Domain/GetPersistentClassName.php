<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Domain;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

/**
 * Returns class name string <b>without</b> namespace qualifier.
 *
 * @see get_class() Returns class name string <b>with</b> namespace qualifier.
 * @since 0.1.0
 */
class GetPersistentClassName implements PersistentVisitor {

	/**
	 * @since 0.1.0
	 * @param Language $language
	 * @return string
	 */
	public function visitLanguage(
		Language $language
	) {
		return 'Language';
	}

	/**
	 * @since 0.1.0
	 * @param Manuscript $manuscript
	 * @return string
	 */
	public function visitManuscript(
		Manuscript $manuscript
	) {
		return 'Manuscript';
	}

	/**
	 * @since 0.1.0
	 * @param ManuscriptDomain $manuscriptDomain
	 * @return string
	 */
	public function visitManuscriptDomain(
		ManuscriptDomain $manuscriptDomain
	) {
		return 'ManuscriptDomain';
	}

	/**
	 * @since 0.1.0
	 * @param ManuscriptPrompt $manuscriptPrompt
	 * @return string
	 */
	public function visitManuscriptPrompt(
		ManuscriptPrompt $manuscriptPrompt
	) {
		return 'ManuscriptPrompt';
	}

	/**
	 * @since 0.1.0
	 * @param Recording $recording
	 * @return string
	 */
	public function visitRecording(
		Recording $recording
	) {
		return 'Recording';
	}

	/**
	 * @since 0.1.0
	 * @param RecordingAnnotations $recordingAnnotations
	 * @return string
	 */
	public function visitRecordingAnnotations(
		RecordingAnnotations $recordingAnnotations
	) {
		return 'RecordingAnnotations';
	}

	/**
	 * @since 0.1.0
	 * @param RecordingReview $recordingReview
	 * @return string
	 */
	public function visitRecordingReview(
		RecordingReview $recordingReview
	) {
		return 'RecordingReview';
	}

	/**
	 * @since 0.1.0
	 * @param SkippedManuscriptPrompt $skippedManuscriptPrompt
	 * @return string
	 */
	public function visitSkippedManuscriptPrompt(
		SkippedManuscriptPrompt $skippedManuscriptPrompt
	) {
		return 'SkippedManuscriptPrompt';
	}

	/**
	 * @since 0.1.0
	 * @param User $user
	 * @return string
	 */
	public function visitUser(
		User $user
	) {
		return 'User';
	}

	/**
	 * @since 0.1.0
	 * @param UserDialect $userDialect
	 * @return string
	 */
	public function visitUserDialect(
		UserDialect $userDialect
	) {
		return 'UserDialect';
	}

	/**
	 * @since 0.1.0
	 * @param UserLanguageProficiencyLevel $languageProficiencyLevel
	 * @return string
	 */
	public function visitUserLanguageProficiencyLevel(
		UserLanguageProficiencyLevel $languageProficiencyLevel
	) {
		return 'UserLanguageProficiencyLevel';
	}
}
