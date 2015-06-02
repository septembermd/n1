<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>
 * Date: 6/2/15
 * Time: 10:40 AM
 */

/**
 * Class ConsoleCommand
 */
class ConsoleCommand extends CConsoleCommand
{
    /**
     * Pluralize word depending on count
     *
     * @param string $name
     * @param int $count
     * @return string
     */
    public function pluralize($name, $count = 1)
    {
        if ($count == 1) {
            return $name;
        }

        return parent::pluralize($name);
    }
}