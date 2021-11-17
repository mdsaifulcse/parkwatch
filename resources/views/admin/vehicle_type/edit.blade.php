@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card"> 
            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">  
                    <li>
                        <a href="{{ url('admin/vehicle_type/new') }}" class="btn btn-sm btn-success waves-effect">
                            <i class="material-icons">add</i>
                            <span>Vehicle Size</span>
                        </a>
                    </li>  
                    <li>
                        <a href="{{ url('admin/vehicle_type/list') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="material-icons">list</i>
                            <span>Vehicle Sizes</span>
                        </a> 
                    </li>  
                </ul>
            </div> 


            <div class="body">
                {!! Form::open(['url' => 'admin/vehicle_type/edit/', 'class' => 'form-validation frmValidation', 'files' => true]) !!}

                    {!! Form::hidden('id', $vehicle->id) !!}

                    <label for="name">Vehicle Size *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('name') ? 'error focused' : '' }}">
                            <input name="name" type="text" id="name" class="form-control" placeholder="Vehicle Size" value="{{ $vehicle->name }}">
                        </div>
                        @if ($errors->has('name'))
                            <label class="error">{{ $errors->first('name') }}</label>
                        @endif
                    </div>

                    <label for="description">{{ Lang::label('Description') }} *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('description') ? 'error focused' : '' }}">
                            <textarea name="description" id="description" class="form-control" placeholder="{{ Lang::label('Description') }}">{{ $vehicle->description }}</textarea>
                        </div>
                        @if ($errors->has('description'))
                            <label class="error">{{ $errors->first('description') }}</label>
                        @endif
                    </div>




                    <label for="email">Update Vehicle Size Image </label>
                    <div class="form-group">
                        <label class="slide_upload" for="file">

                            @if(file_exists($vehicle->image))

                                <img id="image_load" src=" {{asset($vehicle->image)}}" style="width: 150px;
                                height: 150px;cursor: pointer;">
                            @else
                                <img id="image_load" name="image" src="{{asset('images/default.png')}}" style="width: 150px;
                            height: 150px;cursor: pointer;">
                                @endif
                        </label>

                        <input id="file" style="display:none" name="image" type="file" onchange="photoLoad(this,this.id)">
                    </div>


                    <label for="status">{{ Lang::label('Status') }}</label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="switch {{ $errors->has('status') ? 'error focused' : '' }}">
                                    <label>
                                        OFF<input name="status" type="checkbox" {{ ($vehicle->status?'checked':null) }}>
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
