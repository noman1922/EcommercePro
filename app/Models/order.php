<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class order extends Model
{
    use HasFactory;
    use Notifiable;
}