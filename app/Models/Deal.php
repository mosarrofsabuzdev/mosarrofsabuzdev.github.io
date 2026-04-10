<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = ['lead_id','client_id','title','value','stage','probability','close_date','notes'];

    protected function casts(): array
    {
        return ['value' => 'decimal:2', 'probability' => 'integer', 'close_date' => 'date'];
    }

    public function lead() { return $this->belongsTo(Lead::class); }
    public function client() { return $this->belongsTo(Client::class); }
}
