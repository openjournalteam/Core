<?php



namespace OpenJournalTeam\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \OpenJournalTeam\Core\Skeleton\SkeletonClass
 */
class Core extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'core';
    }
}
