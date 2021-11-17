
@if(count($parkingSpots)>0)


    {{ Form::select('place_id', $parkingSpots,  old('place_id'), ['class'=>'form-control', 'id'=>'place_id','required'=>true, 'placeholder'=>Lang::label('Select Option')]) }}

    @else
    {{ Form::select('place_id', [],  old('place_id'), ['class'=>'form-control', 'id'=>'place_id','required'=>true,'placeholder'=>'No Parking Spot']) }}
@endif

