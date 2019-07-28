<?php

/**
 * Copyright (C) 2019 Spencer Mortensen
 *
 * This file is part of Archiver.
 *
 * Archiver is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Archiver is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Archiver. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Spencer Mortensen <spencer@lens.guide>
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL-3.0
 * @copyright 2019 Spencer Mortensen
 */

namespace SpencerMortensen\Archiver;

use SpencerMortensen\Archiver\Entities\ObjectArchive;
use SpencerMortensen\Archiver\Entities\ResourceArchive;
use ReflectionClass;

class Archiver
{
	private $archivedObjects;
	private $archivedObjectIds;

	public function __construct()
	{
		// The function 'spl_object_hash' returns a value which is guaranteed
		// to be unique, but only so long as the object persists in memory.
		// So we hold the object in memory, here, to guarantee uniqueness:
		$this->archivedObjects = [];
		$this->archivedObjectIds = [];
		$this->archivedResourceIds = [];
	}

	public function archive($value)
	{
		if (is_object($value)) {
			return $this->getObject($value);
		}

		if (is_array($value)) {
			return $this->getArray($value);
		}

		if (is_resource($value)) {
			return $this->getResource($value);
		}

		return $value;
	}

	private function getObject($object): ObjectArchive
	{
		$hash = spl_object_hash($object);
		$archivedObject = &$this->archivedObjects[$hash];

		if (!isset($archivedObject)) {
			$id = $this->getId($this->archivedObjectIds, $hash);
			$class = get_class($object);

			$archivedObject = new ObjectArchive($id, $class);

			$properties = $this->getObjectProperties($object);
			$archivedObject->setProperties($properties);
		}

		return $archivedObject;
	}

	private function getObjectProperties($object): array
	{
		$archive = [];

		$class = new ReflectionClass($object);

		do {
			$className = $class->getName();
			$archivedProperties = &$archive[$className];
			$archivedProperties = [];

			foreach ($class->getProperties() as $property) {
				$property->setAccessible(true);
				$propertyName = $property->getName();
				$propertyValue = $property->getValue($object);

				$archivedProperties[$propertyName] = $this->archive($propertyValue);
			}

			$class = $class->getParentClass();
		} while ($class !== false);

		return $archive;
	}

	private function getArray(array $array): array
	{
		$output = [];

		foreach ($array as $key => $value) {
			$output[$key] = $this->archive($value);
		}

		return $output;
	}

	private function getResource($resource): ResourceArchive
	{
		$index = (integer)$resource;
		$id = $this->getId($this->archivedResourceIds, $index);
		$type = get_resource_type($resource);

		return new ResourceArchive($id, $type);
	}

	private function getId(array &$ids, $name)
	{
		$id = &$ids[$name];

		if ($id === null) {
			$id = count($ids) - 1;
		}

		return $id;
	}
}
