<?php
declare(strict_types=1);

namespace CakephpFixtureFactories\ORM\TableRegistry;

use Cake\ORM\Locator\LocatorInterface;
use Cake\ORM\TableRegistry;
use CakephpFixtureFactories\ORM\Locator\FactoryTableLocator;

/**
 * Alternative TableRegistry to be used by fixture factories
 * The table registered here will be stripped down versions of their TableRegistry counterpart
 * The things that will be removed :
 * - Behaviors
 * - Events
 * - Validation
 *
 * The goal is twofold :
 * - Having factories without side effects. they are only meant to create fixture data in the database and are not
 *   supposed to behave like the Application's Table classes
 * - Speeding up the fixture data injection to the database
 *
 * Class FactoryTableRegistry
 * @package CakephpFixtureFactories\ORM\TableRegistry
 */
class FactoryTableRegistry extends TableRegistry
{
    /**
     * LocatorInterface implementation instance.
     *
     * @var \Cake\ORM\Locator\LocatorInterface
     */
    protected static $_locator;

    /**
     * Default LocatorInterface implementation class.
     *
     * @var string
     */
    protected static $_defaultLocatorClass = FactoryTableLocator::class;

    /**
     * Returns a singleton instance of LocatorInterface implementation.
     * This has been removed in CakePHP 4.1.0, and has been re-added here
     * (https://github.com/cakephp/cakephp/compare/4.0.8...4.1.0-RC1#diff-28239f653d4163b32ba7450ec45f0c3f)
     *
     * @return \Cake\ORM\Locator\LocatorInterface
     */
    public static function getTableLocator(): LocatorInterface
    {
        if (static::$_locator === null) {
            static::$_locator = new static::$_defaultLocatorClass();
        }

        return static::$_locator;
    }
}
