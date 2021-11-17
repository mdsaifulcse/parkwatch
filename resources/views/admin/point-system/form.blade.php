@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">   
                    <li>
                        <a href="{{ url('admin/point-system') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="material-icons">list</i>
                            <span>{{ $title }}</span>
                        </a> 
                    </li>  
                </ul>
            </div> 


            <div class="body">
                {!! Form::open(['route' => 'point-system.store', 'method'=>'POST','class' => 'form-validation frmValidation', 'files' => true]) !!}

                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Min Point *</label>
                            <div class="form-group">
                                <div class="form-line  {{ $errors->has('min_point') ? 'error focused' : '' }}">
                                    <input name="min_point" type="number" min="0" max="999999999"  id="min_point" class="form-control" placeholder="Minimum Point" value="{{ old('min_point') }}">
                                </div>
                                @if ($errors->has('min_point'))
                                    <label class="error">{{ $errors->first('min_point') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="name">Max Point *</label>
                            <div class="form-group">
                                <div class="form-line  {{ $errors->has('max_point') ? 'error focused' : '' }}">
                                    <input name="max_point" type="number" min="0" max="999999999" id="max_point" class="form-control" placeholder="Maximum Point" value="{{ old('max_point') }}">
                                </div>
                                @if ($errors->has('max_point'))
                                    <label class="error">{{ $errors->first('max_point') }}</label>
                                @endif
                            </div>
                        </div>

                    </div> <!-- End Row -->


                <div class="row">
                    <div class="col-md-5">
                        <label for="email">Badge Name </label>
                        <div class="form-group">
                            <div class="form-line  {{ $errors->has('badge_name') ? 'error focused' : '' }}">
                                <input name="badge_name" type="text" id="badge_name" class="form-control" placeholder="Badge Name Here" value="{{ old('badge_name') }}">
                            </div>
                            @if ($errors->has('badge_name'))
                                <label class="error">{{ $errors->first('badge_name') }}</label>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="email">Add Badge Icon </label>
                        <div class="form-group">
                            <label class="slide_upload" for="file">

                                <img id="image_load" src="{{asset('images/default.png')}}" style="width: 130px;
                            height: 130px;cursor: pointer;">
                            </label>

                            <input id="file" style="display:none" name="badge_icon" type="file" onchange="photoLoad(this,this.id)" title="Good" >
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label for="status">{{ Lang::label('Status') }}</label>
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


                </div><!-- End Row -->


                <div class="form-group">
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
