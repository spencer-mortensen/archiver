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

namespace SpencerMortensen\Archiver\Entities;

class ObjectArchive
{
	private $id;
	private $class;
	private $properties;

	public function __construct(string $id, string $class, array $properties = null)
	{
		$this->id = $id;
		$this->class = $class;
		$this->properties = $properties;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getClass()
	{
		return $this->class;
	}

	public function setProperties(array $properties)
	{
		return $this->properties = $properties;
	}

	public function getProperties()
	{
		return $this->properties;
	}
}
