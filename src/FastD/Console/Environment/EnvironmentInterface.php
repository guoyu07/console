<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/30
 * Time: 上午10:49
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\Environment;

use FastD\Console\Command;
use FastD\Console\IO\InputInterface;
use FastD\Container\Container;

/**
 * Interface EnvironmentInterface
 *
 * @package FastD\Console\Environment
 */
interface EnvironmentInterface extends \Iterator
{
    /**
     * @param InputInterface $inputInterface
     * @return mixed
     */
    public function run(InputInterface $inputInterface);

    /**
     * @param $name
     * @return Command
     */
    public function getCommand($name);

    /**
     * @param $name
     * @return bool
     */
    public function hasCommand($name);

    /**
     * @param Command $command
     * @return $this
     */
    public function setCommand(Command $command);

    /**
     * @param Container $container
     * @return $this
     */
    public function setContainer(Container $container);

    /**
     * @return Container
     */
    public function getContainer();

    /**
     * @return void
     */
    public function register();
}