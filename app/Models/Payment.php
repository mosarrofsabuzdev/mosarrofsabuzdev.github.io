<?php

namespace App\Models;

use App\Notifications\PaymentReceivedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id','amount','date','method','reference','notes'];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2', 'date' => 'date'];
    }

    protected static function booted(): void
    {
        static::created(function (self $payment): void {
            $invoice = $payment->invoice;
            if ($invoice) {
                $invoice->update(['status' => 'paid']);
                if ($invoice->client?->accountManager) {
                    $invoice->client->accountManager->notify(new PaymentReceivedNotification($payment));
                }
            }
        });
    }

    public function invoice() { return $this->belongsTo(Invoice::class); }
}
