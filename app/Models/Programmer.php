<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programmer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email'
    ];

    public function projects(){
        return $this->belongsToMany(Project::class, 'project_programmer')->withTimestamps();;
    }

    public function getProjectIds(){
        return $this->projects->pluck('id')->toArray();
    }
    
    public function hasProject($project){
        return in_array($project->id, $this->getProjectIds());
    }
}
