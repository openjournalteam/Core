<?php

namespace OpenJournalTeam\Core\Exceptions;

use Throwable;

class InvalidPathException extends \InvalidArgumentException implements Throwable
{
    /**
     * @param  string $message
     * @param  int $code
     */
    public function __construct(
        $message = 'The given file path was invalid',
        $code = 400
    ) {
        parent::__construct($message, $code);
    }
}
