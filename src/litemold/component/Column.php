<?php


namespace litemold\component;


class Column
{
	public mixed $default;
	public bool $nullable = false;

	public function __construct(public string $type) {
		$this->default = new Undefined();
	}

	public function nullable(): self {
		$this->nullable = true;
		return $this;
	}

	public function default(mixed $value): self {
		$this->default = $value;
		return $this;
	}

	public static function with(string $type): Column {
		return new Column($type);
	}

	public function primaryKey(): PrimaryKey {
		return new PrimaryKey($this);
	}
}