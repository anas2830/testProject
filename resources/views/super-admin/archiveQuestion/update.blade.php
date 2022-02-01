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

              <form class="form-horizontal form-validate-jquery" action="{{route('courseQuestionArchive.update', [$question->id])}}" method="POST">
                @method('PUT')
                @csrf
                <fieldset class="content-group">
                    @if (session('msgType'))
                        <div id="msgDiv" class="alert alert-{{session('msgType')}} alert-styled-left alert-arrow-left alert-bordered">
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
                        <label class="control-label col-lg-2">Question <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea id="overviewDetails" name="question" class="form-control">
                                {{$question->question}}
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Answer Type <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="select-search" name="answer_type"  id="answer_type" required>
                                <option value="">Select Type</option>
                                @foreach ($answerType as $type)
                                <option value="{{$type->id}}" @if($type->id==$question->answer_type){{"selected"}}@endif>{{$type->answer_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="answerDiv" @if($question->answer_type<=0){{"style=display:none;"}}@endif>
                        <label class="control-label col-lg-2">Answer <span class="text-danger">*</span></label>
                        <div class="col-lg-10" id="answer_view_1"  @if($question->answer_type!=1){{"style=display:none;"}}@endif>
                            <div class="checkbox checkbox-switch">
                                {{-- <label class=toggle data-on=True data-off=False>
                                    <input type=checkbox id="answer" name="answer_tf" value="1"> <span class=button-checkbox></span>
                                </label> --}}
                                <label>
                                    <input type="checkbox" data-on-text="True" data-off-text="False" class="switch" id="answer" name="answer_tf" value="1" @if($question->answer_type==1 && @$answer[0]->true_answer==1){{"checked"}}@endif>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-10" id="answer_view_2_3" @if($question->answer_type!=2 && $question->answer_type!=3){{"style=display:none;"}}@endif>
                            @if($question->answer_type==1)
                                <div class="row">
                                    <div class="col-md-9 pr0 mb10">
                                        <input name="answer[]" placeholder="Answer" class="form-control mb-5">
                                    </div>
                                    <div class="col-md-3 btnView">
                                        <div class="toggle-custom mr10" style="display: inline-block">
                                            <label class="toggle answerCheck" data-on="Yes" data-off="No">
                                                <input name="true_answer[]" class="trueAnswer mr-5" type="{{($question->answer_type==3)?'check':'radio'}}" value="0"> <span class="button-{{($question->answer_type==3)?'check':'radio'}}"></span>
                                            </label>
                                        </div>
                                        <button id="answer_add" class="btn btn-default ml5" type="button"><i class="icon-plus-circle2"></i></button>
                                    </div>
                                </div>
                            @else 
                                <?php $lastIndex = count($answer)-1; ?>
                                @foreach($answer as $index=>$ans)
                                <div class="row">
                                    <div class="col-md-9 pr0 mb10">
                                        <input name="answer[]" placeholder="Answer" class="form-control mb-5" value="{{$ans->answer}}">
                                        <input name="answer_id[]" type="hidden" value="{{$ans->id}}">
                                    </div>
                                    <div class="col-md-3 btnView"><div class="toggle-custom mr10" style="display: inline-block">
                                        <label class="toggle answerCheck" data-on="Yes" data-off="No">
                                            <input name="true_answer[]" class="trueAnswer mr-5" type="{{($question->answer_type==3)?'checkbox':'radio'}}" value="{{$index}}" @if($ans->true_answer==1){{"checked"}}@endif> <span class="button-{{($question->answer_type==3)?'checkbox':'radio'}}"></span>
                                        </label>
                                    </div>
                                    <?php 
                                        if($lastIndex>0) { ?><button id="answer_remove" class="btn btn-default ml5" type="button"><i class="icon-minus-circle2"></i></button><?php } if($index==$lastIndex) { ?><button id="answer_add" class="btn btn-default ml5" type="button"><i class="icon-plus-circle2"></i></button><?php } 
                                    ?>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- /basic textarea -->
                    

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
                    <a href="{{route('courseQuestionArchive.index')}}" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
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
    $(document).ready(function () {
        @if (session('msgType'))
            setTimeout(function() {$('#msgDiv').hide()}, 6000);
        @endif

        $("#overviewDetails").summernote({
            height: 150
        });

        $('#answer_type').change(function(){
            var answer_type = $(this).val();
            if(answer_type) {
                if(answer_type==1) {
                    $("#answer_view_1").show();
                    $("#answer_view_2_3").hide();
                } else {
                    $("#answer_view_2_3").show();
                    $("#answer_view_1").hide();

                    if(answer_type==2) {
                        $(".answerCheck").find("input").attr("type", "radio");
                        $(".answerCheck").find("span").attr("class", "button-radio");
                    } else {
                        $(".answerCheck").find("input").attr("type", "checkbox");
                        $(".answerCheck").find("span").attr("class", "button-checkbox");
                    }
                }
                $("#answerDiv").show();
            }else{
                $("#answerDiv").hide();
            }
        });

        $("#answerDiv").on("click", "#answer_add", function(){
            var answer_type = $("#answer_type").val();
            $("#answer_view_2_3").find("#answer_add").remove();
            var trueAnswer = $("#answer_view_2_3").find(".trueAnswer:last").val();
            $("#answer_view_2_3").append('<div class="row"><div class="col-md-9 pr0 mb10"><input name="answer[]" placeholder="Answer" class="form-control"><input name="answer_id[]" type="hidden" value="0"></div><div class="col-md-3 btnView"><div class="toggle-custom mr10" style="display: inline-block"><label class="toggle answerCheck" data-on="Yes" data-off="No"><input name="true_answer[]" class="trueAnswer mr-5" value="'+(parseInt(trueAnswer)+1)+'" type="'+((answer_type==2)?'radio':'checkbox')+'"> <span class="button-'+((answer_type==2)?'radio':'checkbox')+'"></span></label></div><button id="answer_remove" class="btn btn-default ml5" type="button"><i class="icon-minus-circle2"></i></button><button id="answer_add" class="btn btn-default ml5" type="button"><i class="icon-plus-circle2"></i></button></div></div>');

            if($("#answer_view_2_3").find(".btnView:first").find("#answer_remove").length<=0) {
                $("#answer_view_2_3").find(".btnView:first").append('<button id="answer_remove" class="btn btn-default ml5" type="button"><i class="icon-minus-circle2"></i></button>');
            }
        });

        $("#answerDiv").on("click", "#answer_remove", function(){
            $(this).parents(".row").first().remove();
            if($("#answer_view_2_3").find("#answer_add").length<=0) {
                $("#answer_view_2_3").find(".btnView:last").append('<button id="answer_add" class="btn btn-default ml5" type="button"><i class="glyphicon glyphicon-plus"></i></button>');
            }
            if($("#answer_view_2_3").find(".btnView").length==1) {
                $("#answer_view_2_3").find(".btnView").find("#answer_remove").remove();
            }
            $("#answer_view_2_3").find(".trueAnswer").each(function(index){
                $(this).val(index);
            });
        });
    })
</script>
@endpush


