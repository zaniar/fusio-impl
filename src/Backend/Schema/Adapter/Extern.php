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

namespace Fusio\Impl\Backend\Schema\Adapter;

use Fusio\Impl\Backend\Schema;
use PSX\Schema\Property;
use PSX\Schema\SchemaAbstract;

/**
 * Extern
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    http://fusio-project.org
 */
class Extern extends SchemaAbstract
{
    public function getDefinition()
    {
        $schema = $this->getSchema(Intern::class);

        $method = $schema->getProperty('routes')
            ->getItems()
            ->getProperty('config')
            ->getItems()
            ->getProperty('methods')
            ->getPatternProperty('^(GET|POST|PUT|PATCH|DELETE)$');

        $method->getProperty('parameters')
            ->setType('string');

        $method->getProperty('request')
            ->setType('string');

        $method->getProperty('response')
            ->setType('string');

        $method->getProperty('responses')
            ->getPatternProperty('^([0-9]{3})$')
            ->setType('string');

        $method->getProperty('action')
            ->setType('string');

        return $schema;
    }
}
