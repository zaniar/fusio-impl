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

namespace Fusio\Impl\Backend\Schema\Account;

use PSX\Schema\SchemaAbstract;

/**
 * ChangePassword
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    http://fusio-project.org
 */
class ChangePassword extends SchemaAbstract
{
    public function getDefinition()
    {
        $sb = $this->getSchemaBuilder('credentials');
        $sb->setRequired(['oldPassword', 'newPassword', 'verifyPassword']);
        $sb->string('oldPassword')
            ->setMinLength(8)
            ->setMaxLength(128);
        $sb->string('newPassword')
            ->setMinLength(8)
            ->setMaxLength(128);
        $sb->string('verifyPassword')
            ->setMinLength(8)
            ->setMaxLength(128);

        return $sb->getProperty();
    }
}
