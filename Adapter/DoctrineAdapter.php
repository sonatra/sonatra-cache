<?php

/*
 * This file is part of the Fxp package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\Cache\Adapter;

use Symfony\Component\Cache\Adapter\DoctrineAdapter as BaseDoctrineAdapter;

/**
 * Doctrine Cache Adapter.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class DoctrineAdapter extends BaseDoctrineAdapter implements AdapterInterface
{
    use AdapterPrefixesTrait;

    /**
     * {@inheritdoc}
     */
    public function clearByPrefixes(array $prefixes): bool
    {
        return $this->clear();
    }
}
