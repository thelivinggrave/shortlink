<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $url
 * @property string $code
 * @property int $clicks
 * @property Link $parent
 */

class Link extends Model
{
    use HasFactory;

    protected $fillable = ["url"];

    protected static function booted()
    {
        parent::booted();

        static::created(function ($link) {
            $code = base_convert($link->id, 10, 36);

            for ($i = 0; $i <= 6 - strlen($code); $i++)
                $code = "0" . $code;

            $link->code = $code;
            $link->save();
        });
    }
}
