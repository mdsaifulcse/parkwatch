
@if(count($zones)>0)

    {{ Form::select('zone_id', $zones,  old('zone_id'), ['class'=>'form-control', 'required'=>true,'id'=>'zoneId', 'placeholder'=>'Select Zone']) }}

    @else
    {{ Form::select('zone_id', [],  old('zone_id'), ['class'=>'form-control', 'required'=>true,'id'=>'zoneId', 'placeholder'=>'No Zone']) }}
@endif

