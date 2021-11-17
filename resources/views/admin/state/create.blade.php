@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">   
                    <li>
                        <a href="{{ url('admin/states') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="material-icons">list</i>
                            <span>{{ Lang::label('State List') }}</span>
                        </a> 
                    </li>  
                </ul>
            </div> 


            <div class="body">
                {!! Form::open(['route' => 'states.store', 'method'=>'POST', 'class' => 'form-validation frmValidation', 'files' => true]) !!}


                <label for="place_id">{{ Lang::label('Country') }} *</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('country_id') ? 'error focused' : '' }}">
                        {{ Form::select('country_id', $countries,  old('country_id'), ['class'=>'form-control', 'required'=>true,'id'=>'country_id', 'placeholder'=>Lang::label('Select Option')]) }}
                    </div>
                    @if ($errors->has('country_id'))
                        <label class="error">{{ $errors->first('country_id') }}</label>
                    @endif
                </div>


                <label for="name">{{ Lang::label('State Name') }} *</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('state_name') ? 'error focused' : '' }}">
                        <input name="state_name" type="text" id="state_name" class="form-control" required placeholder="{{ Lang::label(' Enter State Name Here') }}" value="{{ old('state_name') }}">
                    </div>
                    @if ($errors->has('state_name'))
                        <label class="error">{{ $errors->first('state_name') }}</label>
                    @endif
                </div>


                <label for="status">{{ Lang::label('Status') }}</label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="switch {{ $errors->has('status') ? 'error focused' : '' }}">
                                    <label>
                                        OFF<input name="status" type="checkbox" checked="" value="{{\App\Models\State::PUBLISHED}}">
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
