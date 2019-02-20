<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

/**
 * Class Record
 * @package App
 * @mixin \Eloquent
 */
class Record extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';
    const DELETED_AT = 'date_removed';

    protected $guarded = ['id', 'uid'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uid = (string) Uuid::generate(4);
        });
    }

}
