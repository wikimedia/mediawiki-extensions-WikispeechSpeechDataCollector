<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Domain;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use FormatJson;
use MediaWiki\WikispeechSpeechDataCollector\UUID;
use MWException;
use MWTimestamp;

/**
 * A {@link PersistentVisitor} that populates an associative array
 * with data set in the persistent instance, to be used as an MW API response.
 *
 * $array = $persistent->accept( new PersistentMWAssociateArraySerializer() );
 *
 * @package MediaWiki\WikispeechSpeechDataCollector\Domain
 * @since 0.1.0
 */
class PersistentMWAssociativeArraySerializer implements PersistentVisitor {

	/**
	 * @param Manuscript $manuscript
	 * @return array
	 */
	public function visitManuscript(
		Manuscript $manuscript
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $manuscript->getIdentity() );
		$array['name'] = $manuscript->getName();
		$array['created'] = $this->serializeTimestamp( $manuscript->getCreated() );
		$array['disabled'] = $this->serializeTimestamp( $manuscript->getDisabled() );
		$array['language'] = $this->serializeUUID( $manuscript->getLanguage() );
		$array['domain'] = $this->serializeUUID( $manuscript->getDomain() );
		return $array;
	}

	/**
	 * @param ManuscriptPrompt $manuscriptPrompt
	 * @return array
	 */
	public function visitManuscriptPrompt(
		ManuscriptPrompt $manuscriptPrompt
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $manuscriptPrompt->getIdentity() );
		$array['manuscript'] = $this->serializeUUID( $manuscriptPrompt->getManuscript() );
		$array['index'] = $manuscriptPrompt->getIndex();
		$array['content'] = $manuscriptPrompt->getContent();
		return $array;
	}

	/**
	 * @param Recording $recording
	 * @return array
	 */
	public function visitRecording(
		Recording $recording
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $recording->getIdentity() );
		$array['recorded'] = $this->serializeTimestamp( $recording->getRecorded() );
		$array['voiceOf'] = $this->serializeUUID( $recording->getVoiceOf() );
		$array['spokenDialect'] = $this->serializeUUID( $recording->getSpokenDialect() );
		$array['manuscriptPrompt'] = $this->serializeUUID( $recording->getManuscriptPrompt() );
		$array['audioFileWikiPageIdentity'] = $recording->getAudioFileWikiPageIdentity();
		return $array;
	}

	/**
	 * @param Language $language
	 * @return array
	 */
	public function visitLanguage(
		Language $language
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $language->getIdentity() );
		$array['nativeName'] = $language->getNativeName();
		$array['iso639a1'] = $language->getIso639a1();
		$array['iso639a2b'] = $language->getIso639a2b();
		$array['iso639a2t'] = $language->getIso639a2t();
		$array['iso639a3'] = $language->getIso639a3();
		return $array;
	}

	/**
	 * @param ManuscriptDomain $manuscriptDomain
	 * @return array
	 */
	public function visitManuscriptDomain(
		ManuscriptDomain $manuscriptDomain
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $manuscriptDomain->getIdentity() );
		$array['name'] = $manuscriptDomain->getName();
		$array['parent'] = $this->serializeUUID( $manuscriptDomain->getParent() );
		return $array;
	}

	/**
	 * @param RecordingAnnotation $recordingAnnotation
	 * @return array
	 */
	public function visitRecordingAnnotation(
		RecordingAnnotation $recordingAnnotation
	): array {
		$array = [];
		$array['start'] = $recordingAnnotation->getStart();
		$array['end'] = $recordingAnnotation->getEnd();
		$array['stereotype'] = $recordingAnnotation->getStereotype();
		$array['value'] = $recordingAnnotation->getValue();
		return $array;
	}

	/**
	 * @param RecordingAnnotations $recordingAnnotations
	 * @return array
	 */
	public function visitRecordingAnnotations(
		RecordingAnnotations $recordingAnnotations
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $recordingAnnotations->getIdentity() );
		$array['items'] = [];
		if ( $recordingAnnotations->getItems() !== null &&
			// @phan-suppress-next-line PhanTypeMismatchArgumentNullableInternal
			count( $recordingAnnotations->getItems() ) > 0
		) {
			foreach ( $recordingAnnotations->getItems() as $recordingAnnotation ) {
				$array['items'][] = $this->visitRecordingAnnotation( $recordingAnnotation );
			}
		}

		return $array;
	}

	/**
	 * @param RecordingReview $recordingReview
	 * @return array
	 */
	public function visitRecordingReview(
		RecordingReview $recordingReview
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $recordingReview->getIdentity() );
		$array['created'] = $this->serializeTimestamp( $recordingReview->getCreated() );
		$array['value'] = $recordingReview->getValue();
		$array['reviewer'] = $this->serializeUUID( $recordingReview->getReviewer() );
		$array['recording'] = $this->serializeUUID( $recordingReview->getRecording() );
		return $array;
	}

	/**
	 * @param SkippedManuscriptPrompt $skippedManuscriptPrompt
	 * @return array
	 */
	public function visitSkippedManuscriptPrompt(
		SkippedManuscriptPrompt $skippedManuscriptPrompt
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $skippedManuscriptPrompt->getIdentity() );
		$array['manuscriptPrompt'] =
			$this->serializeUUID( $skippedManuscriptPrompt->getManuscriptPrompt() );
		$array['user'] = $this->serializeUUID( $skippedManuscriptPrompt->getUser() );
		$array['skipped'] =	$this->serializeTimestamp( $skippedManuscriptPrompt->getSkipped() );
		return $array;
	}

	/**
	 * @param User $user
	 * @return array
	 */
	public function visitUser(
		User $user
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $user->getIdentity() );
		$array['mediaWikiUser'] = $user->getMediaWikiUser();
		$array['yearBorn'] = $user->getYearBorn();
		return $array;
	}

	/**
	 * @param UserDialect $userDialect
	 * @return array
	 */
	public function visitUserDialect(
		UserDialect $userDialect
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $userDialect->getIdentity() );
		$array['user'] = $this->serializeUUID( $userDialect->getUser() );
		$array['language'] = $this->serializeUUID( $userDialect->getLanguage() );
		$array['spokenProficiencyLevel'] = $userDialect->getSpokenProficiencyLevel();
		$array['location'] = $this->serializeJSON( $userDialect->getLocation() );
		return $array;
	}

	/**
	 * @param UserLanguageProficiencyLevel $languageProficiencyLevel
	 * @return array
	 */
	public function visitUserLanguageProficiencyLevel(
		UserLanguageProficiencyLevel $languageProficiencyLevel
	): array {
		$array = [];
		$array['identity'] = $this->serializeUUID( $languageProficiencyLevel->getIdentity() );
		$array['user'] = $this->serializeUUID( $languageProficiencyLevel->getUser() );
		$array['language'] = $this->serializeUUID( $languageProficiencyLevel->getLanguage() );
		$array['proficiencyLevel'] = $languageProficiencyLevel->getProficiencyLevel();
		return $array;
	}

	/**
	 * @param MWTimestamp|null $value
	 * @return string|null ISO 8601
	 */
	private function serializeTimestamp(
		?MWTimestamp $value
	): ?string {
		return $value === null ? null : $value->getTimestamp( TS_ISO_8601 );
	}

	/**
	 * @param string|null $value
	 * @return string|null Hex encoded UUID with dash separation.
	 */
	private function serializeUUID(
		?string $value
	): ?string {
		return UUID::asHex( $value, true );
	}

	/**
	 * @param string|null $value
	 * @return mixed
	 * @throws MWException
	 */
	private function serializeJSON(
		?string $value
	) {
		if ( $value === null ) {
			return null;
		}
		$parsed = FormatJson::parse( $value, FormatJson::FORCE_ASSOC );
		if ( !$parsed->isOK() ) {
			throw new MWException( "Unable to parse JSON.\n" . $parsed->__toString() );
		}
		return $parsed->getValue();
	}
}
