<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = ['to', 'cc', 'subject', 'body', 'sent_at', 'sent_by', 'emailable_type', 'emailable_id'];

    protected function casts(): array
    {
        return ['sent_at' => 'datetime'];
    }

    public function sender() { return $this->belongsTo(User::class, 'sent_by'); }
    public function emailable() { return $this->morphTo(); }
}
