<?php
declare(strict_types=1);

namespace Domain\DaysStats\Entity;

use DateInterval;
use DateTime;
use Exception;

/**
 * Class DayRange
 * @package Domain\DaysStats\Entity
 */
class DayRange
{
    public const FINAL_DATE_FORMAT = 'Ymd';

    /** @var DateTime */
    public $start;
    /** @var DateTime */
    public $end;

    /**
     * Build day range from end date and range between start and end
     * @param DateTime $end
     * @param int $range
     * @return DayRange
     * @throws Exception
     */
    public static function buildFromEndAndRange(DateTime $end, int $range): DayRange
    {
        $start = clone $end;
        $start->sub(new DateInterval('P'.$range.'D'));
        return (new self())
            ->setEnd($end)
            ->setStart($start);

    }

    /**
     * @param DateTime $start
     * @return $this
     */
    public function setStart(DateTime $start): self
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param DateTime $end
     * @return $this
     */
    public function setEnd(DateTime $end): self
    {
        $this->end = $end;
        return $this;
    }

    /**
     * @return string[]
     */
    public function toArrayString(): array
    {
        $date = clone $this->start;
        $result = [$date->format(self::FINAL_DATE_FORMAT)];
        while (true) {
            $date->add(new DateInterval('P1D'));
            $result[] = $date->format(self::FINAL_DATE_FORMAT);
            if ($date->format(self::FINAL_DATE_FORMAT) === $this->end->format(self::FINAL_DATE_FORMAT)) {
                break;
            }
        }
        return $result;
    }
}