<?php 
namespace App\Traits\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * 
 */
trait DescriptionEnPlain
{
    protected function descriptionEnPlain(): Attribute
    {
        $description_en = strip_tags($this->description_en);
        $description_en = str_replace('&nbsp;', '', $description_en);
        $description_en = str_replace('&amp;', '', $description_en);
        return Attribute::make(
            get: fn ($value) => strip_tags($description_en),
        );
    }

    protected function descriptionEnPlainShort(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::words($this->description_en_plain, 15, '...'),
            // get: fn ($value) => Str::of($this->description_en_plain)->limit(100)->value(),
        );
    }
    
}


?>