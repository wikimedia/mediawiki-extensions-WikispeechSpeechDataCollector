<?php

namespace MediaWiki\WikispeechSpeechDataCollector\CRUD;

use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\LanguageCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptDomainCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\ManuscriptPromptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingAnnotationCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingAnnotationStereotypeCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\RecordingReviewCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\SkippedManuscriptPromptCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\UserCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\UserDialectCRUD;
use MediaWiki\WikispeechSpeechDataCollector\CRUD\Rdbms\UserLanguageProficiencyLevelCRUD;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Language;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Manuscript;
use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptDomain;
use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptPrompt;
use MediaWiki\WikispeechSpeechDataCollector\Domain\PersistentVisitor;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Recording;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotation;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingAnnotationStereotype;
use MediaWiki\WikispeechSpeechDataCollector\Domain\RecordingReview;
use MediaWiki\WikispeechSpeechDataCollector\Domain\SkippedManuscriptPrompt;
use MediaWiki\WikispeechSpeechDataCollector\Domain\User;
use MediaWiki\WikispeechSpeechDataCollector\Domain\UserDialect;
use MediaWiki\WikispeechSpeechDataCollector\Domain\UserLanguageProficiencyLevel;

/**
 * Class CRUDFactory
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD
 *
 * A {@link PersistentVisitor}
 * that return the corresponding {@link CRUD}
 * that represents the given {@link Persistent}.
 *
 * @since 0.1.0
 */
class CRUDFactory implements PersistentVisitor {

	/** @var CRUDContext */
	private $context;

	/**
	 * @param CRUDContext $context
	 * @since 0.1.0
	 */
	public function __construct(
		CRUDContext $context
	) {
		$this->context = $context;
	}

	/**
	 * @param Language $language
	 * @return LanguageCRUD
	 */
	public function visitLanguage(
		Language $language
	): LanguageCRUD {
		return new LanguageCRUD( $this->context );
	}

	/**
	 * @param Manuscript $manuscript
	 * @return ManuscriptCRUD
	 */
	public function visitManuscript(
		Manuscript $manuscript
	): ManuscriptCRUD {
		return new ManuscriptCRUD( $this->context );
	}

	/**
	 * @param ManuscriptDomain $manuscriptDomain
	 * @return ManuscriptDomainCRUD
	 */
	public function visitManuscriptDomain(
		ManuscriptDomain $manuscriptDomain
	): ManuscriptDomainCRUD {
		return new ManuscriptDomainCRUD( $this->context );
	}

	/**
	 * @param ManuscriptPrompt $manuscriptPrompt
	 * @return ManuscriptPromptCRUD
	 */
	public function visitManuscriptPrompt(
		ManuscriptPrompt $manuscriptPrompt
	): ManuscriptPromptCRUD {
		return new ManuscriptPromptCRUD( $this->context );
	}

	/**
	 * @param Recording $recording
	 * @return RecordingCRUD
	 */
	public function visitRecording(
		Recording $recording
	): RecordingCRUD {
		return new RecordingCRUD( $this->context );
	}

	/**
	 * @param RecordingAnnotation $recordingAnnotation
	 * @return RecordingAnnotationCRUD
	 */
	public function visitRecordingAnnotation(
		RecordingAnnotation $recordingAnnotation
	): RecordingAnnotationCRUD {
		return new RecordingAnnotationCRUD( $this->context );
	}

	/**
	 * @param RecordingAnnotationStereotype $recordingAnnotationStereotype
	 * @return RecordingAnnotationStereotypeCRUD
	 */
	public function visitRecordingAnnotationStereotype(
		RecordingAnnotationStereotype $recordingAnnotationStereotype
	): RecordingAnnotationStereotypeCRUD {
		return new RecordingAnnotationStereotypeCRUD( $this->context );
	}

	/**
	 * @param RecordingReview $recordingReview
	 * @return RecordingReviewCRUD
	 */
	public function visitRecordingReview(
		RecordingReview $recordingReview
	): RecordingReviewCRUD {
		return new RecordingReviewCRUD( $this->context );
	}

	/**
	 * @param SkippedManuscriptPrompt $skippedManuscriptPrompt
	 * @return SkippedManuscriptPromptCRUD
	 */
	public function visitSkippedManuscriptPrompt(
		SkippedManuscriptPrompt $skippedManuscriptPrompt
	): SkippedManuscriptPromptCRUD {
		return new SkippedManuscriptPromptCRUD( $this->context );
	}

	/**
	 * @param User $user
	 * @return UserCRUD
	 */
	public function visitUser(
		User $user
	): UserCRUD {
		return new UserCRUD( $this->context );
	}

	/**
	 * @param UserDialect $userDialect
	 * @return UserDialectCRUD
	 */
	public function visitUserDialect(
		UserDialect $userDialect
	): UserDialectCRUD {
		return new UserDialectCRUD( $this->context );
	}

	/**
	 * @param UserLanguageProficiencyLevel $languageProficiencyLevel
	 * @return UserLanguageProficiencyLevelCRUD
	 */
	public function visitUserLanguageProficiencyLevel(
		UserLanguageProficiencyLevel $languageProficiencyLevel
	): UserLanguageProficiencyLevelCRUD {
		return new UserLanguageProficiencyLevelCRUD( $this->context );
	}

}
