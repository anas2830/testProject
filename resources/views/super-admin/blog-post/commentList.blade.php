  @extends('layouts.admin')
  

  @section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Comment List</h1>
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

        <h4 style="margin-left:3%">Post Title : {!! $blogInfo->blog_title !!}</h4>

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

                <table class="table table-bordered table-hover datatable-highlight data-list" id="commentTable">
                    <thead>
                        <tr>
                            <th width="3%">SL.</th>
                            <th width="50%">Comment</th>
                            <th width="10%">Authour Name</th>
                            <th width="3%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($allComments) > 0)
                            @foreach ($allComments as $key => $comment)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>{{ Helper::commentAuthor($comment->id) }}</td>  
                                <td class="text-center">
                                    <a href="#" class="open-modal action-icon" modal-title="Update Comment" modal-type="update" modal-size="medium" modal-class="" selector="CommentUpdate" modal-link="@if(Auth::guard('admin')->check()) {{ url('blogAdminCommentUpdate', [$comment->id]) }} @else {{ url('blogModeratorCommentUpdate', [$comment->id]) }}  @endif"><i class="icon-pencil"></i></a>
                                    
                                    <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="@if(Auth::guard('admin')->check()) {{url('blogAdminCommentDelete', [$comment->id])}} @else {{url('blogModeratorCommentDelete', [$comment->id])}}  @endif">@csrf </i></a>
                                </td>
                            </tr> 
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">No Data Found!</td>
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
        $('#commentTable').DataTable();
      });
    </script>
  @endpush

  
