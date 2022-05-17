<?php declare(strict_types = 1);
namespace noxkiwi\hook;

use Exception;
use noxkiwi\hook\Interfaces\HookInterface;
use noxkiwi\singleton\Singleton;

/**
 * I am the Hook class.
 *
 * @package      noxkiwi\hook
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2021 - 2022 noxkiwi
 * @version      1.0.1
 * @link         https://nox.kiwi/
 */
class Hook extends Singleton implements HookInterface
{
    /** @var callable[][] I am the list of hooks that have been added and can be fired. */
    private array $hooks;

    /**
     * @param string $name
     * @param null   $arguments
     *
     * @return mixed
     */
    final public static function run(string $name, $arguments = null): mixed
    {
        try {
            return self::getInstance()->fire($name, $arguments);
        } catch (Exception) {
            // IGNORE
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    final public function fire(string $event, mixed $arguments = null): mixed
    {
        $ret = null;
        foreach ($this->get($event) as $callback) {
            try {
                $ret = $callback($arguments);
            } catch (Exception) {
                // This is suppressed.
            }
        }

        return $ret;
    }

    /**
     * @inheritDoc
     */
    final public function get(string $event): array
    {
        return $this->hooks[$event] ?? [];
    }

    /**
     * @inheritDoc
     */
    final public function add(string $event, callable $callback): void
    {
        $this->hooks[$event][] = $callback;
    }

    /**
     * @inheritDoc
     */
    protected function initialize(): void
    {
        parent::initialize();
        $this->hooks = [];
    }
}
