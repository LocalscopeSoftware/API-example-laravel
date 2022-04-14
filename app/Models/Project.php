<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'startDate',
        'deadLineDate',
        'budget'
    ];

    public function programmers(){
        return $this->belongsToMany(Programmer::class, 'project_programmer');
    }

    /**
     * Get the project's budget.
     *
     * @param  string  $value
     * @return string
     */
    public function getBudgetAttribute($value)
    {
        return (float) $value;
    }

}
