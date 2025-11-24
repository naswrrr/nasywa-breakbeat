<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Pelanggan extends Model
{
    // Tentukan nama tabel
    protected $table = 'pelanggan';

    // DEFINISIKAN PRIMARY KEY - JANGAN DIKOMEN!
    protected $primaryKey = 'pelanggan_id';

    protected $fillable = [
        'first_name', 'last_name', 'birthday', 'gender', 'email', 'phone', 'photos'
    ];

    // Accessor untuk photos
    public function getPhotosAttribute($value)
    {
        if (empty($value)) return [];
        if (is_array($value)) return $value;
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }

    // Mutator untuk photos
    public function setPhotosAttribute($value)
    {
        $this->attributes['photos'] = is_array($value) ? json_encode($value) : json_encode([]);
    }

    // Scope untuk filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->$column);
            }
        }
        return $query;
    }

    // Scope untuk search
    public function scopeSearch(Builder $query, $request, array $searchableColumns)
    {
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $searchTerm . '%');
                }
            });
        }
        return $query;
    }
}
