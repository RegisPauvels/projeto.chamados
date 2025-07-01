<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrgencyLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sla_hours'
    ];

    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
