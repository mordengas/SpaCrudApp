<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reservation extends Model
{
    use Notifiable;

    protected $fillable = [

        'client_id',
        'treatment_id',
        'reservation_date',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('client_id', 'like', '%'.$search.'%')
                ->orWhere('treatment_id', 'like', '%'.$search.'%')
                ->orWhere('reservation_date', 'like', '%'.$search.'%');
    }

}
