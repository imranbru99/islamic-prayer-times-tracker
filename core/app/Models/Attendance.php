<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'date' => 'date',
        'fajr' => 'boolean',
        'dhuhr' => 'boolean',
        'asr' => 'boolean',
        'maghrib' => 'boolean',
        'isha' => 'boolean',
        'tahajjud' => 'boolean',
        'witr' => 'boolean',
    ];

    public const PRAYERS = ['fajr', 'dhuhr', 'asr', 'maghrib', 'isha', 'tahajjud', 'witr'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function completedCount()
    {
        return collect(self::PRAYERS)->filter(function ($prayer) {
            return (bool) $this->{$prayer};
        })->count();
    }

    public function obligatoryCount()
    {
        return collect(['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'])->filter(function ($prayer) {
            return (bool) $this->{$prayer};
        })->count();
    }

    public function isComplete()
    {
        return $this->obligatoryCount() === 5;
    }
}
