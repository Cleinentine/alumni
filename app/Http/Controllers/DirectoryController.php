<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DirectoryController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sort' => 'required|in:asc,desc',
            'group' => 'nullable|exists:colleges,id',
            'year' => 'required|integer|min:1960|max:' . date('Y'),
            'limit' => 'required|in:25,50,100,200,500',
            'keywords' => 'nullable|string|max:255',
        ]);

        $group = $request->group;
        $keywords = $request->keywords;
        $year = $request->year;
        $sort = $request->sort;
        $limit = $request->limit;
        $yearMessage = $keywordMessage = $subtext = '';

        if (empty($sort) || $validator->fails()) {
            $sort = 'asc';
        }

        if (empty($year) || $validator->fails()) {
            $year = date('Y');
        } else {
            $yearMessage = ' on batch ' . $year;
        }

        if (empty($limit) || $validator->fails()) {
            $limit = 25;
        }

        if (! empty($keywords)) {
            $keywordMessage = ' for ' . '"' . $keywords . '"';
        }

        $text = 'No alumni records found' . $keywordMessage . $yearMessage;

        $alumni = Graduate::search($keywords)->get();
        $colleges = College::get();
        $selectedCollege = College::where('id', $group)->first();

        $displayTexts = [
            ['Last Name A-Z', 'Last Name Z-A'],
            $colleges,
            range(1960, date('Y')),
            ['25', '50', '100', '200', '500']
        ];

        $icons = ['fa-sort', 'fa-building-columns', 'fa-graduation-cap', 'fa-arrow-down-1-9'];
        $labels = ['Sort By Name', 'Filter By College', 'Filter By Year', 'Results per Page'];
        $names = ['sort', 'group', 'year', 'limit'];
        $loops = [count($displayTexts[0]), count($displayTexts[1]), count($displayTexts[2]), count($displayTexts[3])];
        $selected = [$sort, $group, $year, $limit];
        $specials = ['', 'colleges', '', ''];

        $values = [
            ['asc', 'desc'],
            $colleges,
            range(1960, date('Y')),
            [25, 50, 100, 200, 500]
        ];

        if (empty($group)) {
            $graduates = Graduate::query()
                ->join('programs', 'graduates.program_id', '=', 'programs.id')
                ->join('colleges', 'programs.college_id', '=', 'colleges.id')
                ->whereIn('graduates.last_name', $alumni->pluck('last_name'))
                ->where('graduates.year_graduated', $year)
                ->orderBy('graduates.last_name', $sort)
                ->paginate($limit);
        } else {
            $graduates = Graduate::query()
                ->join('programs', 'graduates.program_id', '=', 'programs.id')
                ->join('colleges', 'programs.college_id', '=', 'colleges.id')
                ->whereIn('graduates.last_name', $alumni->pluck('last_name'))
                ->where('programs.college_id', $group)
                ->where('graduates.year_graduated', $year)
                ->orderBy('graduates.last_name', $sort)
                ->paginate($limit);
        }

        if ($selectedCollege) {
            $subtext = 'College of ' . $selectedCollege->name;
        }

        return view('directory', [
            'colleges' => $colleges,
            'displayTexts' => $displayTexts,
            'graduates' => $graduates,
            'group' => $group,
            'icons' => $icons,
            'keywords' => $keywords,
            'labels' => $labels,
            'limit' => $limit,
            'loops' => $loops,
            'names' => $names,
            'selected' => $selected,
            'selectedCollege' => $selectedCollege,
            'sort' => $sort,
            'specials' => $specials,
            'subtext' => $subtext,
            'text' => $text,
            'values' => $values,
            'year' => $year
        ]);
    }
}
