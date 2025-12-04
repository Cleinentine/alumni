<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TopCities extends ChartWidget
{
    protected ?string $heading = 'Top Cities';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $topCities = Employment::join('cities', 'cities.id', '=', 'employments.city_id')
            ->select('employments.city_id', 'cities.name as city_name', DB::raw('COUNT(*) as employed_count'))
            ->groupBy('employments.city_id', 'cities.name')
            ->orderByDesc('employed_count')
            ->limit(5)
            ->get();

        // Labels and data
        $labels = $topCities->pluck('city_name')->toArray();
        $data = $topCities->pluck('employed_count')->toArray();

        // Top companies per city
        $topCompanies = $topCities->map(function ($c) {
            return Employment::where('city_id', $c->city_id)
                ->groupBy('company')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(3)
                ->pluck('company')
                ->join(', ');
        })->toArray();

        // Return chart data
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Number of Employed Graduates',
                    'data' => $data,
                    'backgroundColor' => ['#4caf50', '#2196f3', '#ff9800', '#9c27b0', '#f44336'],
                    'tooltip' => [
                        'callbacks' => [
                            'afterLabel' => function ($context) use ($topCompanies) {
                                return 'Top Companies: '.$topCompanies[$context['dataIndex']];
                            },
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
