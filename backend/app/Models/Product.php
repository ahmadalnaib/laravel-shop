<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Searchable;
    protected $guarded = [];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return [
            'id' => $array['id'],
            'title' => $array['title'],
            'description' => $array['description'],
            'price' => $array['price'],
            'category' => $array['category'],
            'image' => $array['image'],
            'rating_rate' => $array['rating_rate'],
            'rating_count' => $array['rating_count'],
            'url' => '/products/' . $this->id,
            

        ];
    }
}
