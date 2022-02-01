@extends('layouts.admin')
  

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
              <div class="col-sm-6">
                  <h1 class="m-0">Question</h1>
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
            
              <form class="form-horizontal form-validate-jquery" action="{{ route('classExamConfig') }}" method="POST">
                @csrf
                <fieldset class="content-group">
                    @if (session('msgType'))
                        <div id="msgDiv" class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('messege') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-styled-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">Opps!</span> {{ $error }}.
                        </div>
                        @endforeach
                    @endif

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Details <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea id="overviewDetails" name="exam_overview" class="form-control" required>{{@$examConfig->exam_overview}}
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Duration <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                <input type="number" name="exam_duration" value="{{@$examConfig->exam_duration}}" placeholder="Ex: 30" class="form-control" data-fv-icon="false" data-fv-greaterthan="true" data-fv-greaterthan-value="1" required>
                                <span class="input-group-addon">Minutes</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Per Question Mark <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="number" name="per_question_mark" value="{{@$examConfig->per_question_mark}}" placeholder="Ex: 5" class="form-control" data-fv-icon="false" data-fv-greaterthan="true" data-fv-greaterthan-value="1" required>
                                <span class="input-group-addon">Mark</span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive" style="overflow-x:auto; max-height: 500px;">
                        <table class="table table-bordered table-framed">
                            <thead>
                                <tr>
                                    <th width="10%">SL.</th>
                                    <th width="90%">Question</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($questions) > 0)
                                    @if (!empty($examConfig->questions))
                                        @php $config_questions = json_decode(@$examConfig->questions); @endphp
                                    @endif
                                    @foreach ($questions as $key => $question)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="question_id[]" value="{{$question->id}}"
                                                        @if (!empty($examConfig->questions))
                                                            @if(in_array($question->id, $config_questions)) checked @endif
                                                        @endif
                                                        >
                                                        {!! $question->question !!}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="2">No Questions Found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /basic text input -->

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary submintBtn">Submit <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>

          </div>
        </div>
      </div>


  </div>
  <!-- /.content-wrapper -->


@endsection


@push('javascript')


<script type="text/javascript">
    $(document).ready(function (e) {
        @if (session('msgType'))
            setTimeout(function() {$('#msgDiv').hide()}, 3000);
        @endif

        $("#overviewDetails").summernote({
            height: 150
        });
    })
</script>
@endpush


