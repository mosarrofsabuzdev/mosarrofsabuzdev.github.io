<?php

use App\Mail\NotificationMail;
use App\Models\Bill;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\ScheduledEmail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

Artisan::command('upnez:dispatch-scheduled-emails', function () {
    ScheduledEmail::where('status', 'pending')
        ->where('scheduled_at', '<=', now())
        ->get()
        ->each(function (ScheduledEmail $scheduled): void {
            Mail::to($scheduled->to)->cc($scheduled->cc ?: [])->send(new NotificationMail($scheduled->subject, $scheduled->body, $scheduled->attachment_path));
            $scheduled->update(['status' => 'sent', 'sent_at' => now()]);
        });

    $this->info('Scheduled emails processed.');
});

Artisan::command('upnez:generate-alerts', function () {
    Invoice::where('status', 'sent')->whereDate('due_date', '<', now())->get()->each(function (Invoice $invoice): void {
        $invoice->update(['status' => 'overdue']);
        if ($invoice->client?->account_manager_id) {
            Notification::create([
                'user_id' => $invoice->client->account_manager_id,
                'type' => 'invoice_overdue',
                'title' => 'Invoice overdue',
                'message' => "{$invoice->invoice_number} is overdue.",
                'action_url' => '/invoices',
            ]);
        }
    });

    Bill::where('status', 'pending')->whereDate('due_date', now()->addDays(3)->toDateString())->get()->each(function (Bill $bill): void {
        foreach (\App\Models\User::whereIn('role', ['owner', 'manager'])->pluck('id') as $userId) {
            Notification::firstOrCreate([
                'user_id' => $userId,
                'type' => 'bill_due',
                'title' => 'Bill due in 3 days',
                'message' => "Bill #{$bill->id} is due soon.",
                'action_url' => '/bills',
            ]);
        }
    });

    Client::where('health_score', '<', 3)->get()->each(function (Client $client): void {
        if ($client->account_manager_id) {
            Notification::firstOrCreate([
                'user_id' => $client->account_manager_id,
                'type' => 'client_health_drop',
                'title' => 'Client health dropped',
                'message' => "{$client->company_name} health score is {$client->health_score}.",
                'action_url' => '/clients',
            ]);
        }
    });

    $this->info('Alerts generated.');
});

Schedule::command('upnez:dispatch-scheduled-emails')->everyMinute();
Schedule::command('upnez:generate-alerts')->everyMinute();
