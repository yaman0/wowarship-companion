<?php
declare(strict_types=1);

namespace Domain\Stat\UseCase\GetDaysStats;

use Domain\Stat\Entity\DayRange;

/**
 * Class GetDaysStatsRequest
 * @package Domain\Stat\UseCase\GetDaysStats
 */
class GetDaysStatsRequest
{
    /** @var DayRange */
    public $range;
    /** @var string */
    public $usercode;
}