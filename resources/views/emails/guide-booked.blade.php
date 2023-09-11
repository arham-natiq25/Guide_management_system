<p>You are booked for a trip.</p>
<p>Trip name : {{ $reservation->trip->trip_name }} It is a {{ $reservation->trip->length }} trip </p>
<p>Customer Name : {{ $reservation->fname.' '.$reservation->lname }}</p>
<p>Customer Contact : {{ $reservation->phone }}</p>
<p>Customer Email : {{ $reservation->user->email }}</p>
<p>Date: {{ $reservation->date }}</p>
<p>Location : {{ $reservation->location->location_name }}</p>
<p>Time: {{ $reservation->trip->start_time }}</p>
<p>Thank you for using our service!</p>
