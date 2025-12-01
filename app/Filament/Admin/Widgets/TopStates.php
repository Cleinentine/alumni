<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use Filament\Widgets\ChartWidget;

class TopStates extends ChartWidget
{
    protected ?string $heading = 'Top States';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $topStates = Employment::selectRaw('state_id, COUNT(*) as employed_count')
            ->groupBy('state_id')
            ->orderByDesc('employed_count')
            ->limit(5)
            ->with('state')
            ->get();

        $labels = $topStates
            ->filter(fn ($c) => $c->state !== null)
            ->map(fn ($c) => $c->state->name)
            ->toArray();
        $data = $topStates->pluck('employed_count')->toArray();

        $topCompanies = $topStates->map(function ($s) {
            return Employment::where('state_id', $s->state_id)
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
