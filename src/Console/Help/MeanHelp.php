<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/10
 * Time: 下午6:09
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Help;

use FastD\Console\Collections;

/**
 * Class MeanHelp
 *
 * @package FastD\Console\Help
 */
class MeanHelp extends Help
{
    /**
     * MeanHelp constructor.
     *
     * @param string $commandName
     * @param Collections $collections
     */
    public function __construct($commandName, Collections $collections)
    {
        $like = [];
        $list = [];

        $name = $commandName;

        if (false !== $index = strpos($commandName, ':')) {
            $name = substr($commandName, 0, $index);
        }

        foreach ($collections as $command) {
            $list[] = $command->getName();
            if (false !== strpos($command->getName(), $name)) {
                $like[] = $command->getName();
            }
        }

        $help = <<<EOF
Command "%s" is not found.
EOF;

        if (!empty($like)) {
            $help .= PHP_EOL . 'Did you mean this?' . PHP_EOL;
            $help .= '    <info>' . implode('    ' . PHP_EOL, $like) . '</info>';
        } else {
            $help .= PHP_EOL . 'You can: ' . PHP_EOL . '    <info>' . implode(PHP_EOL . '    ', $list) . '</info>';
        }

        parent::__construct(sprintf($help, $commandName));
    }
}