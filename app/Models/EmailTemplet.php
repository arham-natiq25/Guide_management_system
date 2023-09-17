<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplet extends Model
{
    use HasFactory;
    protected $table='email_templets';
    protected $primaryKey='id';
    protected $fillable=[
        'display_title','subject','notes'
    ];


}
