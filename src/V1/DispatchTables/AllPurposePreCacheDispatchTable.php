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

namespace GanbaroDigital\Polymorphism\V1\DispatchTables;

use GanbaroDigital\Polymorphism\V1\Interfaces\DispatchTable;
use GanbaroDigital\Polymorphism\V1\Interfaces\TypeMapper;

/**
 * map types to methods with built-in caching
 *
 * This dispatch table supports all possible data types. As a result, it's a
 * little slower than the alternatives, but it is rock solid.
 */
class AllPurposePreCacheDispatchTable implements DispatchTable
{
    /**
     * our known results so far
     *
     * @var array
     */
    private $dispatchCache = [];

    /**
     * a list of supported types, and the return type for that type
     *
     * this is the $dispatchTable parameter to the TypeMapper
     *
     * @var array
     */
    private $typeMethods = [];

    /**
     * the TypeMapper to use
     *
     * @var TypeMapper
     */
    private $typeMapper;

    /**
     * what value do we return if our TypeMapper doesn't find a match?
     *
     * @var string
     */
    private $fallback;

    /**
     * create a new dispatch table
     *
     * @param array $typeMethods
     *        a list of supported types and the methods they map onto
     * @param TypeMapper $typeMapper
     *        the TypeMapper to use to inspect
     * @param string $fallback
     *        what value do we return if our TypeMapper does not find a match?
     */
    public function __construct($typeMethods, TypeMapper $typeMapper, $fallback = TypeMapper::FALLBACK_RESULT)
    {
        $this->typeMethods = $typeMethods;
        $this->typeMapper = $typeMapper;
        $this->fallback = $fallback;

        // some preprocessing to speed up our results
        $this->preCacheBuiltInTypes();
    }

    private function preCacheBuiltInTypes()
    {
        $builtInTypes = [
            "NULL" => NULL,
            "boolean" => true,
            "double" => 100.1,
            "integer" => 100,
            "resource" => STDIN
        ];

        // we ask the supplied mapper to pre-populate our cache
        // this ensures accurate results all the time
        foreach ($builtInTypes as $builtInType => $example) {
            $this->dispatchCache[$builtInType] = $this->typeMapper->using($example, $this->typeMethods, $this->fallback);
        }
    }

    /**
     * inspect a variable, and determine which method to call
     *
     * @param  mixed $item
     *         the item to describe
     * @return string
     *         the method to call
     */
    public function mapTypeToMethodName($item)
    {
        // we are optimised for objects
        if (is_object($item)) {
            $type = get_class($item);

            // have we seen this before?
            if (isset($this->dispatchCache[$type])) {
                return $this->dispatchCache[$type];
            }

            // first time we've seen this
            $this->dispatchCache[$type] = $this->typeMapper->using($item, $this->typeMethods, $this->fallback);
            return $this->dispatchCache[$type];
        }
        else if (is_string($item) || is_array($item)) {
            // it isn't safe to cache these data types
            // the result depends upon their contents
            return $this->typeMapper->using($item, $this->typeMethods, $this->fallback);
        }
        else {
            // this is NULL, boolean, double, integer, resource
            //
            // NOTE that callable is a pseudotype; it's something that
            // other data types can satisfy
            $type = gettype($item);
            return $this->dispatchCache[$type];
        }
    }
}
