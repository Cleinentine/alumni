<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Feedback;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class UniversityEngagementChart extends ChartWidget
{
    protected ?string $heading = 'University Engagement';

    protected static ?int $sort = 10;

    protected function getData(): array
    {
        $engagement = Feedback::query()
            ->join('graduates', 'feedback.graduate_id', '=', 'graduates.id')
            ->join('programs', 'graduates.program_id', '=', 'programs.id')
            ->join('colleges', 'programs.college_id', '=', 'colleges.id')
            ->select(
                'colleges.name as college_name',
                DB::raw("SUM(CASE WHEN feedback.engagement = 'Yes' THEN 1 ELSE 0 END) as total_yes"),
                DB::raw("SUM(CASE WHEN feedback.engagement = 'No' THEN 1 ELSE 0 END) as total_no")
            )
            ->groupBy('colleges.name')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Engaged with the University',
                    'data' => $engagement->pluck('total_yes'),
                    'backgroundColor' => 'oklch(70.7% 0.165 254.624)',
                    'borderColor' => 'oklch(100% 0.165 254.624)',
                ],
                [
                    'label' => 'Did not Engage with the University',
                    'data' => $engagement->pluck('total_no'),
                    'backgroundColor' => 'oklch(71.2% 0.194 13.428)',
                    'borderColor' => 'oklch(100% 0.194 13.428)',
                ],
            ],

            'labels' => $engagement->pluck('college_name'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
