
@if(count($cities)>0)
{{ Form::select('city_id', $cities,  old('city_id'), ['class'=>'form-control', 'id'=>'cityId', 'required'=>true, 'placeholder'=>'Select City']) }}

    @else
    {{ Form::select('city_id', ['No City Found'],  old('city_id'), ['class'=>'form-control', 'required'=>true,'id'=>'cityId', 'placeholder'=>'No City Found']) }}
@endif


<script>
    $('#cityId').on('change',function () {

        //return console.log('132')

        var cityId=$(this).val()

        if(cityId.length===0) {
            cityId=0
            $('#loadZone').empty().html('<center><img src=" {{asset('images/loader.gif')}}"/></center>').load('{{URL::to("load-zone-by-city")}}/' + cityId);
        }else {
            $('#loadZone').empty().html('<center><img src=" {{asset('images/loader.gif')}}"/></center>').load('{{URL::to("load-zone-by-city")}}/' + cityId);
        }
    })
</script>