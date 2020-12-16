<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Domain;

use FormatJson;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use MWException;
use MWTimestamp;
use Wikimedia\Timestamp\TimestampException;

/**
 * A {@link PersistentVisitor} that populates the instance with data
 * within an associative array produced from MW API request.
 *
 * The visitor methods will return the passed down instance, or null
 * if the associative array is null. Hence common usage looks like this:
 *
 * $persistent = $persistent->accept( new PersistentMWAssociateArrayDeserializer( $array ) );
 *
 * @package MediaWiki\WikispeechSpeechDataCollector\Domain
 * @since 0.1.0
 */
class PersistentMWAssociateArrayDeserializer implements PersistentVisitor {

	/**
	 * @var array|null Associative array produced from MW API request.
	 */
	private $array;

	/**
	 * @param array|null $array Associative array produced from MW API request.
	 */
	public function __construct( ?array $array ) {
		$this->array = $array;
	}

	/**
	 * @param string $key
	 * @return mixed|null
	 */
	private function get( string $key ) {
		return array_key_exists( $key, $this->array ) ? $this->array[$key] : null;
	}

	/**
	 * @param Language $language
	 * @return Language|null
	 */
	public function visitLanguage(
		Language $language
	): ?Language {
		if ( $this->array === null ) {
			return null;
		}
		$language->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$language->setNativeName( $this->get( 'nativeName' ) );
		$language->setIso639a1( $this->get( 'iso639a1' ) );
		$language->setIso639a2b( $this->get( 'iso639a2b' ) );
		$language->setIso639a2t( $this->get( 'iso639a2t' ) );
		$language->setIso639a3( $this->get( 'iso639a3' ) );
		return $language;
	}

	/**
	 * @param Manuscript $manuscript
	 * @return Manuscript|null
	 */
	public function visitManuscript(
		Manuscript $manuscript
	): ?Manuscript {
		if ( $this->array === null ) {
			return null;
		}
		$manuscript->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$manuscript->setName( $this->get( 'name' ) );
		$manuscript->setCreated( $this->deserializeTimestamp( $this->get( 'created' ) ) );
		$manuscript->setDisabled( $this->deserializeTimestamp( $this->get( 'disabled' ) ) );
		$manuscript->setLanguage( $this->deserializeUUID( $this->get( 'language' ) ) );
		$manuscript->setDomain( $this->deserializeUUID( $this->get( 'domain' ) ) );
		return $manuscript;
	}

	/**
	 * @param ManuscriptDomain $manuscriptDomain
	 * @return ManuscriptDomain|null
	 */
	public function visitManuscriptDomain(
		ManuscriptDomain $manuscriptDomain
	): ?ManuscriptDomain {
		if ( $this->array === null ) {
			return null;
		}
		$manuscriptDomain->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$manuscriptDomain->setName( $this->get( 'name' ) );
		$manuscriptDomain->setParent( $this->deserializeUUID( $this->get( 'parent' ) ) );
		return $manuscriptDomain;
	}

	/**
	 * @param ManuscriptPrompt $manuscriptPrompt
	 * @return ManuscriptPrompt|null
	 */
	public function visitManuscriptPrompt(
		ManuscriptPrompt $manuscriptPrompt
	): ?ManuscriptPrompt {
		if ( $this->array === null ) {
			return null;
		}
		$manuscriptPrompt->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$manuscriptPrompt->setManuscript( $this->deserializeUUID( $this->get( 'manuscript' ) ) );
		$manuscriptPrompt->setIndex( $this->get( 'index' ) );
		$manuscriptPrompt->setContent( $this->get( 'content' ) );
		return $manuscriptPrompt;
	}

	/**
	 * @param Recording $recording
	 * @return Recording|null
	 */
	public function visitRecording(
		Recording $recording
	): ?Recording {
		if ( $this->array === null ) {
			return null;
		}
		$recording->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$recording->setRecorded( $this->deserializeTimestamp( $this->get( 'recorded' ) ) );
		$recording->setVoiceOf( $this->deserializeUUID( $this->get( 'voiceOf' ) ) );
		$recording->setSpokenDialect( $this->deserializeUUID( $this->get( 'spokenDialect' ) ) );
		$recording->setManuscriptPrompt( $this->deserializeUUID( $this->get( 'manuscriptPrompt' ) ) );
		return $recording;
	}

	/**
	 * @param RecordingAnnotation $recordingAnnotation
	 * @return RecordingAnnotation|null
	 */
	public function visitRecordingAnnotation(
		RecordingAnnotation $recordingAnnotation
	): ?RecordingAnnotation {
		if ( $this->array === null ) {
			return null;
		}
		$recordingAnnotation->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$recordingAnnotation->setRecording( $this->deserializeUUID( $this->get( 'recording' ) ) );
		$recordingAnnotation->setStart( $this->get( 'start' ) );
		$recordingAnnotation->setEnd( $this->get( 'end' ) );
		$recordingAnnotation->setStereotype( $this->deserializeUUID( $this->get( 'stereotype' ) ) );
		$recordingAnnotation->setValue( $this->get( 'value' ) );
		return $recordingAnnotation;
	}

