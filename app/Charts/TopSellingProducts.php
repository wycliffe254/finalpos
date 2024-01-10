<?php

namespace App\Charts;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\OrderDetail;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class TopSellingProducts
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        $topOrderedProducts = Product::withCount('order_details')
                                ->orderByDesc('order_details_count')
                                ->limit(5)->get();

        $hotProducts = $topOrderedProducts->pluck('product_name')->all();
        $counts = $topOrderedProducts->pluck('order_details_count')->all();

        return $this->chart->horizontalBarChart()
            ->setSubtitle('Most Sold products')
            ->setColors(['#49796b'])
            ->addData('', $counts)
            ->setXAxis($hotProducts);
    }
}
