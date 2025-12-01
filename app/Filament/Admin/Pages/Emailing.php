<?php

namespace App\Filament\Admin\Pages;

use App\Mail\EmailNotification;
use App\Models\User;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Mail;

class Emailing extends Page
{
    protected string $view = 'filament.admin.pages.emailing';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AtSymbol;

    public static function getNavigationLabel(): string
    {
        return 'Emailing';
    }

    public static function getNavigationSort(): ?int
    {
        return 8;
    }

    public function submit()
    {
        $users = User::where('roles', '>=', 2)->get();

        if ($users) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new EmailNotification($user));
            }

            Notification::make()
                ->title('Emails sent successfully!')
                ->success()
                ->send();
        }
    }
}
