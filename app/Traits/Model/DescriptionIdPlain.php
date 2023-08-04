<?php 
namespace App\Traits\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * 
 */
trait DescriptionIdPlain
{
    protected function descriptionIdPlain(): Attribute
    {
        $description_id = strip_tags($this->description_id);
        $description_id = str_replace('&nbsp;', '', $description_id);
        $description_id = str_replace('&amp;', '', $description_id);
        return Attribute::make(
            get: fn ($value) => strip_tags($description_id),
        );
    }

    protected function descriptionIdPlainShort(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::words($this->description_id_plain, 15, '...'),
            // get: fn ($value) => Str::of($this->description_id_plain)->limit(100)->value(),
        );
    }
}


?>