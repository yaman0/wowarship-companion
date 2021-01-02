<?php
declare(strict_types=1);

namespace Domain\Tests\DaysStats\Entity;

use Domain\Stat\Entity\DayRange;
use PHPUnit\Framework\TestCase;

/**
 * Class DayRangeTest
 * @package Domain\Tests\DaysStats\Entity
 */
class DayRangeTest extends TestCase
{
    /**
     * day range get good to string range
     */
    final public function testDayRangeShouldGetGoodToStringRange(): void
    {
        //Given
        $entity = (new DayRange())
        ->setStart(\DateTime::createFromFormat('d-m-Y', '1-1-2020'))
        ->setEnd(\DateTime::createFromFormat('d-m-Y', '4-1-2020'));

        //When
        $stringDates = $entity->toArrayString();

        //Then
        self::assertCount(4, $stringDates);
        self::assertEquals(['20200101', '20200102', '20200103', '20200104'], $stringDates);
    }

    /**
     * build from end and range works
     * @throws \Exception
     */
    final public function testBuildFromEndAndRangeShouldWorks(): void
    {
        //Given
        $end = \DateTime::createFromFormat('d-m-Y', '4-1-2020');
        $range = 3;

        //When
        $entity = DayRange::buildFromEndAndRange($end, $range);

        //Then
        self::assertEquals('20200101', $entity->start->format(DayRange::FINAL_DATE_FORMAT));

    }
}