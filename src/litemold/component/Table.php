<?php


namespace litemold\component;


class Table
{
	public function text(): Column {
		return Column::with("TEXT");
	}

	public function varchar(int $length): Column {
		return Column::with("VARCHAR($length)");
	}

	public function int(): Column {
		return Column::with("INTEGER");
	}

	public function real(): Column {
		return Column::with("REAL");
	}

	public function bool(): Column {
		return Column::with("BOOLEAN");
	}
}