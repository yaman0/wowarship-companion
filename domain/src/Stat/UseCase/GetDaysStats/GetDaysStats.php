<?php
declare(strict_types=1);

namespace Domain\Stat\UseCase\GetDaysStats;

use Domain\Stat\Entity\Stat;
use Domain\Stat\Entity\StatRepositoryInterface;

/**
 * Use case : getting days stats from a range of days
 * @package  Domain\Stat\UseCase\GetDaysStats
 */
class GetDaysStats
{
    /** @var StatRepositoryInterface */
    private $statRepository;

    /**
     * GetDaysStats constructor.
     * @param StatRepositoryInterface $statRepository
     */
    public function __construct(StatRepositoryInterface $statRepository)
    {
        $this->statRepository = $statRepository;

    }

    /**
     * Execute use case
     * @param GetDaysStatsRequest $request
     * @param GetDaysStatsPresenterInterface $presenter
     */
    public function execute(GetDaysStatsRequest $request, GetDaysStatsPresenterInterface $presenter): void
    {
        $stats = $this->statRepository->getStatBetween($request->range);
        $statsWithoutFirst = array_slice($stats, 1);
        $first = $stats[0];
        $result = [];
        foreach ($statsWithoutFirst as $stat) {
            $result[] = $this->computeStatsDiff($first, $stat);
            $first = $stat;
        }
        $response = new GetDaysStatsResponse();
        $response->stats = $result;
        $presenter->present($response);
    }

    private function computeStatsDiff(Stat $statA, Stat $statB): Stat
    {
        return (new Stat)
            ->setBattles($statB->getBattles() - $statA->getBattles())
            ->setFrags($statB->getFrags() - $statA->getFrags())
            ->setSurvivedBattles($statB->getSurvivedBattles() - $statA->getSurvivedBattles())
            ->setWins($statB->getWins() - $statA->getWins())
            ->setXp($statB->getXp() - $statA->getXp())
            ->setDay($statB->getDay());
    }
}