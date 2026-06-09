<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\Exceptions;

use \Exception;
use Throwable;

final class EmptyDataOnPageException extends Exception
{


    public function __construct(
        ?string $message = null,
        int $code = 0,
        Throwable|null $previous = null
    ) {

        if ($message === null) {
            $message = "No data found on page";
        }

        return parent::__construct($message, $code, $previous);
    }
}
