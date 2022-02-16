<?php


namespace litemold\component;


class Query
{
	public array $bindQueue = [];
	public string $statement = "";

	public function __construct() {}

	public function addBind(string $key, mixed $value) {
		$this->bindQueue[$key] = $value;
	}

	public function addStatement(string $statement) {
		$this->statement .= $statement;
	}
}