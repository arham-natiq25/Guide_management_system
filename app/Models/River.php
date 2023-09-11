<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class River extends Model
{
    protected $table = 'rivers';
    protected $primaryKey='id';
    protected $fillable=['river_name','agency_id','status','display_order'];
    use HasFactory;
}
