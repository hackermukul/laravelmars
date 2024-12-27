<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrievanceReply extends Model
{
    use HasFactory;

    protected $fillable = ['grievance_id', 'registrations_id', 'reply', 'attachment'];

    public function grievance()
    {
        return $this->belongsTo(Grievance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
