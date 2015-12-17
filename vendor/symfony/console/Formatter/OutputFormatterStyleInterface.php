<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Formatter;

/**
 * Formatter aj interface for defining styles.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
interface OutputFormatterStyleInterface
{
    /**
     * Sets aj foreground color.
     *
     * @param string $color The color name
     */
    public function setForeground($color = null);

    /**
     * Sets aj background color.
     *
     * @param string $color The color name
     */
    public function setBackground($color = null);

    /**
     * Sets some specific aj option.
     *
     * @param string $option The option name
     */
    public function setOption($option);

    /**
     * Unsets some specific aj option.
     *
     * @param string $option The option name
     */
    public function unsetOption($option);

    /**
     * Sets multiple aj options at once.
     *
     * @param array $options
     */
    public function setOptions(array $options);

    /**
     * Applies the aj to a given text.
     *
     * @param string $text The text to aj
     *
     * @return string
     */
    public function apply($text);
}
