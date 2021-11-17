@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card"> 
            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">  
                    <li>
                        <a href="{{ url('admin/countries/create') }}" class="btn btn-sm btn-success waves-effect">
                            <i class="material-icons">add</i>
                            <span>{{ Lang::label('New Country') }}</span>
                        </a>
                    </li>  
                    <li>
                        <a href="{{ url('admin/countries') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="material-icons">list</i>
                            <span>{{ Lang::label('Country List') }}</span>
                        </a> 
                    </li>  
                </ul>
            </div> 


            <div class="body">
                {!! Form::open(['route' => ['countries.update',$country->id], 'method'=>'POST', 'class' => 'form-validation frmValidation', 'files' => true]) !!}

                    {!! Form::hidden('id', $country->id) !!}
                    {!! Form::hidden('_method', 'PUT') !!}


                <label for="name">{{ Lang::label('Country Name') }} *</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('country_name') ? 'error focused' : '' }}">
                        <input name="country_name" type="text" id="country_name" class="form-control" required placeholder="{{ Lang::label(' Enter Country Name Her') }}" value="{{ old('country_name',$country->country_name) }}">
                    </div>

                    @if ($errors->has('name'))
                        <label class="error">{{ $errors->first('name') }}</label>
                    @endif
                </div>


                <label for="status">{{ Lang::label('Status') }}</label>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="switch {{ $errors->has('status') ? 'error focused' : '' }}">
                                <label>
                                    OFF<input name="status" type="checkbox" {{ ($country->status==\App\Models\Country::PUBLISHED?'checked':null) }}>
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