	/**
	 * @param RecordingAnnotationStereotype $recordingAnnotationStereotype
	 * @return RecordingAnnotationStereotype|null
	 */
	public function visitRecordingAnnotationStereotype(
		RecordingAnnotationStereotype $recordingAnnotationStereotype
	): ?RecordingAnnotationStereotype {
		if ( $this->array === null ) {
			return null;
		}
		$recordingAnnotationStereotype->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$recordingAnnotationStereotype->setValueClass( $this->get( 'valueClass' ) );
		$recordingAnnotationStereotype->setDescription( $this->get( 'description' ) );
		return $recordingAnnotationStereotype;
	}

	/**
	 * @param RecordingReview $recordingReview
	 * @return RecordingReview|null
	 */
	public function visitRecordingReview(
		RecordingReview $recordingReview
	): ?RecordingReview {
		if ( $this->array === null ) {
			return null;
		}
		$recordingReview->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$recordingReview->setCreated( $this->deserializeTimestamp( $this->get( 'created' ) ) );
		$recordingReview->setValue( $this->get( 'value' ) );
		$recordingReview->setReviewer( $this->deserializeUUID( $this->get( 'reviewer' ) ) );
		$recordingReview->setRecording( $this->deserializeUUID( $this->get( 'recording' ) ) );
		return $recordingReview;
	}

	/**
	 * @param SkippedManuscriptPrompt $skippedManuscriptPrompt
	 * @return SkippedManuscriptPrompt|null
	 */
	public function visitSkippedManuscriptPrompt(
		SkippedManuscriptPrompt $skippedManuscriptPrompt
	): ?SkippedManuscriptPrompt {
		if ( $this->array === null ) {
			return null;
		}
		$skippedManuscriptPrompt->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$skippedManuscriptPrompt->setManuscriptPrompt(
			$this->deserializeUUID( $this->get( 'manuscriptPrompt' ) ) );
		$skippedManuscriptPrompt->setUser( $this->deserializeUUID( $this->get( 'user' ) ) );
		$skippedManuscriptPrompt->setSkipped( $this->deserializeTimestamp( $this->get( 'skipped' ) ) );
		return $skippedManuscriptPrompt;
	}

	/**
	 * @param User $user
	 * @return User|null
	 */
	public function visitUser(
		User $user
	): ?User {
		if ( $this->array === null ) {
			return null;
		}
		$user->setIdentity( $this->deserializeUUID( $this->array[ 'identity' ] ) );
		$user->setMediaWikiUser( $this->get( 'mediaWikiUser' ) );
		$user->setYearBorn( $this->get( 'yearBorn' ) );
		return $user;
	}

	/**
	 * @param UserDialect $userDialect
	 * @return UserDialect|null
	 */
	public function visitUserDialect(
		UserDialect $userDialect
	): ?UserDialect {
		if ( $this->array === null ) {
			return null;
		}
		$userDialect->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$userDialect->setUser( $this->deserializeUUID( $this->get( 'user' ) ) );
		$userDialect->setLanguage( $this->deserializeUUID( $this->get( 'language' ) ) );
		$userDialect->setSpokenProficiencyLevel( $this->get( 'spokenProficiencyLevel' ) );
		$userDialect->setLocation( $this->deserializeJsonObject( $this->get( 'location' ) ) );
		return $userDialect;
	}

	/**
	 * @param UserLanguageProficiencyLevel $languageProficiencyLevel
	 * @return UserLanguageProficiencyLevel|null
	 */
	public function visitUserLanguageProficiencyLevel(
		UserLanguageProficiencyLevel $languageProficiencyLevel
	): ?UserLanguageProficiencyLevel {
		if ( $this->array === null ) {
			return null;
		}
		$languageProficiencyLevel->setIdentity( $this->deserializeUUID( $this->get( 'identity' ) ) );
		$languageProficiencyLevel->setUser( $this->deserializeUUID( $this->get( 'user' ) ) );
		$languageProficiencyLevel->setLanguage( $this->deserializeUUID( $this->get( 'language' ) ) );
		$languageProficiencyLevel->setProficiencyLevel( $this->get( 'proficiencyLevel' ) );
		return $languageProficiencyLevel;
	}

	/**
	 * @param string|null $value
	 * @return string|null
	 */
	private function deserializeUUID(
		?string $value
	): ?string {
		if ( $value === null ) {
			return null;
		}
		return UUID::asBytes( $value );
	}

	/**
	 * @param mixed|null $value
	 * @return MWTimestamp|null
	 * @throws TimestampException
	 */
	private function deserializeTimestamp(
		$value
	): ?MWTimestamp {
		if ( $value === null ) {
			return null;
		}
		$timestamp = new MWTimestamp();
		$timestamp->setTimestamp( $value );
		return $timestamp;
	}

	/**
	 * @param string|null $value
	 * @return string|null
	 * @throws MWException
	 */
	private function deserializeJsonObject(
		$value
	): ?string {
		if ( $value === null ) {
			return null;
		}
		$json = FormatJson::encode( $value );
		if ( $json === false ) {
			throw new MWException( 'Failed to encode to JSON.' );
		}
		return $json;
	}

}
