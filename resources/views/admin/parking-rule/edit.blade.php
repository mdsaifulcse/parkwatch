@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">   
                    <li>
                        <a href="{{ url('admin/parking-rules') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="material-icons">list</i>
                            <span>{{ Lang::label('Parking Rule List') }}</span>
                        </a> 
                    </li>  
                </ul>
            </div> 


            <div class="body">
                {!! Form::open(['route' => ['parking-rules.update',$parkingRule->id], 'method'=>'POST', 'class' => 'form-validation frmValidation', 'files' => true]) !!}

                {!! Form::hidden('id', $parkingRule->id) !!}
                {!! Form::hidden('_method', 'PUT') !!}

                    <label for="name">{{ Lang::label('Name') }} *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('name') ? 'error focused' : '' }}">
                            <input name="name" type="text" id="name" class="form-control" required placeholder="{{ Lang::label(' Enter Rule Name Here') }}" value="{{ old('name',$parkingRule->name) }}">
                        </div>
                        @if ($errors->has('name'))
                            <label class="error">{{ $errors->first('name') }}</label>
                        @endif
                    </div>

                <label for="address">{{ Lang::label('Description') }}</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('description') ? 'error focused' : '' }}">
                        <textarea name="description" type="text" id="description" class="form-control" placeholder="{{ Lang::label('Address') }}">{{old('description',$parkingRule->description)}}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <label class="error">{{ $errors->first('description') }}</label>
                    @endif
                </div>

                <label for="address">{{ Lang::label('Vehicle Restriction') }}</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('vehicle_restriction') ? 'error focused' : '' }}">
                        <textarea name="vehicle_restriction" type="text" id="vehicle_restriction" class="form-control" placeholder="{{ Lang::label('Vehicle Restriction') }}">{{old('vehicle_restriction',$parkingRule->vehicle_restriction)}}</textarea>
                    </div>
                    @if ($errors->has('vehicle_restriction'))
                        <label class="error">{{ $errors->first('vehicle_restriction') }}</label>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="available_date_time">{{ Lang::label('Available Date') }}  *</label>
                        <div class="form-group">
                            <div class="form-line  {{ $errors->has('available_date_time') ? 'error focused' : '' }}">
                                <input name="available_date_time" type="text" id="available_date_time" class="form-control datepicker" placeholder="{{ Lang::label('Date') }} " value="{{ old('available_date_time',$parkingRule->available_date_time) }}" autocomplete="off">
                            </div>
                            @if ($errors->has('available_date_time'))
                                <label class="error">{{ $errors->first('available_date_time') }}</label>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="status">{{ Lang::label('Id Legal ?') }}</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="switch {{ $errors->has('is_legal') ? 'error focused' : '' }}">

                                        <label>
                                            OFF<input name="is_legal" type="checkbox" {{ ($parkingRule->is_legal==\App\Models\ParkingRule::YES?'checked':null) }}>
                                            <span class="lever"></span>ON
                                        </label>
                                        @if ($errors->has('is_legal'))
                                            <label class="error">{{ $errors->first('is_legal') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <label for="status">{{ Lang::label('Status') }}</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="switch {{ $errors->has('status') ? 'error focused' : '' }}">
                                        <label>
                                            OFF<input name="status" type="checkbox" {{ ($parkingRule->status==\App\Models\ParkingRule::PUBLISHED?'checked':null) }}>
                                            <span class="lever"></span>ON
                                        </label>

                                        @if ($errors->has('status'))
                                            <label class="error">{{ $errors->first('status') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- end row -->

                <div class="row">
                    <div class="col-sm-6 text-right">
                        <button type="reset" class="btn btn-danger waves-effect">{{ Lang::label('Reset') }}</button>
                        <button type="submit" class="btn btn-success waves-effect">{{ Lang::label('Save') }}</button>
                    </div>
                </div>



                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
