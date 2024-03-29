<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Crud\Rdbms;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;
use MediaWiki\WikispeechSpeechDataCollector\Domain\UserLanguageProficiencyLevel;

/**
 * @since 0.1.0
 */
class UserLanguageProficiencyLevelCrud extends AbstractUuidRdbmsCrud {

	/** @var string Name of table in database. */
	public const TABLE = self::TABLES_PREFIX . 'user_language_proficiency_level';

	/**
	 * @return string Name of database table representing this class.
	 */
	protected function getTable(): string {
		return self::TABLE;
	}

	private const CLASS_COLUMNS_PREFIX = self::COLUMNS_PREFIX . 'ulpl_';

	/**
	 * @return string COLUMNS_PREFIX . 'class prefix' . '_'
	 */
	protected function getClassColumnsPrefix(): string {
		return self::CLASS_COLUMNS_PREFIX;
	}

	private const COLUMN_USER = self::CLASS_COLUMNS_PREFIX . 'user';
	private const COLUMN_LANGUAGE = self::CLASS_COLUMNS_PREFIX . 'language';
	private const COLUMN_PROFICIENCY_LEVEL = self::CLASS_COLUMNS_PREFIX . 'proficiency_level';

	/**
	 * @return string[] Columns in table required to deserialize an instance, identity excluded.
	 */
	protected function getColumns(): array {
		return [
			self::COLUMN_USER,
			self::COLUMN_LANGUAGE,
			self::COLUMN_PROFICIENCY_LEVEL,
		];
	}

	public function instanceFactory(): Persistent {
		return new UserLanguageProficiencyLevel();
	}

	/**
	 * @param UserLanguageProficiencyLevel $instance
	 * @param array $row
	 */
	protected function deserializeRow(
		$instance,
		array $row
	): void {
		$instance->setUser( $this->deserializeUuid( $row, self::COLUMN_USER ) );
		$instance->setLanguage( $this->deserializeUuid( $row, self::COLUMN_LANGUAGE ) );
		$instance->setProficiencyLevel( $this->deserializeInt( $row, self::COLUMN_PROFICIENCY_LEVEL ) );
	}

	/**
	 * @param UserLanguageProficiencyLevel $instance
	 * @return array
	 */
	protected function serializeFields(
		$instance
	): array {
		$array = [];
		$array[ self::COLUMN_USER ] = $instance->getUser();
		$array[ self::COLUMN_LANGUAGE ] = $instance->getLanguage();
		$array[ self::COLUMN_PROFICIENCY_LEVEL ] = $instance->getProficiencyLevel();
		return $array;
	}

	/**
	 * @param string $user
	 * @return UserLanguageProficiencyLevel[]|null
	 */
	public function listByUser(
		string $user
	): ?array {
		// @phan-suppress-next-line PhanTypeMismatchReturn
		return $this->listByConditions( [
			self::COLUMN_USER => $user
		] );
	}

	/**
	 * @param string $user
	 * @param string $language
	 * @return UserLanguageProficiencyLevel|null
	 */
	public function getByUserAndLanguage(
		string $user,
		string $language
	): ?Persistent {
		// @phan-suppress-next-line PhanTypeMismatchReturnSuperType
		return $this->getByConditions( [
			self::COLUMN_USER => $user,
			self::COLUMN_LANGUAGE => $language
		] );
	}
}
