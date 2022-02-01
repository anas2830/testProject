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
                <button style="margin-right: 10px;"><a href="{{route('courseQuestionArchive.create')}}" class="btn btn-primary add-new">Add New</a></button>
              </div>

              <table class="table table-bordered table-hover datatable-highlight data-list" id="blogTable">
                <thead>
                    <tr>
                        <th width="5%">SL.</th>
                        <th width="60%">Question</th>
                        <th width="25%">Answer Type</th>
                        <th width="10%" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($all_quizes))
                        @foreach ($all_quizes as $key => $quiz)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{!! $quiz->question !!}</td>
                            <td>
                                @if($quiz->answer_type == 1)
                                    <span class="label label-info">True/False</span>
                                @elseif($quiz->answer_type == 2) 
                                    <span class="label label-info">Single MCQ</span>
                                @else 
                                    <span class="label label-info">Multiple MCQ</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{-- @if ($quiz->isUsed == false) --}}
                                    <a href="{{route('courseQuestionArchive.edit', [$quiz->id])}}" class="action-icon"><i class="icon-pencil7"></i></a>
                                    <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="{{route('courseQuestionArchive.destroy', [$quiz->id])}}">@csrf </i></a>
                                {{-- @else 
                                    <span class="label label-danger">Already Used</span>
                                @endif --}}
                            </td>
                        </tr> 
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No Data Found!</td>
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


