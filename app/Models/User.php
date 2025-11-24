<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture', // Ditambahkan untuk upload foto
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Scope untuk filter data
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, 'LIKE', '%' . $request->input($column) . '%');
            }
        }

        // Filter email_verified_at (yes/no)
        if ($request->filled('email_verified_at')) {
            if ($request->email_verified_at === 'yes') {
                $query->whereNotNull('email_verified_at');
            }
            if ($request->email_verified_at === 'no') {
                $query->whereNull('email_verified_at');
            }
        }

        return $query;
    }

    /**
     * Scope untuk search global (name, email)
     */
    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }

        return $query;
    }

    /**
     * Accessor untuk mendapatkan URL foto profil
     */
    public function getProfilePictureUrlAttribute(): ?string
    {
        if (!$this->profile_picture) {
            return null;
        }

        return asset('storage/uploads/profile/' . $this->profile_picture);
    }

    /**
     * Method untuk menghapus foto profil
     */
    public function deleteProfilePicture(): bool
    {
        if (!$this->profile_picture) {
            return false;
        }

        $filePath = storage_path('app/public/uploads/profile/' . $this->profile_picture);

        if (file_exists($filePath)) {
            unlink($filePath);
            $this->profile_picture = null;
            return $this->save();
        }

        return false;
    }

    /**
     * Method untuk mengecek apakah user memiliki foto profil
     */
    public function hasProfilePicture(): bool
    {
        return !empty($this->profile_picture);
    }

    /**
     * Boot method untuk event handling
     */
    protected static function boot()
    {
        parent::boot();

        // Hapus file foto ketika user dihapus
        static::deleting(function ($user) {
            if ($user->profile_picture) {
                $filePath = storage_path('app/public/uploads/profile/' . $user->profile_picture);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        });
    }
}
