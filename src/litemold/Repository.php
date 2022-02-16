<?php


namespace litemold;


use litemold\component\Table;
use PDO;

abstract class Repository
{
	protected static PDO $pdo;

	final public static function init(PDO $pdo, Table $table) {
		self::$pdo = $pdo;
		$pdo->exec(TableDTO::decode($table));
	}
}