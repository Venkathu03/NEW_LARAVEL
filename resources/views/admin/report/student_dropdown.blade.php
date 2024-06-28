<option value="">Choose</option>
@foreach($students as $student)
<option value="{{$student->id}}">{{$student->fullname}}</option>
@endforeach