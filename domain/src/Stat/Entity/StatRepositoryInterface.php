<?php
declare(strict_types=1);

namespace Domain\Stat\Entity;

interface StatRepositoryInterface
{
    /**
     * Getting stats from a range of days
     * @param DayRange $range
     * @return Stat[]
     */
    public function getStatBetween(DayRange $range): array;
}