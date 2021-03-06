<?php
/*
 * Fusio
 * A web-application to create dynamically RESTful APIs
 *
 * Copyright (C) 2015-2017 Christoph Kappestein <christoph.kappestein@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Fusio\Impl\Backend\Schema;

use PSX\Schema\Property;
use PSX\Schema\SchemaAbstract;

/**
 * User
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    http://fusio-project.org
 */
class User extends SchemaAbstract
{
    const NAME_PATTERN = '[a-zA-Z0-9\-\_\.]{3,32}';

    public function getDefinition()
    {
        $sb = $this->getSchemaBuilder('user');
        $sb->integer('id');
        $sb->integer('status');
        $sb->string('name')
            ->setPattern(self::NAME_PATTERN);
        $sb->string('email');
        $sb->arrayType('scopes')
            ->setItems(Property::getString());
        $sb->arrayType('apps')
            ->setItems($this->getSchema(App::class));
        $sb->dateTime('date');

        return $sb->getProperty();
    }
}
