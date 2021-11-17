@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-sm-6">
        <div class="card">
            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">   
                    <li>
                        <a href="{{ url('admin/place/list') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="material-icons">list</i>
                            <span>{{ Lang::label('Parking Spot') }}</span>
                        </a> 
                    </li>  
                </ul>
            </div> 
            
            <div class="body">
                {!! Form::open(['url' => 'admin/place/new', 'class' => 'form-validation frmValidation', 'files' => true]) !!}

                    <label for="place_id">{{ 'Country' }} *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('country_id') ? 'error focused' : '' }}">
                            {{ Form::select('country_id', $countries,  old('country_id'), ['class'=>'form-control', 'required'=>true,'id'=>'countryId', 'placeholder'=>Lang::label('Select Option')]) }}
                        </div>
                        @if ($errors->has('country_id'))
                            <label class="error">{{ $errors->first('country_id') }}</label>
                        @endif
                    </div>


                    <label for="place_id">{{ 'Select State' }} *</label>
                    <div class="form-group">

                        <div id="loadState" class="form-line  {{ $errors->has('state_id') ? 'error focused' : '' }}">
                            {{ Form::select('state_id', [],  old('state_id'), ['class'=>'form-control', 'required'=>true, 'placeholder'=>Lang::label('First Select Country')]) }}
                        </div>
                        @if ($errors->has('state_id'))
                            <label class="error">{{ $errors->first('state_id') }}</label>
                        @endif
                    </div>


                    <label for="place_id">{{ 'City' }} *</label>
                    <div class="form-group">
                        <div id="loadCity" class="form-line  {{ $errors->has('city_id') ? 'error focused' : '' }}">
                            {{ Form::select('city_id', [],  old('city_id'), ['class'=>'form-control', 'id'=>'cityId','required'=>true, 'placeholder'=>'Select City']) }}
                        </div>
                        @if ($errors->has('city_id'))
                            <label class="error">{{ $errors->first('city_id') }}</label>
                        @endif
                    </div>


                    <label for="place_id">{{ 'Zone' }} *</label>
                    <div class="form-group">
                        <div id="loadZone" class="form-line  {{ $errors->has('user_id') ? 'error focused' : '' }}">
                            {{ Form::select('zone_id', [],  old('zone_id'), ['class'=>'form-control', 'required'=>true,'id'=>'zoneId', 'placeholder'=>Lang::label('Select Option')]) }}
                        </div>
                        @if ($errors->has('zone_id'))
                            <label class="error">{{ $errors->first('zone_id') }}</label>
                        @endif
                    </div>

                @roles('superadmin')
                    <label for="place_id">{{ 'Parking Owner' }} *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('user_id') ? 'error focused' : '' }}">
                            {{ Form::select('user_id', $users,  old('user_id'), ['class'=>'form-control', 'required'=>true, 'placeholder'=>'Select Parking Owner']) }}
                        </div>
                        @if ($errors->has('user_id'))
                            <label class="error">{{ $errors->first('user_id') }}</label>
                        @endif
                    </div>
                @endroles

                @roles('admin')
                    <label for="place_id">{{ 'Parking Owner' }} *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('city_id') ? 'error focused' : '' }}">
                            {{ Form::select('user_id', $users,  old('user_id'), ['class'=>'form-control', 'required'=>true, 'placeholder'=>'Select Parking Owner']) }}
                        </div>
                        @if ($errors->has('user_id'))
                            <label class="error">{{ $errors->first('user_id') }}</label>
                        @endif
                    </div>
                @endroles


                    <label for="place_id">{{ 'Parking Rule' }} *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('city_id') ? 'error focused' : '' }}">
                            {{ Form::select('parking_rule_id', $parkingRules,  old('parking_rule_id'), ['class'=>'form-control', 'required'=>true, 'placeholder'=>'Select Parking Owner']) }}
                        </div>
                        @if ($errors->has('parking_rule_id'))
                            <label class="error">{{ $errors->first('parking_rule_id') }}</label>
                        @endif
                    </div>



                    <label for="title">{{ Lang::label('Name') }} *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('name') ? 'error focused' : '' }}">
                            <input name="name" type="text" id="title" class="form-control" required  placeholder="{{ Lang::label('Name') }}" value="{{old('name')}}">

                        </div>

                        @if ($errors->has('name'))
                            <label class="error">{{ $errors->first('name') }}</label>
                        @endif
                    </div>

                    <label for="lngLat">{{ Lang::label('Latitude & Longitude') }} *</label>
                    <div id="lngLat" class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-line  {{ $errors->has('latitude') ? 'error focused' : '' }}">
                                    <input name="latitude" type="text" id="latitude" required class="form-control" placeholder="{{ Lang::label('Latitude') }}" value="{{ old('latitude') }}">
                                </div>
                                @if ($errors->has('latitude'))
                                    <label class="error">{{ $errors->first('latitude') }}</label>
                                @endif
                            </div>
                            <div class="col-sm-5">
                                <div class="form-line  {{ $errors->has('longitude') ? 'error focused' : '' }}">
                                    <input name="longitude" type="text" id="longitude" required class="form-control" placeholder="{{ Lang::label('Longitude') }}" value="{{ old('longitude') }}">
                                </div>
                                @if ($errors->has('longitude'))
                                    <label class="error">{{ $errors->first('longitude') }}</label>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                <button type="button" onclick="placeMarker()" class="btn btn-primary">+</button>
                            </div>
                        </div>  
                    </div> 
 
                    <label for="address">{{ Lang::label('Address') }} *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('address') ? 'error focused' : '' }}">
                            <textarea name="address" type="text" id="address" required class="form-control" placeholder="{{ Lang::label('Address') }}">{{ old('address') }}</textarea>
                        </div>
                        @if ($errors->has('address'))
                            <label class="error">{{ $errors->first('address') }}</label>
                        @endif
                    </div>

                    <label for="limit">{{ Lang::label('Limit') }} *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('limit') ? 'error focused' : '' }}">
                            <input name="limit" type="text" id="limit" required class="form-control" placeholder="{{ Lang::label('Parking Limit') }}" value="{{ old('limit') }}">
                        </div>
                        @if ($errors->has('limit'))
                            <label class="error">{{ $errors->first('limit') }}</label>
                        @endif
                    </div>

                    <label for="space">{{ Lang::label('Space') }} * 
                        <small class="text-success">({{ Lang::label('Use Comma to Separate Input') }})</small>
                        <button type="button" id="autoGenerateSerial" class="btn btn-xs bg-cyan  waves-effect">
                            <i class="material-icons">sync</i>
                        </button> 
                    </label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('space') ? 'error focused' : '' }}">
                            <input name="space" type="text" id="space" class="form-control" data-role="tagsinput" placeholder="{{ Lang::label('Space') }}" value="{{ (old('space')) }}">
                        </div>
                        @if ($errors->has('space'))
                            <label class="error">{{ $errors->first('space') }}</label>
                        @endif
                    </div>


                    <div class="input-group">
                        <label for="available_form">Available From *</label>
                        <div class="form-line  {{ $errors->has('available_from') ? 'error focused' : '' }}">
                            <input name="available_from" type="text" id="available_from" class="form-control datetimepicker findScheduleAndPrice" placeholder="Available Start From" value="{{ (old('available_from')?old('available_from'):date('Y-m-d H:i')) }}" required>
                        </div>

                        @if ($errors->has('available_from'))
                            <label class="error">{{ $errors->first('available_from') }}</label>
                        @endif
                    </div>

                    <div class="input-group">
                        <label for="available_to">Available To *</label>
                        <div class="form-line  {{ $errors->has('available_to') ? 'error focused' : '' }}">
                            <input name="available_to" type="text" id="available_to" class="form-control datetimepicker findScheduleAndPrice" placeholder="Available End To" value="{{old('available_to')}}" required >
                        </div>
                        @if ($errors->has('available_to'))
                            <label class="error">{{ $errors->first('available_to') }}</label>
                        @endif
                    </div>



                    <label for="note">{{ Lang::label('Note') }}</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('note') ? 'error focused' : '' }}">
                            <textarea name="note" type="text" id="note" class="form-control" placeholder="{{ Lang::label('Note') }}">{{ old('latitude') }}</textarea>
                        </div>
                        @if ($errors->has('note'))
                            <label class="error">{{ $errors->first('note') }}</label>
                        @endif
                    </div>

                    <label for="status">{{ Lang::label('Status') }}</label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="switch {{ $errors->has('status') ? 'error focused' : '' }}">
                                    <label>
                                        OFF<input name="status" type="checkbox" checked="" value="1">
                                        <span class="lever"></span>ON
                                    </label>
                                    @if ($errors->has('status'))
                                        <label class="error">{{ $errors->first('status') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="reset" class="btn btn-danger waves-effect">{{ Lang::label('Reset') }}</button>
                                <button type="submit" class="btn btn-success waves-effect">{{ Lang::label('Save') }}</button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <div class="col-sm-6">
        <div class="card">
            <div class="header">
                <h2>Google Map <small>Click on the map to set a marker. (<span id="error" class="text-danger">Location tracked automatically.</span>)</small></h2>
            </div> 

            <div class="body">
                <label for="address">{{ Lang::label('Map Preview') }}</label>
                <div class="form-group">
                    <div id="map" style="width:100%;height:400px"></div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- JavaScript -->
<script type="text/javascript">

    var checkbox = document.getElementById('autoGenerateSerial');
    checkbox.addEventListener( 'click', function() {
        var serial = '';
        var serialText = '';
        var limit = document.getElementById("limit").value;
        if(limit > 0) {
            for(var i = 1; i <= limit; i++)
            {
                serial = i+", "+serial;
                serialText = serialText+"<span class=\"tag label label-info\">"+i+"<span data-role=\"remove\"></span></span> "; 
            }
        } else {
            $(".bootstrap-tagsinput").html('');
            $("#space").val('');
        } 
        $(".bootstrap-tagsinput").html(serialText);
        $("#space").val(serial);
    });
 

    // settings from database   
    var map, marker, infowindow;
    var latitude  = parseFloat("{{ ($setting->latitude?$setting->latitude:1) }}");
    var longitude = parseFloat("{{ ($setting->longitude?$setting->longitude:1) }}");

    function initMap() 
    {
        // initial map setting
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          mapTypeId: 'roadmap',
        });
        map.setCenter({lat: latitude, lng: longitude});

        // find geoLocation
        if (!latitude || !longitude)
        if (navigator.geolocation) 
        {
            navigator.geolocation.getCurrentPosition(function geolocationSuccess(position) { 
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;

                map.setCenter({
                    lat: position.coords.latitude, 
                    lng: position.coords.longitude
                });
            }, function() {
                document.getElementById('error').innerHTML = 'browser doesn\'t support geolocation'; 
                document.getElementById('error').classList.remove("sr-only"); 
            });
        }    
        
        marker = new google.maps.Marker({
            position: {lat: latitude, lng: longitude},
            map: map,
            draggable: false
        });
        marker.setPosition({lat: latitude, lng: longitude});

        var title = document.getElementById('title').value;
        infowindow = new google.maps.InfoWindow({
            content: '<strong style="color:green;font-weight:bolder">'+(title?title:"My Location")+'</strong>'
        }); 
        infowindow.open(map, marker);


        // add marker
        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
            document.getElementById('latitude').value = event.latLng.lat();
            document.getElementById('longitude').value = event.latLng.lng();
        }); 
    } 


    // add a marker
    function placeMarker(location = null) {

        if (!location) 
        {
            location = {
                lat: parseFloat(document.getElementById('latitude').value),
                lng: parseFloat(document.getElementById('longitude').value),
            }
        } 

        if (marker) { 
            marker.setPosition(location);
        } else {
            marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable: false
            });
        }

        // add custom label
        if (infowindow)
        {
            infowindow.close();
        } 
        var title = document.getElementById('title').value;
        infowindow = new google.maps.InfoWindow({
            content: '<strong style="color:green;font-weight:bolder">'+(title?title:"My Location")+'</strong>'
        }); 
        infowindow.open(map, marker);

        marker.setMap(map);      
    } 

    // chnage marker title
    document.getElementById("title").addEventListener('keyup', function() {
        placeMarker({
            lat: parseFloat(document.getElementById('latitude').value),
            lng: parseFloat(document.getElementById('longitude').value),
        });
    });

    // chnage marker by latitude
    document.getElementById("latitude").addEventListener('keyup', function() {
        placeMarker({
            lat: parseFloat(document.getElementById('latitude').value),
            lng: parseFloat(document.getElementById('longitude').value),
        });
    });

    // chnage marker by longitude
    document.getElementById("longitude").addEventListener('keyup', function() {
        placeMarker({
            lat: parseFloat(document.getElementById('latitude').value),
            lng: parseFloat(document.getElementById('longitude').value),
        });
    });
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $setting->map_api_key }}&maptype=roadmap&libraries=places&callback=initMap"></script>


    <script>
        $('#countryId').on('change',function () {

            var countryId=$(this).val()
            $('#cityId').empty()

            $('#loadState').empty().html('<center><img src=" {{asset('images/loader.gif')}}"/></center>').load('{{URL::to("load-state-by-country")}}/'+countryId);

        })

    </script>
@endsection

