@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card"> 
            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">  
                    <li>
                        <a href="{{ url('admin/cities/create') }}" class="btn btn-sm btn-success waves-effect">
                            <i class="material-icons">add</i>
                            <span>{{ Lang::label('Edit City') }}</span>
                        </a>
                    </li>  
                    <li>
                        <a href="{{ url('admin/cities') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="material-icons">list</i>
                            <span>{{ Lang::label('City List') }}</span>
                        </a> 
                    </li>  
                </ul>
            </div> 


            <div class="body">
                {!! Form::open(['route' => ['cities.update',$city->id], 'method'=>'POST', 'class' => 'form-validation frmValidation', 'files' => true]) !!}

                    {!! Form::hidden('id', $city->id) !!}
                    {!! Form::hidden('_method', 'PUT') !!}


                <label for="place_id">{{ Lang::label('Country') }} *</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('country_id') ? 'error focused' : '' }}">
                        {{ Form::select('country_id', $countries,  old('country_id',$city->state->country->id), ['class'=>'form-control', 'required'=>true,'id'=>'loadState', 'placeholder'=>Lang::label('Select Option')]) }}
                    </div>
                    @if ($errors->has('country_id'))
                        <label class="error">{{ $errors->first('country_id') }}</label>
                    @endif
                </div>

                <label for="place_id">{{ Lang::label('Select State') }} *</label>
                <div class="form-group">

                    <div id="stateId" class="form-line  {{ $errors->has('state_id') ? 'error focused' : '' }}">
                        {{ Form::select('state_id', $states,old('state_id',$city->state_id), ['class'=>'form-control', 'required'=>true,'id'=>'state_id', 'placeholder'=>Lang::label('First Select Country')]) }}
                    </div>
                    @if ($errors->has('state_id'))
                        <label class="error">{{ $errors->first('state_id') }}</label>
                    @endif
                </div>


                <label for="name">{{ Lang::label('City Name') }} *</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('city_name') ? 'error focused' : '' }}">
                        <input name="city_name" type="text" id="city_name" class="form-control" required placeholder="{{ Lang::label(' Enter City Name Her') }}" value="{{ old('city_name',$city->city_name) }}">
                    </div>

                    @if ($errors->has('city_name'))
                        <label class="error">{{ $errors->first('city_name') }}</label>
                    @endif
                </div>


                <label for="status">{{ Lang::label('Status') }}</label>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="switch {{ $errors->has('status') ? 'error focused' : '' }}">
                                <label>
                                    OFF<input name="status" type="checkbox" {{ ($city->status==\App\Models\City::PUBLISHED?'checked':null) }}>
                                    <span class="lever"></span>ON
                                </label>
                                @if ($errors->has('status'))
                                    <label class="error">{{ $errors->first('status') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button type="reset" class="btn btn-danger waves-effect">{{ Lang::label('Reset') }}</button>
                            <button type="submit" class="btn btn-success waves-effect">{{ Lang::label('Update') }}</button>
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
        $('#loadState').on('change',function () {

            var countryId=$(this).val()


            $('#stateId').empty().html('<center><img src=" {{asset('images/loader.gif')}}"/></center>').load('{{URL::to("load-state-by-country")}}/'+countryId);

        })

    </script>
@endsection
