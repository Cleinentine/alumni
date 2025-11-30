<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TopIndustriesChart extends ChartWidget
{
    protected ?string $heading = 'Top 5 Industries';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $topIndustries = Employment::select('industries.id', 'industries.name', DB::raw('COUNT(*) as total'))
            ->join('industries', 'employments.industry_id', '=', 'industries.id')
            ->groupBy('industries.id', 'industries.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $industryIds = $topIndustries->pluck('id')->toArray();
        $industryLabels = $topIndustries->pluck('name')->toArray();

        // Step 2: Get counts per college for top industries
        $industryData = Employment::select(
            'colleges.name as college_name',
            'industries.name as industry_name',
            DB::raw('COUNT(*) as total_graduates')
        )
            ->join('graduates', 'employments.graduate_id', '=', 'graduates.id')
            ->join('programs', 'graduates.program_id', '=', 'programs.id')
            ->join('colleges', 'programs.college_id', '=', 'colleges.id')
            ->join('industries', 'employments.industry_id', '=', 'industries.id')
            ->whereIn('industries.id', $industryIds)
            ->groupBy('colleges.name', 'industries.name')
            ->orderBy('industries.name')
            ->get();

        // Step 3: Prepare datasets per college
        $datasets = $industryData->groupBy('college_name')->map(function ($group, $collegeName) use ($industryLabels) {
            $data = [];
            foreach ($industryLabels as $industryName) {
                $item = $group->firstWhere('industry_name', $industryName);
                $data[] = $item ? $item->total_graduates : 0;
            }

            return [
                'label' => $collegeName,
                'data' => $data,
            ];
        })->values()->toArray();

        return [
            'labels' => $industryLabels,
            'datasets' => $datasets,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
