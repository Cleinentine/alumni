<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use Filament\Widgets\ChartWidget;

class JobSearchMethodsChart extends ChartWidget
{
    protected ?string $heading = 'Job Search Methods';
    protected static ?int $sort = 8;

    protected function getData(): array
    {
        $methods = Employment::select('search_methods')
            ->selectRaw('count(*) as total')
            ->groupBy('search_methods')
            ->where('graduate_id', '!=', null)
            ->pluck('total', 'search_methods');

        $jobstreet = $methods['JobStreet'] ?? 0;
        $linkedin = $methods['LinkedIn'] ?? 0;
        $indeed = $methods['Indeed'] ?? 0;
        $kalibrr = $methods['Kalibrr'] ?? 0;
        $philjobnet = $methods['PhilJobNet'] ?? 0;
        $others = $methods['Others'] ?? 0;

        return [
            'datasets' => [
                [
                    'label' => 'Job Search Methods',
                    'data' => [
                        $jobstreet,
                        $linkedin,
                        $indeed,
                        $kalibrr,
                        $philjobnet,
                        $others
                    ],

                    'backgroundColor' => [
                        'oklch(60.6% 0.25 292.717)',
                        'oklch(62.3% 0.214 259.815)',
                        'oklch(58.5% 0.233 277.117)',
                        'oklch(67.3% 0.182 276.935)',
                        'oklch(78.9% 0.154 211.53)',
                        'oklch(71.2% 0.194 13.428)'
                    ],

                    'borderColor' => [
                        'oklch(100% 0.25 292.717)',
                        'oklch(100% 0.214 259.815)',
                        'oklch(100% 0.233 277.117)',
                        'oklch(100% 0.182 276.935)',
                        'oklch(100% 0.154 211.53)',
                        'oklch(100% 0.194 13.428)'
                    ]
                ],
            ],

            'labels' => [
                'JobStreet',
                'LinkedIn',
                'Indeed',
                'Kalibrr',
                'PhilJobNet',
                'Others'
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
