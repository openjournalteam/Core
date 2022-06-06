<?php

namespace OpenJournalTeam\Core\Models;

use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Octopy\LaraPersonate\Models\Impersonate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
  use HasFactory, Notifiable, HasRoles, Impersonate;

  const ACTIVE = 1;
  const NOT_ACTIVE = 0;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'username',
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function canImpersonate(): bool
  {
    return $this->hasRole(Role::SUPER_ADMIN);
  }


  public function isSuperAdmin(): bool
  {
    return $this->hasRole(Role::SUPER_ADMIN);
  }
  
  public function generateToken()
  {
    $this->api_token = Str::random(60);
    $this->save();

    return $this->api_token;
  }
}
