<?php


namespace litemold;


use litemold\component\PrimaryKey;
use litemold\component\Query;
use litemold\component\Table;
use litemold\component\Undefined;
use ReflectionClass;

class TableDTO
{
	// TODO; プリペアドステートメントに対応する。
	public static function decode(Table $table): string {
		$reflection = new ReflectionClass($table);
		$properties = $reflection->getProperties();

		$query = new Query();
		$query->addStatement("CREATE TABLE IF NOT EXISTS ".strtolower($reflection->getShortName())." (");

		foreach($properties as $property) {
			$property->setAccessible(true);
			$name = $property->getName();
			$value = $property->getValue($table);

			$query->addStatement("$name ".$value->type);
			if(!$value->nullable) {
				$query->addStatement(" NOT NULL");
			}

			if($value instanceof PrimaryKey){
				$query->addStatement(" PRIMARY KEY");
				if($value->autoIncrement) {
					$query->addStatement(" AUTOINCREMENT");
				}
			} else {
				if(!($value->default instanceof Undefined)) {
					$query->addStatement(" DEFAULT :$name");
					$query->addBind(":$name", $value->default);
				}
			}

			$query->addStatement(", ");
		}

		$query->statement = substr($query->statement, 0, -2);
		$query->addStatement(");");

		return $query->getStatement();
	}
}