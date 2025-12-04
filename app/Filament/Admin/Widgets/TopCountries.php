<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TopCountries extends ChartWidget
{
    protected ?string $heading = 'Top Countries';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $topCountries = Employment::join('countries', 'countries.id', '=', 'employments.country_id')
            ->select('employments.country_id', 'countries.name as country_name', DB::raw('COUNT(*) as employed_count'))
            ->groupBy('employments.country_id', 'countries.name')
            ->orderByDesc('employed_count')
            ->limit(5)
            ->get();

        $labels = $topCountries->pluck('country_name')->toArray();
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
