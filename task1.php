<?php

/**
 * Задача 1: лесенка
 *
 * Нужно вывести лесенкой числа от 1 до 100.
 * 1
 * 2 3
 * 4 5 6
 * ...
 */

class StairsPrinter
{
    private const ELEMENT_DELIMETER = ' ';
    private const STRING_DELIMETER = '<br>';

    private $start;
    private $finish;
    private $current;
    private $count = 1;

    /**
     * @param int $start
     * @param int $finish
     */
    public function __construct(int $start, int $finish)
    {
        $this->start = $start;
        $this->finish = $finish;
    }

    /**
     * Возвращает «лесенку» от $this->start до $this->finish
     * @return string
     */
    public function handle(): string
    {
        $res = [];
        $this->current = $this->start;
        while ($this->current <= $this->finish) {
            $res[] = $this->getNewLevel();
            $this->count++;
        }
        return implode(self::STRING_DELIMETER, $res);
    }

    /**
     * Возвращает один уровень «лесенки» от $this->current в количестве $this->count
     */
    private function getNewLevel(): string
    {
        $res = [];
        for ($i = 0; $i < $this->count; $i++) {
            if ($this->current > $this->finish) {
                break;
            }
            $res[] = $this->current++;
        }
        return implode(self::ELEMENT_DELIMETER, $res);
    }
}

echo (new StairsPrinter(1, 100))->handle();
