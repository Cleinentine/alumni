<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TopCompaniesChart extends ChartWidget
{
    protected ?string $heading = 'Top 5 Companies';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $records = Employment::join('graduates', 'employments.graduate_id', '=', 'graduates.id')
            ->join('programs', 'graduates.program_id', '=', 'programs.id')
            ->join('colleges', 'programs.college_id', '=', 'colleges.id')
            ->select(
                'colleges.name as college_name',
                'employments.company',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('colleges.name', 'employments.company')
            ->orderBy('colleges.name')
            ->orderByDesc('total')
            ->get();

        $labels = $records->pluck('company')->unique()->toArray();

        $datasets = $records->groupBy('college_name')->map(function ($collegeRecords, $collegeName) use ($labels) {
            // ensure all companies exist in dataset
            $data = [];
            foreach ($labels as $label) {
                $record = $collegeRecords->firstWhere('company', $label);
                $data[] = $record ? $record->total : 0;
            }

            return [
                'label' => $collegeName,
                'data' => $data,
            ];
        })->values()->toArray();

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
