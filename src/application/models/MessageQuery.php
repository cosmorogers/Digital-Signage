<?php



/**
 * Skeleton subclass for performing query and update operations on the 'message' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class MessageQuery extends BaseMessageQuery
{
	public function filterFuture() {
		$this->filterByStart('now', '>');
		return $this;
	}

	public function filterCurrent() {
		$this->filterByStart('now', '<=')->filterByEnd('now', '>=');
		return $this;
	}

	public function filterPast() {
		$this->filterByEnd('now', '<');
		return $this;
	}

}
