<?php

/*
 * This file is part of the Sonatra package.
 *
 * (c) François Pluchino <francois.pluchino@sonatra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonatra\Component\Cache\Tests\Adapter;

use Sonatra\Component\Cache\Adapter\MemcachedCache;

/**
 * Memcached Cache Tests Suite.
 *
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class MemcachedCacheTest extends AbstractCacheTest
{
    /**
     * {@inheritdoc}
     */
    public function getCache()
    {
        return new MemcachedCache('prefix_', array(array(
            'host'   => '127.0.0.1',
            'port'   => 11211,
            'weight' => 0
        )));
    }

    /**
     * {@inheritdoc}
     */
    public function getMockCache()
    {
        return $this->getCache();
    }

    /**
     * Set up.
     */
    public function setUp()
    {
        if (!class_exists('Memcached', true)) {
            $this->markTestSkipped('Memcached is not installed');
        }

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
        $result = @socket_connect($socket, '127.0.0.1', 11211);
        socket_close($socket);

        if (!$result) {
            $this->markTestSkipped('Memcached is not running');
        }

        $memcached = new \Memcached();
        $memcached->addServer('127.0.0.1', 11211);

        $memcached->fetchAll();
    }

    /**
     * Clean up all.
     */
    public function tearDown()
    {
        if (!class_exists('Memcached', true)) {
            return;
        }

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
        $result = @socket_connect($socket, '127.0.0.1', 11211);
        socket_close($socket);

        if (!$result) {
            return;
        }

        socket_close($socket);

        $memcached = new \Memcached();
        $memcached->addServer('127.0.0.1', 11211);

        $memcached->fetchAll();
    }
}