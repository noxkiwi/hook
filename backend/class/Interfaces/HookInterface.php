<?php declare(strict_types = 1);
namespace noxkiwi\hook\Interfaces;

/**
 * I am the interface of the Hook class.
 * I will run any given callable when the event is fired.
 *
 * @package      noxkiwi\hook\Interfaces
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
interface HookInterface
{
    /**
     * I will add the given $callable to be executed when the given $event is fired.
     *
     * @param string   $event
     * @param callable $callback
     */
    public function add(string $event, callable $callback): void;

    /**
     * Fires all the callbacks that are stored under the given $name
     *
     * @param string $event
     * @param mixed  $arguments
     *
     * @return       mixed
     */
    public function fire(string $event, mixed $arguments = null): mixed;

    /**
     * Returns all the callbacks that are stored under the given $name
     *
     * @param string $event
     *
     * @return       array
     */
    public function get(string $event): array;
}
