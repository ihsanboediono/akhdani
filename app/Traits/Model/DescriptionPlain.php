<?php 
namespace App\Traits\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * 
 */
trait DescriptionPlain
{
    protected function descriptionPlain(): Attribute
    {
        $description = strip_tags($this->description);
        $description = str_replace('&nbsp;', '', $description);
        return Attribute::make(
            get: fn ($value) => Str::words($description, 15, '...'),
        );
    }

    protected function descriptionPlainShort(): Attribute
    {
        $description = strip_tags($this->description);
        $description = str_replace('&nbsp;', '', $description);
        return Attribute::make(
            get: fn ($value) => Str::words($description, 15, '...'),
            // get: fn ($value) => Str::of($this->description_id_plain)->limit(100)->value(),
        );
    }

}


?>