<?php



namespace OpenJournalTeam\Core;

use Illuminate\Support\Facades\Facade;

/**
 * @see \OpenJournalTeam\Core\Skeleton\SkeletonClass
 */
class CoreFacade extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'core';
    }
}
