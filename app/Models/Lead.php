<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['source','stage','deal_size','company','contact_name','email','phone','assigned_to','follow_up_date','notes'];

    protected function casts(): array
    {
        return ['deal_size' => 'decimal:2', 'follow_up_date' => 'date'];
    }

    public function assignee() { return $this->belongsTo(User::class, 'assigned_to'); }
    public function deals() { return $this->hasMany(Deal::class); }
}
