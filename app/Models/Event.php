<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'user_id',
        'title',
        'start',
        'end',
    ];

    // /**
    //  * Transforma a data do banco em data_br
    //  *
    //  * @param [type] $value
    //  * @return void
    //  */
    // public function getStartAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d/m/Y');
    // }

    /**
     * Transforma a data do banco em data_br
     *
     * @param [type] $value
     * @return void
     */
    //  public function getStartAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d/m/Y');
    //  }

    // // set a data no formato desejado
    //  public function setStartAttribute($value)
    //  {
    //      $this->attributes['start'] = Carbon::createFromFormat('Y/m/d', $value)->toDateString();
    //  }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
