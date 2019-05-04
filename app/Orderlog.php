<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Order;

class Orderlog extends Model
{
    //
    //
    protected $fillable = [
        'time','public_comment','comment', 'state', 'username'
    ];

    public function order() : BelongsTo {
        return $this->belongsTo(Order::class);
    }
}
