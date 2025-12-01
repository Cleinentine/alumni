<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use Filament\Widgets\ChartWidget;

class TopCountries extends ChartWidget
{
    protected ?string $heading = 'Top Countries';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $topCountries = Employment::selectRaw('country_id, COUNT(*) as employed_count')
            ->groupBy('country_id')
            ->orderByDesc('employed_count')
            ->limit(5)
            ->with('country')
            ->get();

        $labels = $topCountries
            ->filter(fn ($c) => $c->country !== null)
            ->map(fn ($c) => $c->country->name)
            ->toArray();
        $data = $topCountries->pluck('employed_count')->toArray();

        $topCompanies = $topCountries->map(function ($c) {
            return Employment::where('country_id', $c->country_id)
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
