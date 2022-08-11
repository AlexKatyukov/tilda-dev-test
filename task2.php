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
    private $array = [];

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
        $this->fillArray();
        return $this->getArrayHtml();
    }

    /**
     * Заполняет массив
     */
    private function fillArray(): void
    {
        foreach (range(1, $this->height) as $row) {
            foreach (range(1, $this->width) as $col) {
                $this->array[$row][$col] = rand($this->min, $this->max);
            }
        }
    }

    /**
     * Генерирует и возвращает html с массивом и суммами
     */
    private function getArrayHtml(): string
    {
        $colSum = [];
        $html = '<table>';

        foreach (range(1, $this->height) as $row) {
            $html .= '<tr>';
            foreach (range(1, $this->width) as $col) {
                $html .= '<td>';
                $html .= $this->array[$row][$col];
                $html .= '</td>';
                $colSum[$col] += $this->array[$row][$col];
            }
            $html .= '<td><b>';
            $html .= array_sum($this->array[$row]);
            $html .= '</b></td>';
            $html .= '</tr>';
        }

        $html .= '<tr>';
        foreach (range(1, $this->width) as $col) {
            $html .= '<td><b>';
            $html .= $colSum[$col];
            $html .= '</b></td>';
        }
        $html .= '</tr>';

        $html .= '</table>';

        return $html;
    }
}

echo (new ArrayGenerator(5, 7, 1, 1000))->handle();
