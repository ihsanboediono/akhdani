<?php 
namespace App\Traits\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * 
 */
trait ImageUrl
{
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('storage/'.$this->image),
        );
    }
}


?>