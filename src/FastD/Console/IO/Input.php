<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/16
 * Time: 下午2:11
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace FastD\Console\IO;

/**
 * Class Input
 *
 * @package FastD\Console\IO
 */
class Input implements InputInterface
{
    /**
     * Server argv.
     *
     * @var array
     */
    protected $argv;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->argv = $_SERVER['argv'];

        array_shift($this->argv);

        $this->parseCommandLineArguments();
    }

    /**
     * Initialize command argv input.
     * @return void
     */
    public function parseCommandLineArguments()
    {
        foreach ($this->argv as $argv) {
            if ('-' === substr($argv, 0, 1)) {
                $name = $argv;
                $value = null;
                if (false !== strpos($argv, '=')) {
                    list($name, $value) = explode('=', $argv);
                }
                $this->options[str_replace(['-', '--'], '', $name)] = str_replace(['"', '\''], '', $value);
            } else {
                $this->arguments[] = $argv;
            }
        }
    }

    /**
     * Recombination command line arguments.
     *
     * @param null $options
     * @param null $arguments
     * @return void
     */
    public function recombination($options = null, $arguments = null)
    {

    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        if (is_array($name)) {
            foreach ($name as $value) {
                if (array_key_exists($value, $this->options)) {
                    return true;
                }
                if (array_key_exists($value, $this->arguments)) {
                    return true;
                }
            }
            return false;
        }

        return array_key_exists($name, $this->options) ? true : false;
    }

    /**
     * @param $name
     * @return null|string|int
     */
    public function get($name)
    {
        if (is_array($name)) {
            foreach ($name as $value) {
                if (array_key_exists($value, $this->options)) {
                    return $this->options[$value];
                }
                if (array_key_exists($value, $this->arguments)) {
                    return $this->arguments[$value];
                }
            }
            return null;
        }

        return isset($this->options[$name]) ? $this->options[$name] : null;
    }

    /**
     * @return array
     */
    public function getArgv()
    {
        return $this->argv;
    }
}