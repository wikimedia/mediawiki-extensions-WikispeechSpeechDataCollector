<?php

namespace MediaWiki\WikispeechSpeechDataCollector\Crud\Rdbms;

/**
 * @file
 * @ingroup Extensions
 * @license GPL-2.0-or-later
 */

use MediaWiki\WikispeechSpeechDataCollector\Domain\ManuscriptDomain;
use MediaWiki\WikispeechSpeechDataCollector\Domain\Persistent;

/**
 * @since 0.1.0
 */
class ManuscriptDomainCrud extends AbstractUuidRdbmsCrud {

	/** @var string Name of table in database. */
	public const TABLE = self::TABLES_PREFIX . 'manuscript_domain';

	/**
	 * @return string Name of database table representing this class.
	 */
	protected function getTable(): string {
		return self::TABLE;
	}

	private const CLASS_COLUMNS_PREFIX = self::COLUMNS_PREFIX . 'md_';

	/**
	 * @return string COLUMNS_PREFIX . 'class prefix' . '_'
	 */
	protected function getClassColumnsPrefix(): string {
		return self::CLASS_COLUMNS_PREFIX;
	}

	private const COLUMN_NAME = self::CLASS_COLUMNS_PREFIX . 'name';
	private const COLUMN_PARENT = self::CLASS_COLUMNS_PREFIX . 'parent';

	/**
	 * @return string[] Columns in table required to deserialize an instance, identity excluded.
	 */
	protected function getColumns(): array {
		return [
			self::COLUMN_NAME,
			self::COLUMN_PARENT
		];
	}

	public function instanceFactory(): Persistent {
		return new ManuscriptDomain();
	}

	/**
	 * @param ManuscriptDomain $instance
	 * @param array $row
	 */
	protected function deserializeRow(
		$instance,
		array $row
	): void {
		$instance->setName( $this->deserializeString( $row, self::COLUMN_NAME ) );
		$instance->setParent( $this->deserializeUuid( $row, self::COLUMN_PARENT ) );
	}

	/**
	 * @param ManuscriptDomain $instance
	 * @return array
	 */
	protected function serializeFields(
		$instance
	): array {
		$array = [];
		$array[ self::COLUMN_NAME ] = $instance->getName();
		$array[ self::COLUMN_PARENT ] = $instance->getParent();
		return $array;
	}

	/**
	 * @param string $parent
	 * @return ManuscriptDomain[]|null
	 */
	public function listByParent(
		string $parent
	): ?array {
		// @phan-suppress-next-line PhanTypeMismatchReturn
		return $this->listByConditions( [
			self::COLUMN_PARENT => $parent
		] );
	}
}
