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

        $current = $this->start;
        $count = 1;
        while ($current <= $this->finish) {
            $newLevel = [];
            for ($i = 0; $i < $count; $i++) {
                if ($current > $this->finish) {
                    break;
                }
                $newLevel[] = $current++;
            }

            $res[] = implode(self::ELEMENT_DELIMETER, $newLevel);

            $count++;
        }

        return implode(self::STRING_DELIMETER, $res);
    }
}

echo (new StairsPrinter(1, 100))->handle();
