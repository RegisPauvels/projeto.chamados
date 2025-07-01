<?php



namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'department_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

 
    public function scopeClients($query)
    {
        return $query->where('type', 'client');
    }

    
    public function scopeAnalysts($query)
    {
        return $query->where('type', 'analyst');
    }


    public function scopeAdmins($query)
    {
        return $query->where('type', 'admin');
    }

  
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'client_id');
    }

    
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'analyst_id');
    }

    public function isAdmin()
    {
        return $this->type === 'admin';
    }


    public function isAnalyst()
    {
        return $this->type === 'analyst';
    }


    public function isClient()
    {
        return $this->type === 'client';
    }
}