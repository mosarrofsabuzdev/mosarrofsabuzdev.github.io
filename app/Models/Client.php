<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['company_name','contact_name','email','phone','address','status','health_score','mrr','renewal_date','account_manager_id'];

    protected function casts(): array
    {
        return ['health_score' => 'integer', 'mrr' => 'decimal:2', 'renewal_date' => 'date'];
    }

    public function accountManager() { return $this->belongsTo(User::class, 'account_manager_id'); }
    public function contacts() { return $this->hasMany(Contact::class); }
    public function projects() { return $this->hasMany(Project::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
}
