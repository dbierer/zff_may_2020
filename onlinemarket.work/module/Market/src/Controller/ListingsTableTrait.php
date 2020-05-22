<?php
declare(strict_types=1);
namespace Market\Controller;
use Model\Table\ListingsTable;
trait ListingsTableTrait
{
	protected $table;
	public function setTable(ListingsTable $table)
	{
		$this->table = $table;
	}
}
