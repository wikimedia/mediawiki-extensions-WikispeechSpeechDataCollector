<?php

namespace MediaWiki\WikispeechSpeechDataCollector\CRUD;

use MWException;
use Wikimedia\Rdbms\ILoadBalancer;

/**
 * Information required to access underlying data stores used by the various CRUD implementations.
 *
 * @package MediaWiki\WikispeechSpeechDataCollector\CRUD
 * @since 0.1.0
 */
class CRUDContext {

	/**
	 * @see AbstractRdbmsCRUD
	 * @var ILoadBalancer|null
	 */
	private $dbLoadBalancer;

	/**
	 * @param ILoadBalancer|null $dbLoadBalancer
	 * @since 0.1.0
	 */
	public function __construct(
		?ILoadBalancer $dbLoadBalancer
	) {
		$this->dbLoadBalancer = $dbLoadBalancer;
	}

	/**
	 * @return ILoadBalancer
	 * @throws MWException If db load balancer not available in context.
	 * @since 0.1.0
	 */
	public function getDbLoadBalancer(): ILoadBalancer {
		if ( $this->dbLoadBalancer === null ) {
			throw new MWException( 'Db load balancer not available in context!' );
		}
		return $this->dbLoadBalancer;
	}

}
