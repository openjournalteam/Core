<?php

namespace OpenJournalTeam\Core\Classes;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenJournalTeam\Core\Exceptions\InvalidPathException;

class Filepond
{
    /**
     * Converts the given path into a filepond server id
     *
     * @param  string $path
     *
     * @return string
     */
    public function getServerIdFromPath($path)
    {
        // if (config('filepond.temporary_files_disk') == 'public') $path = 'storage/' . $path;

        return Crypt::encryptString($path);
    }

    /**
     * Converts the given filepond server id into a path
     *
     * @param  string $serverId
     *
     * @return string
     */
    public function getPathFromServerId($serverId)
    {
        if (!trim($serverId)) {
            throw new InvalidPathException();
        }

        $filePath = Crypt::decryptString($serverId);
        $filePath = config('filepond.temporary_files_disk') == 'public' ?  'storage/' . $filePath : $filePath;

        $configFilePath = config('filepond.temporary_files_disk') == 'public' ? 'storage/' . config('filepond.temporary_files_path', 'filepond') : config('filepond.temporary_files_path', 'filepond');

        if (!Str::startsWith($filePath, $configFilePath)) {
            throw new InvalidPathException();
        }

        return $filePath;
    }
}
