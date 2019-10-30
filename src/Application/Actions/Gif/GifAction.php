<?php
declare(strict_types=1);

namespace App\Application\Actions\Gif;

use App\Application\Actions\Action;
use Psr\Log\LoggerInterface;

abstract class GifAction extends Action
{

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }
}
