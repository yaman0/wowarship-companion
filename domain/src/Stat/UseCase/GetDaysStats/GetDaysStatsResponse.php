<?php
declare(strict_types=1);

namespace Domain\Stat\UseCase\GetDaysStats;

use Domain\Stat\Entity\Stat;

/**
 * Class GetDaysStatsResponse
 * @package Domain\Stat\UseCase\GetDaysStats
 */
class GetDaysStatsResponse
{
    /** @var array<Stat> */
    public $stats;
}