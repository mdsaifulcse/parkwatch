
@if(count($states)>0)
{{ Form::select('state_id', $states,  old('state_id'), ['class'=>'form-control', 'required'=>true,'id'=>'stateId', 'placeholder'=>'Select State']) }}

    @else
    {{ Form::select('state_id', ['No State Found'],  old('state_id'), ['class'=>'form-control', 'required'=>true,'id'=>'stateId', 'placeholder'=>'No State Found']) }}
@endif

<script>
    $('#stateId').on('change',function () {

        var stateId=$(this).val()

        if(stateId.length===0) {
            stateId=0
            $('#loadCity').empty().html('<center><img src=" {{asset('images/loader.gif')}}"/></center>').load('{{URL::to("load-city-by-state")}}/' + stateId);
        }else {
            $('#loadCity').empty().html('<center><img src=" {{asset('images/loader.gif')}}"/></center>').load('{{URL::to("load-city-by-state")}}/' + stateId);
        }
    })
</script>

