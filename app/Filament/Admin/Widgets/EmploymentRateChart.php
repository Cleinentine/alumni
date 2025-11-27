<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EmploymentRateChart extends ChartWidget
{
    protected ?string $heading = 'Employment Rate Chart';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 2;

    public ?int $countryId = null;
    public ?int $stateId = null;
    public ?int $cityId = null;

    protected function getData(): array
    {
        $query = Employment::select(
            'colleges.name as college_name',
            'graduates.gender',
            'employments.status',
            'countries.name as country_name',
            'states.name as state_name',
            'cities.name as city_name',
            DB::raw('COUNT(*) as total_graduates')
        )
            ->join('graduates', 'employments.graduate_id', '=', 'graduates.id')
            ->join('programs', 'graduates.program_id', '=', 'programs.id')
            ->join('colleges', 'programs.college_id', '=', 'colleges.id')
            ->leftJoin('countries', 'employments.country_id', '=', 'countries.id')
            ->leftJoin('states', 'employments.state_id', '=', 'states.id')
            ->leftJoin('cities', 'employments.city_id', '=', 'cities.id');

        if ($this->countryId) $query->where('employments.country_id', $this->countryId);
        if ($this->stateId) $query->where('employments.state_id', $this->stateId);
        if ($this->cityId) $query->where('employments.city_id', $this->cityId);

        $employmentStats = $query
            ->groupBy(
                'colleges.name',
                'graduates.gender',
                'employments.status',
                'countries.name',
                'states.name',
                'cities.name'
            )
            ->orderBy('colleges.name')
            ->orderBy('graduates.gender')
            ->orderBy('employments.status')
            ->get();

        $labels = $employmentStats->map(function ($item) {
            return $item->college_name
                . ' | ' . ($item->country_name ?? '-')
                . ' | ' . ($item->state_name ?? '-')
                . ' | ' . ($item->city_name ?? '-');
        })->unique()->toArray();

        $genders = $employmentStats->pluck('gender')->unique()->toArray();
        $statuses = $employmentStats->pluck('status')->unique()->toArray();

        // Generate pastel colors with borders
        $colors = [];
        $totalDatasets = count($genders) * count($statuses);
        for ($i = 0; $i < $totalDatasets; $i++) {
            $hue = ($i * 360 / $totalDatasets);
            $colors[] = [
                'background' => "hsla($hue, 70%, 80%, 0.7)", // pastel
                'border' => "hsla($hue, 70%, 50%, 1)" // darker border
            ];
        }

        $datasets = [];
        $colorIndex = 0;

        foreach ($genders as $gender) {
            foreach ($statuses as $status) {
                $data = [];
                foreach ($labels as $label) {
                    $total = $employmentStats->where('gender', $gender)
                        ->where('status', $status)
                        ->filter(
                            fn($item) => ($item->college_name
                                . ' | ' . ($item->country_name ?? '-')
                                . ' | ' . ($item->state_name ?? '-')
                                . ' | ' . ($item->city_name ?? '-')) === $label
                        )
                        ->sum('total_graduates');
                    $data[] = $total;
                }

                $datasets[] = [
                    'label' => ucfirst($gender) . ' - ' . ucfirst($status),
                    'data' => $data,
                    'backgroundColor' => $colors[$colorIndex]['background'],
                    'borderColor' => $colors[$colorIndex]['border'],
                    'borderWidth' => 1,
                ];

                $colorIndex++;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Employment Status by College, Gender & Location',
                ],
            ],
            'responsive' => true,
            'scales' => [
                'x' => ['stacked' => true],
                'y' => ['stacked' => true, 'beginAtZero' => true],
            ],
        ];
    }
}
