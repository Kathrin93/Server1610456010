<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Book;
use App\User;

class Order extends Model
{
    //
    protected $fillable = [
        'time','netto','brutto', 'state', 'user_id'
    ];

    public function orderLogs() : HasMany {
        return $this->hasMany(Orderlog::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function books() : BelongsToMany {
        return $this->belongsToMany(Book::class)->withPivot('price', 'amount', 'title')->withTimestamps();
    }
}
