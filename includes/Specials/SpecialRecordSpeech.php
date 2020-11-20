<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Specials;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use OOUI\ButtonWidget;
use OOUI\FieldLayout;
use OOUI\FieldsetLayout;
use OOUI\HorizontalLayout;
use OOUI\MultilineTextInputWidget;
use OOUI\Widget;
use SpecialPage;

/**
 * Special page for recording speech.
 *
 * Presents the user with a prompt to read and controls for recording,
 * reviewing and saving.
 *
 * @since 0.1.0
 */

class SpecialRecordSpeech extends SpecialPage {

	/**
	 * @since 0.1.0
	 */
	public function __construct() {
		parent::__construct( 'RecordSpeech' );
	}

	/**
	 * @since 0.1.0
	 * @param string|null $subpage
	 */
	public function execute( $subpage ) {
		$out = $this->getOutput();

		$out->addModuleStyles( [
			'ext.wikispeech-sdc.record-speech'
		] );
		$out->enableOOUI();
		$out->setPageTitle( $this->msg( 'recordspeech' ) );
		$this->addElements();
	}

	/**
	 * Add UI elements.
	 *
	 * @since 0.1.0
	 */
	private function addElements() {
		// Add a text box for the prompt.
		$promptField = new FieldLayout(
			new MultilineTextInputWidget( [
				'classes' => [
					'ext-wikispeech-sdc-record-speech-prompt',
				],
				'readOnly' => true,
				'rows' => 5
			] )
		);

		// Add buttons in a row.
		$buttons = [];
		// Start recording.
		$buttons[] = new FieldLayout(
			new ButtonWidget( [
				'label' => $this->msg( 'wikispeech-sdc-record' ),
				'flags' => [
					'primary',
					'progressive'
				]
			] )
		);
		// Listen to recording.
		$buttons[] = new FieldLayout(
			new ButtonWidget( [
				'label' => $this->msg( 'wikispeech-sdc-play' )
			] )
		);
		// Save recording to storage.
		$buttons[] = new FieldLayout(
			new ButtonWidget( [
				'label' => $this->msg( 'wikispeech-sdc-save' ),
				'flags' => [
					'progressive'
				]
			] )
		);
		// Skip the prompt without saving.
		$buttons[] = new FieldLayout(
			new ButtonWidget( [
				'label' => $this->msg( 'wikispeech-sdc-skip' ),
				'flags' => [ 'destructive' ]
			] )
		);
		$buttonField = new FieldLayout(
			new Widget( [
				'content' => new HorizontalLayout( [
					'items' => $buttons
				] )
			] )
		);

		$this->getOutput()->addHTML(
			new FieldsetLayout( [
				'items' => [
					$promptField,
					$buttonField
				]
			] )
		);
	}
}
