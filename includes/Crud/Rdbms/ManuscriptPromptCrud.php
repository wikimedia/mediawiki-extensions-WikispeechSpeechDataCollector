<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Crud\Rdbms;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptPrompt;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;

/**
 * @since 0.1.0
 */
class ManuscriptPromptCrud extends AbstractUuidRdbmsCrud {

	/** @var string Name of table in database. */
	public const TABLE = self::TABLES_PREFIX . 'manuscript_prompt';

	/**
	 * @return string Name of database table representing this class.
	 */
	protected function getTable(): string {
		return self::TABLE;
	}

	private const CLASS_COLUMNS_PREFIX = self::COLUMNS_PREFIX . 'mp_';

	/**
	 * @return string COLUMNS_PREFIX . 'class prefix' . '_'
	 */
	protected function getClassColumnsPrefix(): string {
		return self::CLASS_COLUMNS_PREFIX;
	}

	private const COLUMN_MANUSCRIPT = self::CLASS_COLUMNS_PREFIX . 'manuscript';
	private const COLUMN_INDEX = self::CLASS_COLUMNS_PREFIX . 'index';
	private const COLUMN_CONTENT = self::CLASS_COLUMNS_PREFIX . 'content';

	/**
	 * @return string[] Columns in table required to deserialize an instance, identity excluded.
	 */
	protected function getColumns(): array {
		return [
			self::COLUMN_MANUSCRIPT,
			self::COLUMN_INDEX,
			self::COLUMN_CONTENT
		];
	}

	public function instanceFactory(): Persistent {
		return new ManuscriptPrompt();
	}

	/**
	 * @param ManuscriptPrompt $instance
	 * @param array $row
	 */
	protected function deserializeRow(
		$instance,
		array $row
	): void {
		$instance->setManuscript( $this->deserializeUuid( $row, self::COLUMN_MANUSCRIPT ) );
		$instance->setIndex( $this->deserializeInt( $row, self::COLUMN_INDEX ) );
		$instance->setContent( $this->deserializeString( $row, self::COLUMN_CONTENT ) );
	}

	/**
	 * @param ManuscriptPrompt $instance
	 * @return array
	 */
	protected function serializeFields(
		$instance
	): array {
		$array = [];
		$array[ self::COLUMN_MANUSCRIPT ] = $instance->getManuscript();
		$array[ self::COLUMN_INDEX ] = $instance->getIndex();
		$array[ self::COLUMN_CONTENT ] = $instance->getContent();
		return $array;
	}

	/**
	 * @param string $manuscript
	 * @return ManuscriptPrompt[]|null
	 */
	public function listByManuscript(
		string $manuscript
	): ?array {
		// @phan-suppress-next-line PhanTypeMismatchReturn
		return $this->listByConditions( [
			self::COLUMN_MANUSCRIPT => $manuscript
		] );
	}

	/**
	 * @param string $manuscript
	 * @param int $index
	 * @return ManuscriptPrompt|null
	 */
	public function getByManuscriptAndIndex(
		string $manuscript,
		int $index
	): ?Persistent {
		// @phan-suppress-next-line PhanTypeMismatchReturnSuperType
		return $this->getByConditions( [
			self::COLUMN_MANUSCRIPT => $manuscript,
			self::COLUMN_INDEX => $index
		] );
	}

}
