<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Employment;
use App\Models\Graduate;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalAlumni = Graduate::get();
        $trackedAlumni = Employment::where('status', '!=', null)->get();

        $lastYear = Graduate::select('gender')
            ->selectRaw('count(*) as total')
            ->groupBy('gender')
            ->where('year_graduated', date('Y') - 1)
            ->pluck('total', 'gender');

        $lastYearMale = $lastYear['Male'] ?? 0;
        $lastYearFemale = $lastYear['Female'] ?? 0;

        $thisYear = Graduate::select('gender')
            ->selectRaw('count(*) as total')
            ->groupBy('gender')
            ->where('year_graduated', date('Y'))
            ->pluck('total', 'gender');

        $thisYearMale = $thisYear['Male'] ?? 0;
        $thisYearFemale = $thisYear['Female'] ?? 0;

        return [
            Stat::make('Last Year Graduates', count($lastYear))
                ->description($lastYearMale.' male and '.$lastYearFemale.' female alumni')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('danger'),
            Stat::make('This Year Graduates', count($thisYear))
                ->description($thisYearMale.' male and '.$thisYearFemale.' female alumni')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            Stat::make('Tracked Alumni', count($trackedAlumni))
                ->description(count($trackedAlumni).' out of '.count($totalAlumni).' alumni tracked')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('info'),
        ];
    }
}
