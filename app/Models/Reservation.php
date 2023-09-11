<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = "reservations";
    protected $primaryKey = "id";
    protected $fillable = ['trip_id','date','total_persons','referred',
    'guide_id','int_customer','fname','lname','email','phone','notes','automated_payment',
    'return_customer','private_water','request_guide','complete_address','repeat_request','calculate_price','special_rate',
    'rod_price','special_price','tax','total_fee','email_to_guest','email_to_guide','customer_details_text',
    'guide_details_text','custom_customer_text','custom_guide_text','meeting_time','location_id',
    'upcoming_reservation','archieved_reservation','cancelled_reservation'
    ];
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function trip()
        {
            return $this->belongsTo(Trip::class,'trip_id');
        }
        public function guide()
        {
            return $this->belongsTo(Guide::class,'guide_id');
        }
        public function location()
        {
            return $this->belongsTo(Location::class,'location_id');
        }

}
