<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Feedback;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EntrepreneurshipChart extends ChartWidget
{
    protected ?string $heading = 'Entrepreneurship';

    protected static ?int $sort = 6;

    protected function getData(): array
    {
        $entrepreneurship = Feedback::query()
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
                    'label' => 'Did Entrepreneurship',
                    'data' => $entrepreneurship->pluck('total_yes'),
                    'backgroundColor' => 'oklch(70.7% 0.165 254.624)',
                    'borderColor' => 'oklch(100% 0.165 254.624)',
                ],
                [
                    'label' => 'Did not Do Entrepreneurship',
                    'data' => $entrepreneurship->pluck('total_no'),
                    'backgroundColor' => 'oklch(71.2% 0.194 13.428)',
                    'borderColor' => 'oklch(100% 0.194 13.428)',
                ],
            ],

            'labels' => $entrepreneurship->pluck('college_name'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
