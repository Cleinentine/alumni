<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Feedback;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class FeedbackChart extends ChartWidget
{
    protected ?string $heading = 'Feedback Average';
    protected static ?int $sort = 7;

    protected function getData(): array
    {
        $feedback = Feedback::query()
            ->join('graduates', 'feedback.graduate_id', '=', 'graduates.id')
            ->join('programs', 'graduates.program_id', '=', 'programs.id')
            ->join('colleges', 'programs.college_id', '=', 'colleges.id')
            ->select(
                'colleges.name as college_name',
                DB::raw('AVG(feedback.relevance) as avg_relevance'),
                DB::raw('AVG(feedback.skills) as avg_skills'),
                DB::raw('AVG(feedback.competency) as avg_competency')
            )
            ->groupBy('colleges.name')
            ->orderBy('colleges.name')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Relevance',
                    'data' => $feedback->pluck('avg_relevance'),
                    'borderColor' => 'oklch(70.7% 0.165 254.624)',
                    'backgroundColor' => 'oklch(100% 0.165 254.624)',
                ],
                [
                    'label' => 'Skills',
                    'data' => $feedback->pluck('avg_skills'),
                    'borderColor' => 'oklch(76.5% 0.177 163.223)',
                    'backgroundColor' => 'oklch(100% 0.177 163.223)',
                ],
                [
                    'label' => 'Competency',
                    'data' => $feedback->pluck('avg_competency'),
                    'borderColor' => 'oklch(82.8% 0.189 84.429)',
                    'backgroundColor' => 'oklch(100% 0.189 84.429)',
                ],
            ],
            'labels' => $feedback->pluck('college_name'),
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
