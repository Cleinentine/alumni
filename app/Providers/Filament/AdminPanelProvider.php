<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Widgets\EntrepreneurshipChart;
use App\Filament\Admin\Widgets\FeedbackChart;
use App\Filament\Admin\Widgets\JobSearchMethodsChart;
use App\Filament\Admin\Widgets\PostGraduateChart;
use App\Filament\Admin\Widgets\StatsOverview;
use App\Filament\Admin\Widgets\SurveyChart;
use App\Filament\Admin\Widgets\TopCities;
use App\Filament\Admin\Widgets\TopCompaniesChart;
use App\Filament\Admin\Widgets\TopCountries;
use App\Filament\Admin\Widgets\TopIndustriesChart;
use App\Filament\Admin\Widgets\TopStates;
use App\Filament\Admin\Widgets\UniversityEngagementChart;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
            // Only allow admin users
            if (! Auth::user() || Auth::user()->roles >= 3) {
                abort(403);
            }
        });
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => Color::Red,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\Filament\Admin\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\Filament\Admin\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\Filament\Admin\Widgets')
            ->widgets([
                StatsOverview::class,

                TopCountries::class,
                TopStates::class,
                TopCities::class,

                PostGraduateChart::class,
                TopCompaniesChart::class,
                TopIndustriesChart::class,

                EntrepreneurshipChart::class,
                FeedbackChart::class,
                JobSearchMethodsChart::class,
                SurveyChart::class,
                UniversityEngagementChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
