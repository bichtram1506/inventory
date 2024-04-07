<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Casts\Json;
use App\Casts\Address;
class User extends Authenticatable implements HasLocalePreference
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'email' => 'string',
        'phone' => 'string',
        'address' => Json::class //Address::class,
       //'name' => Json::class, //test cat (xong thì xóa)
    ];


 /*   public function newCollection(array $models = []): Collection
    {
        return new UserCollection($models);
    }
*/
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function preferredLocale(): string
    {
         return $this->locale;
    }

    
}
