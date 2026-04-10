<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    use HasFactory;

    protected $fillable = ['task_id','user_id','project_id','hours','description','date','billable'];

    protected function casts(): array
    {
        return ['hours' => 'decimal:2', 'date' => 'date', 'billable' => 'boolean'];
    }

    public function task() { return $this->belongsTo(Task::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function project() { return $this->belongsTo(Project::class); }
}
