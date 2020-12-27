<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    use HasFactory;

    protected array $fillable = ['node_type', 'node_id', 'user_id', 'action_type', 'original_data', 'changes'];

    protected $casts = [
        'original_data' => 'json',
        'changes'       => 'json'
    ];
}
