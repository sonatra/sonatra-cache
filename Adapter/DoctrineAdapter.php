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

use Symfony\Component\Cache\Adapter\DoctrineAdapter as BaseDoctrineAdapter;

/**
 * Doctrine Cache Adapter.
 *
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class DoctrineAdapter extends BaseDoctrineAdapter implements AdapterInterface
{
    /**
     * {@inheritdoc}
     */
    public function clearByPrefix($prefix)
    {
        return $this->clear();
    }
}