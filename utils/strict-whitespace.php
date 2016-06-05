<?php

declare(strict_types=1);

use GanbaroDigital\Polymorphism\V1\DispatchTables\AllPurposeDispatchTable;
use GanbaroDigital\Polymorphism\V1\DispatchTables\TypeOnlyDispatchTable;
use GanbaroDigital\Polymorphism\V1\TypeMapping\MapStrictTypeToMethodName;

class TrimWhitespace
{
    // this changes from an array to an object
    // the object is created by calling ::initDispatchTable()
    private static $dispatchTable;

    public static function initDispatchTable()
    {
        // create our dispatch table object
        self::$dispatchTable = new TypeOnlyDispatchTable(
            [
                'array' => 'trimFromArray',
                'Traversable' => 'trimFromTraversable',
                'string' => 'trimFromString'
            ],
            new MapStrictTypeToMethodName
        );
    }

    // this is substantially changed from our previous example
    public static function from($item)
    {
        // instead of calling MapStrictTypeToMethod directly, we let our new
        // DispatchTable do it for us
        //
        // it will only call MapStrictTypeToMethod if it has no cached
        // result for $item
        $method = self::$dispatchTable->mapTypeToMethodName($item);
        //$method = 'trimFromString';

        // this is the same as our earlier example
        return self::$method($item);
    }

    // same as our first example
    private static function trimFromArray(array $item) : array
    {
        $retval = [];
        foreach ($item as $key => $value) {
            $retval[$key] = self::from($value);
        }
        return $retval;
    }

    // same as our first example
    private static function trimFromTraversable(Traversable $item) : array
    {
        $retval = [];
        foreach ($item as $key => $value) {
            $retval[$key] = self::from($value);
        }
        return $retval;
    }

    // same as our first example
    public static function trimFromString(string $item) : string
    {
        // PHP will coerce into a string for us
        return trim($item);
    }

    // same as our first example
    private static function nothingMatchesTheInputType($item)
    {
        // we don't know how to process $item, so let's just
        // send back exactly what we received
        return $item;
    }
}

// only happens when we're first loaded
TrimWhitespace::initDispatchTable();
