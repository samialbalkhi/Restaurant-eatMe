<?php

namespace App\Models;

use App\Models\Job;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job_offer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Jobs()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
