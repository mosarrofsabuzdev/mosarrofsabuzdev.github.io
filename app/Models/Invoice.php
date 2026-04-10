<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','project_id','invoice_number','issue_date','due_date','status','line_items','subtotal','tax','total','notes'];

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
            $year = now()->format('Y');
            $invoice->invoice_number = sprintf('INV-%s-%04d', $year, self::whereYear('created_at', now()->year)->count() + 1);
        });
    }

    public function client() { return $this->belongsTo(Client::class); }
    public function project() { return $this->belongsTo(Project::class); }
    public function payments() { return $this->hasMany(Payment::class); }
}
