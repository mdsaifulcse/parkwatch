@extends('admin.template')
 
@section('content')
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="card"> 
            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">  
                    <li>
                        <a href="{{ url('admin/parking-rules/create') }}" class="btn btn-sm btn-success waves-effect">
                            <i class="material-icons">add</i>
                            <span>{{ Lang::label('New Parking Rule') }}</span>
                        </a>
                    </li>    
                </ul>
            </div> 

            <div class="body"> 
                <div class="xtable-responsive">
                    <table class="table table-condensed table-striped dataTable-admin">
                        <thead>
                            <tr>
                                <th>{{ Lang::label('SL No.') }}</th>
                                <th>{{ Lang::label('Name') }}</th>
                                <th>{{ Lang::label('Status') }}</th> 
                                <th>{{ Lang::label('Is Legal') }}</th>
                                <th>{{ Lang::label('Action') }}</th>
                            </tr>
                        </thead>
                        {{--<tfoot>--}}
                            {{--<tr>--}}
                                {{--<th>{{ Lang::label('SL No.') }}</th>--}}
                                {{--<th>{{ Lang::label('Name') }}</th>--}}
                                {{--<th>{{ Lang::label('Status') }}</th> --}}
                                {{--<th>{{ Lang::label('Is Legal') }}</th>--}}
                                {{--<th>{{ Lang::label('Action') }}</th>--}}
                            {{--</tr>--}}
                        {{--</tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('.dataTable-admin').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        pageLength: 25, // default records per page
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: "{{ url('admin/parking-rules-data') }}",
        columns: [ 
            {data: 'rownum', name: 'rownum', searchable: false},
            {data: 'name',   name: 'name'},
            {data: 'status', name: 'status'}, 
            {data: 'is_legal', name: 'isLegal'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });
});
</script>
@endsection
