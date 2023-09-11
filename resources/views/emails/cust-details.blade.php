<p>Your Reservation is booked by name : </p> <h4>  {{ $reservation->fname}}{{ $reservation->lname }} and it is {{ $reservation->trip->length }} reservation </h4>
<p>Trip name : {{ $reservation->trip->trip_name }}</p>
<p>Your trip date is {{ $reservation->date }}</p>
<p>The Guide Assigned to You is : {{ $reservation->guide->fname }}{{ $reservation->guide->lname }}</p>
<p>Guide Phone No : {{ $reservation->guide->mobile }}</p>
<p>Your Total Invoice with tax : {{ $reservation->total_fee }}</p>
@if ($password != null)
<p>Your Account Password is {{ $password  }}</p>
@endif
