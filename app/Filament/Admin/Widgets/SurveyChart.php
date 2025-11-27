<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Survey;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class SurveyChart extends ChartWidget
{
    protected ?string $heading = 'Website Surveys';
    protected static ?int $sort = 9;

    protected function getData(): array
    {
        $currentYear = Carbon::now()->year;

        // Get data grouped by year for this year and upcoming years
        $data = Survey::query()
            ->whereYear('date_surveyed', '>=', $currentYear)
            ->selectRaw('YEAR(date_surveyed) as year, AVG(overall) as avg_overall')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        return [
            'labels' => $data->pluck('year')->map(fn($year) => (string)$year)->toArray(),
            'datasets' => [
                [
                    'label' => 'Average Overall',
                    'data' => $data->pluck('avg_overall')->map(fn($val) => round($val, 2))->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'fill' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'min' => 1,
                    'max' => 5,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
