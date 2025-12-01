<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use Filament\Widgets\ChartWidget;

class TopCities extends ChartWidget
{
    protected ?string $heading = 'Top Cities';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $topCities = Employment::selectRaw('city_id, COUNT(*) as employed_count')
            ->groupBy('city_id')
            ->orderByDesc('employed_count')
            ->limit(5)
            ->with('city')
            ->get();

        $labels = $topCities
            ->filter(fn ($c) => $c->city !== null)
            ->map(fn ($c) => $c->city->name)
            ->toArray();
        $data = $topCities->pluck('employed_count')->toArray();

        $topCompanies = $topCities->map(function ($c) {
            return Employment::where('city_id', $c->city_id)
                ->groupBy('company')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(3)
                ->pluck('company')
                ->join(', ');
        })->toArray();

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
