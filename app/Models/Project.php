<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{

    use HasFactory;

    protected $table = 'project';

    /**
     * Get the User that owns the Notes.
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Project', 'client_id')->withTrashed();
    }

    /**
     * Get the Status that owns the Notes.
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function isDeleted()
    {
        return $this->belongsTo('App\Models\Project', 'is_deleted');
    }
}
