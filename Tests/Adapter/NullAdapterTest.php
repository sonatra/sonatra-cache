<?php

/*
 * This file is part of the Fxp package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\Cache\Tests\Adapter;

use Fxp\Component\Cache\Adapter\NullAdapter;

/**
 * Null Cache Adapter Test.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class NullAdapterTest extends AbstractAdapterTest
{
    protected function setUp()
    {
        $this->adapter = new NullAdapter();
        $this->adapter->clear();
    }

    public function testClearByPrefix()
    {
        $res = $this->adapter->clearByPrefix(static::PREFIX_1);
        $this->assertTrue($res);
    }

    public function testClearByPrefixWithDeferredItem()
    {
        $res = $this->adapter->clearByPrefix(static::PREFIX_1);
        $this->assertTrue($res);
    }
}
