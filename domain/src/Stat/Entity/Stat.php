<?php
declare(strict_types=1);

namespace Domain\Stat\Entity;


use DateTime;

class Stat
{
    /** @var int */
    private $battles;
    /** @var int */
    private $survived_battles;
    /** @var int */
    private $wins;
    /** @var int */
    private $xp;
    /** @var int */
    private $frags;
    /** @var Datetime */
    private $day;

    /**
     * @return int
     */
    public function getBattles(): int
    {
        return $this->battles;
    }

    /**
     * @param int $battles
     * @return Stat
     */
    public function setBattles(int $battles): Stat
    {
        $this->battles = $battles;
        return $this;
    }

    /**
     * @return int
     */
    public function getSurvivedBattles(): int
    {
        return $this->survived_battles;
    }

    /**
     * @param int $survived_battles
     * @return Stat
     */
    public function setSurvivedBattles(int $survived_battles): Stat
    {
        $this->survived_battles = $survived_battles;
        return $this;
    }

    /**
     * @return int
     */
    public function getWins(): int
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     * @return Stat
     */
    public function setWins(int $wins): Stat
    {
        $this->wins = $wins;
        return $this;
    }

    /**
     * @return int
     */
    public function getXp(): int
    {
        return $this->xp;
    }

    /**
     * @param int $xp
     * @return Stat
     */
    public function setXp(int $xp): Stat
    {
        $this->xp = $xp;
        return $this;
    }

    /**
     * @return int
     */
    public function getFrags(): int
    {
        return $this->frags;
    }

    /**
     * @param int $frags
     * @return Stat
     */
    public function setFrags(int $frags): Stat
    {
        $this->frags = $frags;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDay(): DateTime
    {
        return $this->day;
    }

    /**
     * @param DateTime $day
     * @return Stat
     */
    public function setDay(DateTime $day): Stat
    {
        $this->day = $day;
        return $this;
    }

}