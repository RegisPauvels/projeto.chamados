<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'comment',
        'is_private'
    ];

    
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    public function isPublic()
    {
        return !$this->is_private;
    }
}
