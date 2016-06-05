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
 * @package   Polymorphism/V1/DispatchTables
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://code.ganbarodigital.com/php-mv-polymorphism
 */

namespace GanbaroDigitalTest\Polymorphism\V1\DispatchTables;

use ArrayObject;
use GanbaroDigital\Polymorphism\V1\DispatchTables\ObjectsOnlyDispatchTable;
use GanbaroDigital\Polymorphism\V1\Interfaces\DispatchTable;
use GanbaroDigital\Polymorphism\V1\Interfaces\TypeMapper;
use GanbaroDigital\Polymorphism\V1\TypeMapping\MapDuckTypeToMethodName;
use GanbaroDigital\UnitTestHelpers\V1\ClassesAndObjects\GetProperty;
use GanbaroDigital\UnitTestHelpers\V1\ClassesAndObjects\SetProperty;
use PHPUnit_Framework_TestCase;
use stdClass;
use Traversable;

/**
 * @coversDefaultClass GanbaroDigital\Polymorphism\V1\DispatchTables\ObjectsOnlyDispatchTable
 */
class ObjectsOnlyDispatchTableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        $dispatchTable = [];
        $typeMapper = new MapDuckTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new ObjectsOnlyDispatchTable($dispatchTable, $typeMapper);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(ObjectsOnlyDispatchTable::class, $unit);
    }

    /**
     * @covers ::__construct
     */
    public function test_is_DispatchTable()
    {
        // ----------------------------------------------------------------
        // setup your test

        $dispatchTable = [];
        $typeMapper = new MapDuckTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new ObjectsOnlyDispatchTable($dispatchTable, $typeMapper);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(DispatchTable::class, $unit);
    }

    /**
     * @covers ::__construct
     */
    public function test_starts_with_empty_cache()
    {
        // ----------------------------------------------------------------
        // setup your test

        $dispatchTable = [];
        $typeMapper = new MapDuckTypeToMethodName;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new ObjectsOnlyDispatchTable($dispatchTable, $typeMapper);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals([], GetProperty::fromObject($unit, 'dispatchCache'));
    }

    /**
     * @covers ::__construct
     */
    public function test_each_instance_has_separate_cache()
    {
        // ----------------------------------------------------------------
        // setup your test

        $dispatchTable = [];
        $typeMapper = new MapDuckTypeToMethodName;

        $unit1 = new ObjectsOnlyDispatchTable($dispatchTable, $typeMapper);
        $unit2 = new ObjectsOnlyDispatchTable($dispatchTable, $typeMapper);

        // ----------------------------------------------------------------
        // perform the change

        $unit1->mapTypeToMethodName(new stdClass);
        $unit2->mapTypeToMethodName(new ArrayObject);

        $actualCache1 = GetProperty::fromObject($unit1, 'dispatchCache');
        $actualCache2 = GetProperty::fromObject($unit2, 'dispatchCache');

        // ----------------------------------------------------------------
        // test the results

        $this->assertNotEquals($actualCache1, $actualCache2);
    }

    /**
     * @covers ::mapTypeToMethodName
     * @dataProvider provideObjectsToTest
     */
    public function test_object_gets_cached($item, $dispatchTable, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $typeMapper = new MapDuckTypeToMethodName;
        $unit = new ObjectsOnlyDispatchTable($dispatchTable, $typeMapper);

        $expectedCache = [
            get_class($item) => $expectedResult
        ];

        // ----------------------------------------------------------------
        // perform the change

        $unit->mapTypeToMethodName($item);
        $actualCache = GetProperty::fromObject($unit, 'dispatchCache');

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedCache, $actualCache);
    }

    /**
     * @covers ::mapTypeToMethodName
     */
    public function test_will_check_the_cache_first()
    {
        // ----------------------------------------------------------------
        // setup your test
        //
        // how this test works:
        //
        // step 1 - use the dispatch table as normal to seed the cache
        // step 2 - replace the type mapper with something that will throw
        //          an exception if it is called
        // step 3 - repeat step 1. this time, the seeded cache will contain
        //          a match
        //
        // our erroring type mapper will only be called if the dispatch table
        // is not checking the cache

        // create our dispatch table object
        $dispatchTable = [
            'object' => 'checkObject',
        ];
        $typeMapper = new MapDuckTypeToMethodName;
        $unit = new ObjectsOnlyDispatchTable($dispatchTable, $typeMapper);

        // make sure the type mapper is where we expect it
        $origTypeMapper = GetProperty::fromObject($unit, 'typeMapper');
        $this->assertEquals($typeMapper, $origTypeMapper);

        // ----------------------------------------------------------------
        // perform the change

        // step 1: seed the cache
        $unit->mapTypeToMethodName(new stdClass);

        // step 2: replace the type mapper
        SetProperty::inObject($unit, 'typeMapper', new ObjectsOnlyDispatchTableTest_BadTypeMapper);
        $badTypeMapper = GetProperty::fromObject($unit, 'typeMapper');
        $this->assertNotEquals($typeMapper, $badTypeMapper);

        // step 3: repeat step 1
        $unit->mapTypeToMethodName(new stdClass);

        // ----------------------------------------------------------------
        // test the results

        // if we get here and there is no exception, all is good
    }

    /**
     * @covers ::mapTypeToMethodName
     */
    public function test_returns_nothingMatchesTheInputType_when_no_match_found()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = new stdClass;
        $dispatchTable = [];
        $expectedResult = "nothingMatchesTheInputType";
        $typeMapper = new MapDuckTypeToMethodName;
        $unit = new ObjectsOnlyDispatchTable($dispatchTable, $typeMapper);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->mapTypeToMethodName($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::mapTypeToMethodName
     */
    public function test_can_change_the_default_fallback_when_no_match_found()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = new stdClass;
        $dispatchTable = [];
        $expectedResult = "nothingComparesToYou";
        $typeMapper = new MapDuckTypeToMethodName;
        $unit = new ObjectsOnlyDispatchTable($dispatchTable, $typeMapper, $expectedResult);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->mapTypeToMethodName($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideObjectsToTest(),
            $this->provideObjectsWithParentsDataToTest(),
            $this->provideObjectsWithInterfacesDataToTest(),
            $this->provideCallableObjectsToTest(),
            $this->provideStringyObjectsToTest()
        );
    }

    public function provideObjectsWithParentsDataToTest()
    {
        $dispatchTable = [
            'ArrayObject' => 'checkArrayObject'
        ];

        return [
            [ new ObjectsOnlyDispatchTableTest_ParentTarget, $dispatchTable, "checkArrayObject" ],
        ];
    }

    public function provideObjectsWithInterfacesDataToTest()
    {
        $dispatchTable = [
            TypeMapper::class => 'checkTypeMapper'
        ];

        return [
            [ new MapDuckTypeToMethodName, $dispatchTable, "checkTypeMapper" ],
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
            [ new MapDuckTypeToMethodName, $dispatchTable, 'checkCallable' ],
            // prove that we can match a coercable string
            [ new ObjectsOnlyDispatchTableTest_StringTarget, $dispatchTable, 'checkString' ],
        ];
    }

    public function provideCallableObjectsToTest()
    {
        $dispatchTable = [
            'callable' => 'checkCallable',
        ];

        return [
            // prove that we can match an invokable object
            [ new MapDuckTypeToMethodName, $dispatchTable, 'checkCallable' ],
        ];
    }

    public function provideStringyObjectsToTest()
    {
        $dispatchTable = [
            'string' => 'checkString',
        ];

        return [
            [ new ObjectsOnlyDispatchTableTest_StringTarget, $dispatchTable, 'checkString' ],
        ];
    }
}

class ObjectsOnlyDispatchTableTest_ParentTarget extends ArrayObject
{

}

class ObjectsOnlyDispatchTableTest_StringTarget
{
    public function __toString()
    {
        return '';
    }
}

class ObjectsOnlyDispatchTableTest_BadTypeMapper implements TypeMapper
{
    public function __invoke($item, array $dispatchTable, $fallback = TypeMapper::FALLBACK_RESULT)
    {
        return self::using($item, $dispatchTable, $fallback);
    }

     public static function using($item, array $dispatchTable, $fallback = TypeMapper::FALLBACK_RESULT)
     {
         throw new \RuntimeException("cache has not been checked!!");
     }
}
