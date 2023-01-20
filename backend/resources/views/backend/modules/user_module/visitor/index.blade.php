@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('visitor.all') }}">
                                All Visitor
                            </a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline table-responsive">
                        <div class="card-header text-right">
                            
                        </div>
                        <div class="card-body">

                            <form action="{{ route('visitor.all') }}" method="get">
                                @csrf
                                <!-- search start -->
                                <div class="search-box d-block text-right">
                                    <input type="search" name="search" value="{{ isset($result) ? $result : '' }}">
                                    <button type="submit" >
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <!-- search end -->
                            </form>

                            <form action="{{ route('delete.visitor') }}">
                                <table class="table table-bordered table-striped dataTable dtr-inline" >
                                    <thead>
                                        <tr>
                                            @if( can("delete_message") )
                                            <th>
                                                <input type="checkbox" id="check-all">
                                            </th>
                                            @endif
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse( $visitors as $key => $visitor )
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="visitor_ids[]" value="{{ $visitor->id }}">
                                            </td>
                                            <th>{{$visitor->name}}</th>
                                            <th>{{ $visitor->email }}</th>
                                            <th>
                                                {{ $visitor->created_at->toDayDateTimeString() }}
                                            </th>
                                            <th>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown-{{ $visitor->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown-{{ $visitor->id }}">
                                                    
                                                        @if( can("reset_password_visitor")  )
                                                        <a class="dropdown-item" href="#" data-content="{{ route('visitor.reset.password.modal',encrypt($visitor->id)) }}" data-target="#myModal" data-toggle="modal">
                                                            <i class="fas fa-key"></i>
                                                            Reset Password
                                                        </a>
                                                        @endif

                                                        @if( can("visitor") )
                                                        <a class="dropdown-item" href="#" data-content="{{ route('visitor.view',encrypt($visitor->id)) }}" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                                                            <i class="fas fa-eye"></i>
                                                            View
                                                        </a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No Data Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-danger">
                                        Delete
                                </button>
                            </form>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    {{ $visitors->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>

<script src="{{ asset('backend/js/datatable/jquery.validate.js') }}"></script>
<script src="{{ asset('backend/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/datatable/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>

<script>
     $(function () {
          $('.user-datatable').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ route('visitor.data') }}",
               order: [
                    [0, 'Desc']
               ],
               columns: [{
                         data: 'id',
                         name: 'id'
                    },
                    {
                         data: 'name',
                         name: 'name'
                    },
                    {
                         data: 'email',
                         name: 'email'
                    },
                    {
                         data: 'phone',
                         name: 'phone'
                    },
                    {
                         data: 'visitor_type_id',
                         name: 'visitor_type_id'
                    },
                    {
                         data: 'is_verified',
                         name: 'is_verified'
                    },
                    {
                         data: 'is_active',
                         name: 'is_active'
                    },
                    {
                         data: 'action',
                         name: 'action',
                         orderable: false,
                    },
               ]
          });
     });
</script>
<script>
     $("#check-all").click(function(e){
          if(e.target.checked == true){
               $("input[type='checkbox']").attr('checked',true)
          }
          else{
               $("input[type='checkbox']").attr('checked',false)
          }
     })
</script>
@endsection
