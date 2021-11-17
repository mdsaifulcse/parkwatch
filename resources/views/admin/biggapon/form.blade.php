@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $title }}

                    <a href="{{ url('admin/biggapons') }}" title="Admin List" class="pull-right btn btn-xs btn-primary waves-effect"><i class="material-icons">list</i>  {{ $title }} List</a>


                </h2>
            </div>


            <div class="body">
                {!! Form::open(['route' => 'biggapons.store', 'class' => 'form-validation frmValidation', 'files' => true]) !!}

                    <label for="name">Ad Placement *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('place') ? 'error focused' : '' }}">

                            {{ Form::select('place',$places,[], ['placeholder'=>'Select One','class'=>'form-control','required'=>true]) }}

                        </div>
                        @if ($errors->has('place'))
                            <label class="error">{{ $errors->first('place') }}</label>
                        @endif
                    </div>

                    <label for="photo"> Ad Photo (00X00) </label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('photo') ? 'error focused' : '' }}">
                            <input name="image" type="file" id="photo" class="form-control" required accept="image/*" >
                            <input name="old_photo" type="hidden" value="{{ old('photo') }}">
                        </div>
                        @if ($errors->has('photo'))
                            <label class="error">{{ $errors->first('photo') }}</label>
                        @endif
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="status">{{ Lang::label('Status') }}</label>
                            </div>
                            <div class="col-sm-3">
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

                            <div class="col-sm-2">
                                <label for="email">Serial *</label>
                            </div>

                            <div class="col-sm-3">

                                <div class="form-group">
                                    <div class="form-line  {{ $errors->has('serial_num') ? 'error focused' : '' }}">
                                        <input name="serial_num" type="text" class="form-control" value="{{$max_serial}}" readonly>
                                    </div>
                                    @if ($errors->has('serial_num'))
                                        <label class="error">{{ $errors->first('serial_num') }}</label>
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


<!-- JavaScript -->
@section('scripts')
<script type="text/javascript">
$(document).ready(function()
{  
    $("#user_role").change(function(){
        showHideParkingZones($(this).val());
    });

    $(window).on("load", function(){
        showHideParkingZones('{{ old("user_role") }}');
    });

//    function showHideParkingZones(role)
//    {
//        if (role == "operator")
//        {
//            $('#place_id').slideDown(500).removeClass('hide');
//        }
//        else
//        {
//            $("#place_id").slideUp(500).addClass('hide');
//        }
//    }
}); 
</script>
@endsection
