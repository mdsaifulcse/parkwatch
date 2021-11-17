@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">   
                    <li>
                        <a href="{{ url('admin/zones') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="material-icons">list</i>
                            <span>{{ Lang::label('Zone List') }}</span>
                        </a> 
                    </li>  
                </ul>
            </div> 


            <div class="body">
                {!! Form::open(['route' => ['zones.update',$zone->id], 'method'=>'POST', 'class' => 'form-validation frmValidation', 'files' => true]) !!}

                {!! Form::hidden('id', $zone->id) !!}
                {!! Form::hidden('_method', 'PUT') !!}

                <label for="place_id">{{ Lang::label('Country') }} *</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('country_id') ? 'error focused' : '' }}">
                        {{ Form::select('country_id', $countries,  old('country_id',$zone->city->state->country->id), ['class'=>'form-control', 'required'=>true,'id'=>'countryId', 'placeholder'=>Lang::label('Select Option')]) }}
                    </div>
                    @if ($errors->has('country_id'))
                        <label class="error">{{ $errors->first('country_id') }}</label>
                    @endif
                </div>

                <label for="place_id">{{ Lang::label('Select State') }} *</label>
                <div class="form-group">

                    <div id="loadState" class="form-line  {{ $errors->has('state_id') ? 'error focused' : '' }}">
                        {{ Form::select('state_id', $states,  old('state_id',$zone->city->state->id), ['class'=>'form-control', 'required'=>true,'id'=>'stateId', 'placeholder'=>Lang::label('First Select Country')]) }}
                    </div>
                    @if ($errors->has('state_id'))
                        <label class="error">{{ $errors->first('state_id') }}</label>
                    @endif
                </div>


                <label for="place_id">{{ Lang::label('City') }} *</label>
                <div class="form-group">
                    <div id="loadCity" class="form-line  {{ $errors->has('city_id') ? 'error focused' : '' }}">
                        {{ Form::select('city_id', $cities,  old('city_id',$zone->city->id), ['class'=>'form-control', 'required'=>true,'id'=>'city_id', 'placeholder'=>Lang::label('Select Option')]) }}
                    </div>
                    @if ($errors->has('city_id'))
                        <label class="error">{{ $errors->first('city_id') }}</label>
                    @endif
                </div>


                <label for="name">{{ Lang::label('Zone Name') }} *</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('zone_name') ? 'error focused' : '' }}">
                        <input name="zone_name" type="text" id="zone_name" class="form-control" required placeholder="{{ Lang::label(' Enter Zone Name Here') }}" value="{{ old('zone_name',$zone->zone_name) }}">
                    </div>
                    @if ($errors->has('zone_name'))
                        <label class="error">{{ $errors->first('zone_name') }}</label>
                    @endif
                </div>


                <label for="status">{{ Lang::label('Status') }}</label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="switch {{ $errors->has('status') ? 'error focused' : '' }}">
                                    <label>
                                        OFF<input name="status" type="checkbox" {{ ($zone->status==\App\Models\Zone::PUBLISHED?'checked':null) }}>
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
</div>
@endsection

@section('scripts')
    <script>
        $('#countryId').on('change',function () {

            var countryId=$(this).val()


            $('#loadState').empty().html('<center><img src=" {{asset('images/loader.gif')}}"/></center>').load('{{URL::to("load-state-by-country")}}/'+countryId);

        })

    </script>
@endsection