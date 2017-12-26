<?php

/*
 * This file is part of the Sonatra package.
 *
 * (c) François Pluchino <francois.pluchino@sonatra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonatra\Component\Cache\Adapter;

use Symfony\Component\Cache\Adapter\MemcachedAdapter as BaseMemcachedAdapter;

/**
 * Memcached Cache Adapter.
 *
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class MemcachedAdapter extends BaseMemcachedAdapter implements AdapterInterface
{
    use AdapterTrait;

    /**
     * {@inheritdoc}
     */
    protected function doClearByPrefix($namespace, $prefix)
    {
        $ok = true;
        $client = $this->getParentClient();
        $version = AdapterUtil::getPropertyValue($this, 'namespaceVersion');

        foreach ($this->getAllItems($client) as $key) {
            $ok = !$this->doClearItem($key, $namespace.$version.$prefix) && $ok ? false : $ok;
        }

        return $ok;
    }

    /**
     * Delete the key that starting by the prefix.
     *
     * @param string $id     The cache item id
     * @param string $prefix The full prefix
     *
     * @return bool
     */
    private function doClearItem($id, $prefix)
    {
        $key = substr($id, strrpos($id, ':') + 1);
        $res = true;

        if (!empty($key) && ('' === $prefix || 0 === strpos($id, $prefix))) {
            $res = $this->deleteItem($key);
        }

        return $res;
    }

    /**
     * Get all items.
     *
     * @param \Memcached $client The memcached client
     *
     * @return string[]
     */
    private function getAllItems(\Memcached $client)
    {
        $res = $client->getAllKeys();

        return false !== $res ? $res : array();
    }

    /**
     * Get the client.
     *
     * @return \Memcached
     */
    private function getParentClient()
    {
        $client = AdapterUtil::getPropertyValue($this, 'client');

        return null !== $client ? $client : AdapterUtil::getPropertyValue($this, 'lazyClient');
    }
}
