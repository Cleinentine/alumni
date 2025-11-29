<?php

namespace App\Providers;

use App\Models\College;
use App\Models\Contact;
use App\Models\Employment;
use App\Models\Feedback;
use App\Models\Graduate;
use App\Models\Industry;
use App\Models\Program;
use App\Models\Survey;
use App\Models\User;
use App\Policies\CollegePolicy;
use App\Policies\ContactPolicy;
use App\Policies\EmploymentPolicy;
use App\Policies\FeedbackPolicy;
use App\Policies\GraduatePolicy;
use App\Policies\IndustryPolicy;
use App\Policies\ProgramPolicy;
use App\Policies\SurveyPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(College::class, CollegePolicy::class);
        Gate::policy(Contact::class, ContactPolicy::class);
        Gate::policy(Employment::class, EmploymentPolicy::class);
        Gate::policy(Feedback::class, FeedbackPolicy::class);
        Gate::policy(Graduate::class, GraduatePolicy::class);
        Gate::policy(Industry::class, IndustryPolicy::class);
        Gate::policy(Program::class, ProgramPolicy::class);
        Gate::policy(Survey::class, SurveyPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}
