<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','description'
    ];
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
