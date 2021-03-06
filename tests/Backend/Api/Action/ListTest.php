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

namespace Fusio\Impl\Tests\Backend\Api\Action;

use Fusio\Impl\Tests\Fixture;
use PSX\Framework\Test\ControllerDbTestCase;

/**
 * ListTest
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    http://fusio-project.org
 */
class ListTest extends ControllerDbTestCase
{
    public function getDataSet()
    {
        return Fixture::getDataSet();
    }

    public function testDocumentation()
    {
        $response = $this->sendRequest('/doc/*/backend/action/list', 'GET', array(
            'User-Agent'    => 'Fusio TestCase',
            'Authorization' => 'Bearer da250526d583edabca8ac2f99e37ee39aa02a3c076c0edc6929095e20ca18dcf'
        ));

        $actual = (string) $response->getBody();
        $expect = <<<'JSON'
{
    "path": "\/backend\/action\/list",
    "version": "*",
    "status": 1,
    "description": "",
    "schema": {
        "$schema": "http:\/\/json-schema.org\/draft-04\/schema#",
        "id": "urn:schema.phpsx.org#",
        "definitions": {
            "Action": {
                "type": "object",
                "title": "action",
                "properties": {
                    "name": {
                        "type": "string"
                    },
                    "class": {
                        "type": "string"
                    }
                }
            },
            "Index": {
                "type": "object",
                "title": "index",
                "properties": {
                    "actions": {
                        "type": "array",
                        "items": {
                            "$ref": "#\/definitions\/Action"
                        }
                    }
                }
            },
            "GET-200-response": {
                "$ref": "#\/definitions\/Index"
            }
        }
    },
    "methods": {
        "GET": {
            "responses": {
                "200": "#\/definitions\/GET-200-response"
            }
        }
    },
    "links": [
        {
            "rel": "openapi",
            "href": "\/export\/openapi\/*\/backend\/action\/list"
        },
        {
            "rel": "swagger",
            "href": "\/export\/swagger\/*\/backend\/action\/list"
        },
        {
            "rel": "raml",
            "href": "\/export\/raml\/*\/backend\/action\/list"
        }
    ]
}
JSON;

        $this->assertJsonStringEqualsJsonString($expect, $actual, $actual);
    }

    public function testGet()
    {
        $response = $this->sendRequest('/backend/action/list', 'GET', array(
            'User-Agent'    => 'Fusio TestCase',
            'Authorization' => 'Bearer da250526d583edabca8ac2f99e37ee39aa02a3c076c0edc6929095e20ca18dcf'
        ));

        $body   = (string) $response->getBody();
        $expect = <<<'JSON'
{
    "actions": [
        {
            "name": "File-Processor",
            "class": "Fusio\\Adapter\\File\\Action\\FileProcessor"
        },
        {
            "name": "HTTP-Processor",
            "class": "Fusio\\Adapter\\Http\\Action\\HttpProcessor"
        },
        {
            "name": "PHP-Processor",
            "class": "Fusio\\Adapter\\Php\\Action\\PhpProcessor"
        },
        {
            "name": "SQL-Table",
            "class": "Fusio\\Adapter\\Sql\\Action\\SqlTable"
        },
        {
            "name": "Util-Static-Response",
            "class": "Fusio\\Adapter\\Util\\Action\\UtilStaticResponse"
        },
        {
            "name": "V8-Processor",
            "class": "Fusio\\Adapter\\V8\\Action\\V8Processor"
        }
    ]
}
JSON;

        $this->assertEquals(200, $response->getStatusCode(), $body);
        $this->assertJsonStringEqualsJsonString($expect, $body, $body);
    }
}
