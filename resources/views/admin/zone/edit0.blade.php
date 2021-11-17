@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card"> 
            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">  
                    <li>
                        <a href="{{ url('admin/zones/create') }}" class="btn btn-sm btn-success waves-effect">
                            <i class="material-icons">add</i>
                            <span>{{ Lang::label('Edit Zone') }}</span>
                        </a>
                    </li>  
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

                <label for="place_id">{{ Lang::label('City') }} *</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('state_id') ? 'error focused' : '' }}">
                        {{ Form::select('city_id', $cities,  old('city_id',$zone->city_id), ['class'=>'form-control', 'required'=>true,'id'=>'city_id', 'placeholder'=>Lang::label('Select Option')]) }}
                    </div>
                    @if ($errors->has('city_id'))
                        <label class="error">{{ $errors->first('city_id') }}</label>
                    @endif
                </div>

                <label for="name">{{ Lang::label('Zone Name') }} *</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('zone_name') ? 'error focused' : '' }}">
                        <input name="zone_name" type="text" id="zone_name" class="form-control" required placeholder="{{ Lang::label(' Enter Zone Name Her') }}" value="{{ old('zone_name',$zone->zone_name) }}">
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
