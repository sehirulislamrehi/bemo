@extends("backend.template.layout")

@section('per_page_css')
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
                            <a href="#">
                                All Board
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
                         <div class="card-header text-right">
                            <a href="{{ route('board.export') }}">Export Board</a>
                        </div>
                         <div class="card card-primary card-outline table-responsive">
                              <div class="card-body">
                                   <table class="table table-bordered table-striped dataTable dtr-inline">
                                        <thead>
                                             <tr>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                  <th>Card</th>
                                                  <th>User</th>
                                                  <th>Status</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             @forelse( $visitor_boards as $key => $visitor_board )
                                             <tr>
                                                  <td>{{ $key + 1 }}</td>
                                                  <td>{{ $visitor_board->name }}</td>
                                                  <td>
                                                       @foreach( $visitor_board->card as $card )
                                                       <span class="badge badge-success">{{ $card->name }}</span>
                                                       @endforeach
                                                  </td>
                                                  <td>{{ $visitor_board->visitor->name }}</td>
                                                  <td>{{ ($visitor_board->is_active == 'Y') ? 'Active' : 'Inactive' }}</td>
                                             </tr>
                                             @empty
                                             <tr>
                                                  <td colspan="10">No data found</td>
                                             </tr>
                                             @endforelse
                                        </tbody>
                                        <tfoot>
                                             <tr>
                                                  <td>{{ $visitor_boards->links() }}</td>
                                             </tr>
                                        </tfoot>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>

          </div>
     </section>

</div>
@endsection

@section('per_page_js')
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>
@endsection
