<?php
declare(strict_types=1);

namespace Domain\Stat\UseCase\GetDaysStats;

/**
 * Interface GetDaysStatsPresenterInterface
 * @package Domain\Stat\UseCase\GetDaysStats
 */
interface GetDaysStatsPresenterInterface
{
    public function present(GetDaysStatsResponse $response): void;
}