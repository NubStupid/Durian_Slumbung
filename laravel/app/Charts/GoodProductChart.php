<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Products;
use ArielMejiaDev\LarapexCharts\PieChart as PieChart;
class GoodProductChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): PieChart
    {
        $bad = Products::where('rate', '<=', 3)->count();
        $good = Products::where('rate', '>', 3)->count();
        return $this->chart->pieChart()
            ->setTitle('Products Rating')
            ->addData([
                $bad,$good

            ])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setLabels(['Bad Products', 'Good Products']);
    }
}
