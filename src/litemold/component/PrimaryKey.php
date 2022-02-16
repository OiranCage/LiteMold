<?php


namespace litemold\component;


class PrimaryKey extends Column
{
	public bool $autoIncrement = false;

	public function __construct(Column $column) {
		parent::__construct($column->type);
		$this->default = $column->default;
		$this->nullable = $column->nullable;
	}

	public function autoIncrement(): self {
		$this->autoIncrement = true;
		return $this;
	}
}