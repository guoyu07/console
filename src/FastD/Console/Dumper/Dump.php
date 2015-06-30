<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/16
 * Time: 下午2:13
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace FastD\Console\Dumper;

use FastD\Console\Command;
use FastD\Console\Environment\EnvironmentInterface;
use FastD\Console\IO\Input;
use FastD\Console\IO\Output;

class Dump extends Command
{
    protected $env;

    public function __construct(EnvironmentInterface $interface)
    {
        $this->env = $interface;
    }

    public function getName()
    {
        return 'dump';
    }

    public function configure()
    {
        $this->setDescription('Console Dump tool.');
        $this->setOption('name', Command::OPT_REQUIRED, 'Dump command name.');
    }

    public function execute(Input $input, Output $output)
    {
        if (null === ($name = $input->getParameterOption('name'))) {
            throw new \RuntimeException(sprintf('Option name is null.'));
        }

        $command = $this->env->getCommand($name);

        $output->writeln($command);
    }
}