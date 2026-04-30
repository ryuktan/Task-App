<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'is_done',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        // This matches the Task.php relationship shown in image_1d3bc1.png
        return $this->belongsTo(User::class);
    }
}