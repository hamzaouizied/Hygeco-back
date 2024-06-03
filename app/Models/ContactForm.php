<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ContactForm extends Model
{
    use HasFactory;
    // use Notifiable;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_forms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'address',
        'email',
        'service',
        'object',
        'note',
    ];
}
