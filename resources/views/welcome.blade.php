<p>Welcome {{$name}}</p> 
<p>You are {{$age}}</p>
<p>books</p>
@foreach($books as $book)
{{$book}}
@endforeach