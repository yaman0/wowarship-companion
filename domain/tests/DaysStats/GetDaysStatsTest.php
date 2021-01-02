<?php
declare(strict_types=1);

namespace Domain\Tests\Stats;

use Domain\Stat\Entity\DayRange;
use Domain\Stat\Entity\Stat;
use Domain\Stat\Entity\StatRepositoryInterface;
use Domain\Stat\UseCase\GetDaysStats\GetDaysStats;
use Domain\Stat\UseCase\GetDaysStats\GetDaysStatsPresenterInterface;
use Domain\Stat\UseCase\GetDaysStats\GetDaysStatsRequest;
use Domain\Stat\UseCase\GetDaysStats\GetDaysStatsResponse;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * Class GetDaysStatsTest
 * @package Domain\Tests\UseCase\GetDaysStats
 */
class GetDaysStatsTest extends TestCase implements GetDaysStatsPresenterInterface
{
    /** @var GetDaysStatsResponse */
    private $output;

    final public function present(GetDaysStatsResponse $response): void
    {
        $this->output = $response;
    }

    /**
     * Build stat array for testing
     * @return array
     */
    private function buildStatCollection(): array
    {
        return [
            (new Stat())
                ->setXp(1)
                ->setWins(1)
                ->setSurvivedBattles(1)
                ->setFrags(1)
                ->setBattles(1)
                ->setDay(\DateTime::createFromFormat('d-m-Y', '1-1-2020')),
            (new Stat())
                ->setXp(2)
                ->setWins(2)
                ->setSurvivedBattles(2)
                ->setFrags(2)
                ->setBattles(2)
                ->setDay(\DateTime::createFromFormat('d-m-Y', '2-1-2020')),
            (new Stat())
                ->setXp(3)
                ->setWins(3)
                ->setSurvivedBattles(3)
                ->setFrags(3)
                ->setBattles(3)
                ->setDay(\DateTime::createFromFormat('d-m-Y', '3-1-2020')),
        ];
    }

    /**
     * get days stats with ten days range works
     */
    final public function testGetDaysStatsWithTenDaysRangeShouldWorks(): void
    {
        //Given
        $input = new GetDaysStatsRequest();
        $range = (new DayRange())
            ->setStart(\DateTime::createFromFormat('d-m-Y', '1-1-2020'))
            ->setEnd(\DateTime::createFromFormat('d-m-Y', '3-1-2020'));
        $input->range = $range;
        $input->usercode = '0101';
        $repository = $this->prophesize(StatRepositoryInterface::class);
        $repository->getStatBetween(Argument::type(DayRange::class))
            ->shouldBeCalledTimes(1)
            ->willReturn($this->buildStatCollection());
        $useCase = new GetDaysStats($repository->reveal());

        //When
        $useCase->execute($input, $this);

        //Then
        $stats = $this->output->stats;
        self::assertCount(2, $stats);
        self::assertEquals(\DateTime::createFromFormat('d-m-Y', '2-1-2020'), $stats[0]->getDay());
        self::assertEquals(\DateTime::createFromFormat('d-m-Y', '3-1-2020'), $stats[1]->getDay());
        /** @var Stat $lastStat */
        $lastStat = $this->output->stats[1];
        self::assertEquals(1, $lastStat->getXp());
        self::assertEquals(1, $lastStat->getWins());
        self::assertEquals(1, $lastStat->getFrags());
        self::assertEquals(1, $lastStat->getBattles());
        self::assertEquals(1, $lastStat->getSurvivedBattles());
    }
}