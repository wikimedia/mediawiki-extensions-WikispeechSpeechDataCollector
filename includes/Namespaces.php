<?php

namespace MediaWiki\WikispeechSpeechDataCollector;

/*
 * Namespace constants defined in extension.json
 * This is really just to avoid problems with Phan and code editors.
 */
if ( !defined( 'NS_SPEECH_RECORDING' ) ) {
	define( 'NS_SPEECH_RECORDING', 5770 );
	define( 'NS_SPEECH_RECORDING_TALK', 5771 );
}
