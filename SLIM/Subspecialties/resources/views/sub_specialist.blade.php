<option disabled="disabled" selected> select sub specialist</option>
@foreach($subSpecializations as $subSpecialization)
<option value="{{$subSpecialization->id}}">{{$subSpecialization->name}}</option>
@endforeach
