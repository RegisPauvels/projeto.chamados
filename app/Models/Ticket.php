<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'client_id',
        'analyst_id',
        'department_id',
        'ticket_type_id',
        'category_id',
        'urgency_level_id',
        'resolution',
        'closed_at'
    ];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

  
    public const STATUSES = [
        'open' => 'Aberto',
        'assigned' => 'Atribuído',
        'in_progress' => 'Em Andamento',
        'on_hold' => 'Em Espera',
        'resolved' => 'Resolvido',
        'closed' => 'Fechado',
        'cancelled' => 'Cancelado'
    ];

   
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

   
    public function analyst()
    {
        return $this->belongsTo(User::class, 'analyst_id');
    }

   
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    
    public function type()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function urgency()
    {
        return $this->belongsTo(UrgencyLevel::class, 'urgency_level_id');
    }

    
    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

   
    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }

  
    public function getStatusTextAttribute()
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    
    public function isOpen()
    {
        return in_array($this->status, ['open', 'assigned', 'in_progress', 'on_hold']);
    }

   
    public function isClosed()
    {
        return in_array($this->status, ['resolved', 'closed', 'cancelled']);
    }
}
