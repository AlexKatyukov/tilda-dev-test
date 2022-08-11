<?php

/**
 * Задача 2: массивы
 * 
 * Нужно заполнить массив 5 на 7 случайными уникальными числами от 1 до 1000.
 * Вывести получившийся массив и суммы по строкам и по столбцам.
 */

class ArrayGenerator
{
    private $height;
    private $width;
    private $min;
    private $max;

    public function __construct(int $height, int $width, int $min, int $max)
    {
        $this->height = $height;
        $this->width = $width;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Заполняет массив и генерирует html с ним
     * @return string
     */
    public function handle(): string
    {
        $array = $this->getArray();
        return $this->getArrayHtml($array);
    }

    /**
     * Заполняет массив
     */
    private function getArray(): array
    {
        $array = [];
        for ($row = 0; $row < $this->height; $row++) {
            for ($col = 0; $col < $this->width; $col++) {
                $array[$row][$col] = rand($this->min, $this->max);
            }
        }

        return $array;
    }

    /**
     * Генерирует и возвращает html с массивом и суммами
     */
    private function getArrayHtml(array $array): string
    {
        $colSum = [];
        $html = '<table>';

        for ($col = 0; $col < $this->width; $col++) {
            $colSum[$col] = 0;
        }

        for ($row = 0; $row < $this->height; $row++) {
            $html .= '<tr>';
            for ($col = 0; $col < $this->width; $col++) {
                $html .= '<td>' . $array[$row][$col] . '</td>';
                $colSum[$col] += $array[$row][$col];
            }
            $html .= '<td><b>' . array_sum($array[$row]) . '</b></td>';
            $html .= '</tr>';
        }

        $html .= '<tr>';
        for ($col = 0; $col < $this->width; $col++) {
            $html .= '<td><b>' . $colSum[$col] . '</b></td>';
        }
        $html .= '</tr>';

        $html .= '</table>';

        return $html;
    }
}

echo (new ArrayGenerator(5, 7, 1, 1000))->handle();
