  @extends('layouts.admin')
  

  @section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blogs List</h1>
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

                <table class="table table-bordered table-hover datatable-highlight data-list" id="blogTable">
                    <thead>
                        <tr>
                            <th width="3%">SL.</th>
                            <th width="20%">Title</th>
                            <th width="10%">Image</th>
                            <th width="30%">Description</th>
                            <th width="10%">Authour Name</th>
                            <th width="5%">Total Comments</th>
                            <th width="3%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($allBlogs) > 0)
                            @foreach ($allBlogs as $key => $blog)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{!! Str::words($blog->blog_title, 20, '.....') !!}</td>
                                <td><img src="{{ asset('uploads/blog/thumb/'.$blog->photo_name)}}" alt=""></td>
                                <td>{!! Str::words($blog->blog_description, 20, '.....') !!}</td>
                                <td>{{ Helper::blogAuthor($blog->id) }}</td>
                                <td>{{ Helper::blogTotalComments($blog->id) }} <a href="@if(Auth::guard('admin')->check()) {{url('blogAdminCommentList', [$blog->id])}} @else {{url('blogModeratorCommentList', [$blog->id])}}  @endif" class="btn btn-info btn-sm">Comments</a></td>
                                <td class="text-center">
                                    <a href="#" class="open-modal action-icon" modal-title="Update Blog" modal-type="update" modal-size="medium" modal-class="" selector="BlogUpdate" modal-link="@if(Auth::guard('admin')->check()) {{url('handleBlogAdmin/'.$blog->id.'/edit')}} @else {{url('handleBlogModerator/'.$blog->id.'/edit')}}  @endif"><i class="icon-pencil"></i></a>
                                    
                                    <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="@if(Auth::guard('admin')->check()) {{url('handleBlogAdmin', [$blog->id])}} @else {{url('handleBlogModerator', [$blog->id])}} @endif">@csrf </i></a>
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
        $('#blogTable').DataTable();
      });
    </script>
  @endpush

  
