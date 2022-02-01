  @extends('layouts.admin')
  

  @section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Moderator List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
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
            <div class="" style="padding:2%">

                @if (session('msgType'))
                    @if(session('msgType') == 'danger')
                      <div id="msgDiv" class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
                          <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                          <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('messege') }}
                      </div>
                    @else
                      <div id="msgDiv" class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                          <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                          <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('messege') }}
                      </div>
                    @endif
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                      <div class="alert alert-danger alert-styled-left alert-bordered">
                          <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                          <span class="text-semibold">Opps!</span> {{ $error }}.
                      </div>
                    @endforeach
                @endif

                <div class="data-list text-right">
                  <button type="button" class="btn btn-info btn-xs open-modal" modal-title="Create Moderator" modal-type="create" modal-size="medium" modal-class="" selector="Moderator" modal-link="{{url('handleModerator/create')}}" style="margin-bottom:2%; padding:5px"> Add New Moderator </button>
                </div>

                <table class="table table-bordered table-hover datatable-highlight data-list" id="blogTable">
                    <thead>
                        <tr>
                            <th width="5%">SL.</th>
                            <th width="20%">Name</th>
                            <th width="20%">Email</th>
                            <th width="20%">Thumb</th>
                            <th width="10%">Status</th>
                            <th width="10%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($allModerator) > 0)
                            @foreach ($allModerator as $key => $moderator)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $moderator->name }}</td>
                                <td>{{ $moderator->email }}</td>
                                <td><img src="{{ asset('uploads/moderatorProfile/thumb/'.$moderator->photo_name)}}" alt=""></td>
                                <td class="text-center">Active</td>
                                <td class="text-center">
                                    <a href="#" class="open-modal action-icon" modal-title="Update Moderator" modal-type="update" modal-size="medium" modal-class="" selector="ModeratorUpdate" modal-link="{{url('handleModerator/'.$moderator->id.'/edit')}}"><i class="icon-pencil"></i></a>
                                    
                                    <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="{{url('handleModerator', [$moderator->id])}}">@csrf </i></a>
                                </td>
                            </tr> 
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">No Data Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
          </div>
        </div>


    </div>
    <!-- /.content-wrapper -->


  @endsection


  @push('javascript')

    <script type="text/javascript">
      $(document).ready( function () {
        $('#blogTable').DataTable();
      });
    </script>
  @endpush

  
