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
                        <li class="breadcrumb-item active">
                            @if( auth('web')->check() )
                            {{ auth('web')->user()->role->name }} Dashboard
                            @elseif( auth('super_admin')->check() )
                            Super Admin Dashboard
                            @endif
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">


            </div>
            <!-- /.row -->


            <div class="row">

            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section("per_page_js")

@endsection
