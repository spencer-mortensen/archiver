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

class ResourceArchive
{
	private $id;
	private $type;

	public function __construct(int $id, string $type)
	{
		$this->id = $id;
		$this->type = $type;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getType(): string
	{
		return $this->type;
	}
}
