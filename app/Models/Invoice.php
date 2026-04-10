<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'project_id', 'invoice_number', 'issue_date', 'due_date', 'status', 'line_items', 'subtotal', 'tax', 'total', 'notes'];

    protected function casts(): array
    {
        return ['issue_date' => 'date', 'due_date' => 'date', 'line_items' => 'array', 'subtotal' => 'decimal:2', 'tax' => 'decimal:2', 'total' => 'decimal:2'];
    }

    protected static function booted(): void
    {
        static::creating(function (self $invoice): void {
            if ($invoice->invoice_number) {
                return;
            }

            try {
                Cache::lock('upnez-invoice-sequence', 5)->block(5, function () use ($invoice): void {
                    $year = now()->format('Y');
                    $prefix = "INV-{$year}-";
                    $lastNumber = self::query()
                        ->where('invoice_number', 'like', $prefix.'%')
                        ->orderByDesc('invoice_number')
                        ->value('invoice_number');

                    $sequence = $lastNumber ? ((int) substr($lastNumber, -4)) + 1 : 1;
                    $invoice->invoice_number = sprintf('%s%04d', $prefix, $sequence);
                });
            } catch (\Throwable) {
                $invoice->invoice_number = sprintf('INV-%s-%04d', now()->format('Y'), random_int(1, 9999));
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
