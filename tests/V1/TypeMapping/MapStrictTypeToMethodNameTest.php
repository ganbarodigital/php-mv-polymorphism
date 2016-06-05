<?php

/**
 * Copyright (c) 2015-present Ganbaro Digital Ltd
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Libraries
 * @package   Polymorphism/V1/TypeMapping
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://code.ganbarodigital.com/php-mv-polymorphism
 */

namespace GanbaroDigitalTest\Polymorphism\V1\TypeMapping;

use ArrayObject;
use stdClass;
use Traversable;
use GanbaroDigital\Polymorphism\V1\Interfaces\TypeMapper;
use GanbaroDigital\Polymorphism\V1\TypeMapping\MapStrictTypeToMethodName;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass GanbaroDigital\Polymorphism\V1\TypeMapping\MapStrictTypeToMethodName
 */
class MapStrictTypeToMethodNameTest extends PHPUnit_Framework_TestCase
{
    /**
     * @coversNothing
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(MapStrictTypeToMethodName::class, $unit);
    }

    /**
     * @coversNothing
     */
    public function test_is_TypeMapper()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(TypeMapper::class, $unit);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::using
     * @dataProvider provideDataToTest
     */
    public function testCanCallStatically($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = MapStrictTypeToMethodName::using($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideNullDataToTest
     */
    public function test_will_match_NULL($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideArrayDataToTest
     */
    public function test_can_match_array_as_array($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideCallableArrayDataToTest
     */
    public function test_can_match_array_as_callable($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideTrueDataToTest
     */
    public function test_can_match_true_as_boolean($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideFalseDataToTest
     */
    public function test_can_match_false_as_boolean($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideDoubleDataToTest
     */
    public function test_can_match_double_as_double($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideIntegerDataToTest
     */
    public function test_can_match_integer_as_integer($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideObjectsToTest
     */
    public function test_can_match_object_as_object($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideObjectsWithParentsDataToTest
     */
    public function test_can_match_object_as_parent($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideObjectsWithInterfacesDataToTest
     */
    public function test_can_match_object_as_interface($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideCallableObjectsToTest
     */
    public function test_can_match_object_as_callable($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideStringyObjectsToTest
     */
    public function test_can_match_object_as_string($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideResourcesToTest
     */
    public function test_can_match_resource($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideStringsToTest
     */
    public function test_can_match_string($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideCallableStringsToTest
     */
    public function test_can_match_string_as_callable($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideDoubleStringsToTest
     */
    public function test_can_match_string_as_double($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     * @dataProvider provideIntegerStringsToTest
     */
    public function test_can_match_string_as_integer($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($item, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     */
    public function test_returns_nothingMatchesTheInputType_when_no_match_found()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = true;
        $dispatchTable = [];
        $expectedResult = "nothingMatchesTheInputType";
        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($data, $dispatchTable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::__invoke
     * @covers ::using
     */
    public function test_can_change_the_default_fallback_when_no_match_found()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = true;
        $dispatchTable = [];
        $expectedResult = "nothingComparesToYou";
        $unit = new MapStrictTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($data, $dispatchTable, $expectedResult);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideNonObjectsToTest(),
            $this->provideObjectsToTest(),
            $this->provideNullDataToTest(),
            $this->provideArrayDataToTest(),
            $this->provideCallableArrayDataToTest(),
            $this->provideTrueDataToTest(),
            $this->provideFalseDataToTest(),
            $this->provideDoubleDataToTest(),
            $this->provideIntegerDataToTest(),
            $this->provideObjectsWithParentsDataToTest(),
            $this->provideObjectsWithInterfacesDataToTest(),
            $this->provideCallableObjectsToTest(),
            $this->provideStringyObjectsToTest(),
            $this->provideResourcesToTest(),
            $this->provideStringsToTest(),
            $this->provideCallableStringsToTest(),
            $this->provideDoubleStringsToTest(),
            $this->provideIntegerStringsToTest()
        );
    }

    public function provideNonObjectsToTest()
    {
        $dispatchTable = [
            "NULL" => "checkNull",
            "array" => "checkArray",
            "boolean" => "checkBoolean",
            "callable" => "checkCallable",
            "double" => "checkDouble",
            "integer" => "checkInteger",
            "string" => "checkString",
        ];

        return [
            [ null, $dispatchTable, "checkNull" ],
            [ [], $dispatchTable, "checkArray" ],
            [ true, $dispatchTable, "checkBoolean" ],
            [ false, $dispatchTable, "checkBoolean" ],
            [ "get_class", $dispatchTable, "checkCallable" ],
            [ [MapStrictTypeToMethodName::class, 'using'], $dispatchTable, "checkCallable" ],
            [ function(){}, $dispatchTable, "checkCallable" ],
            [ 0.0, $dispatchTable, "checkDouble" ],
            [ 3.1415927, $dispatchTable, "checkDouble" ],
            [ "0.0", $dispatchTable, "checkDouble" ],
            [ "3.1415927", $dispatchTable, "checkDouble" ],
            [ 0, $dispatchTable, "checkInteger" ],
            [ 100, $dispatchTable, "checkInteger" ],
            [ -100, $dispatchTable, "checkInteger" ],
            [ "0", $dispatchTable, "checkInteger" ],
            [ "100", $dispatchTable, "checkInteger" ],
            [ "-100", $dispatchTable, "checkInteger" ],
            [ "hello, world!", $dispatchTable, "checkString" ],
        ];
    }

    public function provideNullDataToTest()
    {
        $dispatchTable = [
            'NULL' => 'checkNull'
        ];

        return [
            [ null, $dispatchTable, "checkNull" ],
        ];
    }

    public function provideArrayDataToTest()
    {
        $dispatchTable = [
            'callable' => 'checkCallable',
            'array' => 'checkArray'
        ];

        return [
            [ [], $dispatchTable, "checkArray" ],
        ];
    }

    public function provideCallableArrayDataToTest()
    {
        $dispatchTable = [
            'array' => 'checkArray',
            'callable' => 'checkCallable'
        ];

        return [
            [ [ MapStrictTypeToMethodName::class, "using" ], $dispatchTable, "checkCallable" ],
        ];
    }

    public function provideTrueDataToTest()
    {
        $dispatchTable = [
            'boolean' => 'checkBoolean'
        ];

        return [
            [ true, $dispatchTable, "checkBoolean" ],
        ];
    }

    public function provideFalseDataToTest()
    {
        $dispatchTable = [
            'boolean' => 'checkBoolean'
        ];

        return [
            [ false, $dispatchTable, "checkBoolean" ],
        ];
    }

    public function provideDoubleDataToTest()
    {
        $dispatchTable = [
            'double' => 'checkDouble'
        ];

        return [
            [ 0.0, $dispatchTable, "checkDouble" ],
            [ 3.1415927, $dispatchTable, "checkDouble" ],
            [ -1000.0, $dispatchTable, "checkDouble" ],
        ];
    }

    public function provideIntegerDataToTest()
    {
        $dispatchTable = [
            'integer' => 'checkInteger'
        ];

        return [
            [ 0, $dispatchTable, "checkInteger" ],
            [ 100, $dispatchTable, "checkInteger" ],
            [ -100, $dispatchTable, "checkInteger" ],
        ];
    }

    public function provideObjectsWithParentsDataToTest()
    {
        $dispatchTable = [
            'ArrayObject' => 'checkArrayObject'
        ];

        return [
            [ new MapStrictTypeToMethodNameTest_ParentTarget, $dispatchTable, "checkArrayObject" ],
        ];
    }

    public function provideObjectsWithInterfacesDataToTest()
    {
        $dispatchTable = [
            TypeMapper::class => 'checkTypeMapper'
        ];

        return [
            [ new MapStrictTypeToMethodName, $dispatchTable, "checkTypeMapper" ],
        ];
    }

    public function provideObjectsToTest()
    {
        $dispatchTable = [
            ArrayAccess::class => 'checkIndexable',
            'callable' => 'checkCallable',
            stdClass::class => 'checkStdClass',
            'string' => 'checkString',
            Traversable::class => 'checkTraversable',
        ];

        return [
            // proves that we can match an object's interface
            [ new ArrayObject, $dispatchTable, 'checkTraversable' ],
            // prove that we can match an explicit object
            [ new stdClass, $dispatchTable, 'checkStdClass' ],
            // prove that we can match an invokable object
            [ new MapStrictTypeToMethodName, $dispatchTable, 'checkCallable' ],
            // prove that we can match a coercable string
            [ new MapStrictTypeToMethodNameTest_StringTarget, $dispatchTable, 'checkString' ],
        ];
    }

    public function provideCallableObjectsToTest()
    {
        $dispatchTable = [
            'callable' => 'checkCallable',
        ];

        return [
            // prove that we can match an invokable object
            [ new MapStrictTypeToMethodName, $dispatchTable, 'checkCallable' ],
        ];
    }

    public function provideStringyObjectsToTest()
    {
        $dispatchTable = [
            'string' => 'checkString',
        ];

        return [
            [ new MapStrictTypeToMethodNameTest_StringTarget, $dispatchTable, 'checkString' ],
        ];
    }

    public function provideResourcesToTest()
    {
        $dispatchTable = [
            'resource' => 'checkResource',
        ];

        return [
            [ STDIN, $dispatchTable, 'checkResource' ],
        ];
    }

    public function provideStringsToTest()
    {
        $dispatchTable = [
            'string' => 'checkString',
        ];

        return [
            [ "hello, world", $dispatchTable, 'checkString' ],
        ];
    }

    public function provideCallableStringsToTest()
    {
        $dispatchTable = [
            'callable' => 'checkCallable',
            'string' => 'checkString',
        ];

        return [
            [ 'gettype', $dispatchTable, 'checkCallable' ],
        ];
    }

    public function provideDoubleStringsToTest()
    {
        $dispatchTable = [
            'double' => 'checkDouble',
            'string' => 'checkString',
        ];

        return [
            [ '0.0', $dispatchTable, 'checkDouble' ],
        ];
    }

    public function provideIntegerStringsToTest()
    {
        $dispatchTable = [
            'integer' => 'checkInteger',
            'string' => 'checkString',
        ];

        return [
            [ '100', $dispatchTable, 'checkInteger' ],
        ];
    }
}

class MapStrictTypeToMethodNameTest_ParentTarget extends ArrayObject
{

}

class MapStrictTypeToMethodNameTest_StringTarget
{
    public function __toString()
    {
        return '';
    }
}
