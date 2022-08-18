<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, sluggable;

    protected $guarded = ['id']; //prop yg gak boleh diisi
    protected $with = ['author', 'category'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeCari($query, array $filters)
    {
        //versi isset
        $query->when($filters['search'] ?? false, function($query, $cari){
            return $query -> where('judul', 'like', '%' . $cari . '%')
                          -> orWhere('desc', 'like', '%' . $cari . '%');
        });

        //versi callback
        $query->when($filters['category'] ?? false, function($query, $category){
            return $query -> whereHas('category', function($query) use ($category){
                $query -> where('slug', $category);
            });
        });

        //versi arrowfunction
        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query -> whereHas('author', fn($query) =>
                $query -> where('username', $author)
            )
        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }
}
