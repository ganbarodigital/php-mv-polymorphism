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

namespace GanbaroDigital\Polymorphism\V1\Interfaces;

/**
 * use an input item's data type to work out which method we should call
 */
interface TypeMapper
{
    /**
     * this is the result we return when there's no matching method
     * in the dispatch table that we're given
     */
    const FALLBACK_RESULT = "nothingMatchesTheInputType";

    /**
     * use an input item's data type to work out which method we should
     * call
     *
     * @param  mixed $item
     *         the item we want to dispatch
     * @param  array $dispatchTable
     *         the list of methods that are available
     * @param  string $fallback
     *         the value to return if there's no suitable entry for $item
     *         in $dispatchTable
     * @return string
     *         the name of the method to call
     */
    public function __invoke($item, array $dispatchTable, $fallback = TypeMapper::FALLBACK_RESULT);

    /**
     * use an input item's data type to work out which method we should
     * call
     *
     * @param  mixed $item
     *         the item we want to dispatch
     * @param  array $dispatchTable
     *         the list of methods that are available
     * @param  string $fallback
     *         the value to return if there's no suitable entry for $item
     *         in $dispatchTable
     * @return string
     *         the name of the method to call
     */
    public static function using($item, array $dispatchTable, $fallback = TypeMapper::FALLBACK_RESULT);
}
