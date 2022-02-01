@extends('layouts.website')

@section('content')
    
    
    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('{{ asset('uploads/blog/'.$post->photo_name) }}');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              <h1 class="mb-4"><a href="#">{{ $post->blog_title }}</a></h1>
              <div class="post-meta align-items-center text-center">
                <figure class="author-figure mb-0 mr-3 d-inline-block"><img src="{{ asset('uploads/userProfile/'.$authorInfo->photo_name) }}" alt="Image" class="img-fluid"></figure>
                <span class="d-inline-block mt-1">{{ $authorInfo->name}}</span>
                <span>&nbsp;-&nbsp; {{ date('F j, Y', strtotime($post->created_at)) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">
            
            <div class="post-content-body">

              {!! $post->blog_description !!}

            </div>


            <div class="pt-5">
              <h3 class="mb-5">{{ count($comments) }} Comments</h3>
              <ul class="comment-list">

                @foreach ($comments as $comment)
                  <li class="comment">
                      <div class="vcard">
                        <img src="{{ asset('uploads/userProfile/'.$comment->authorImage) }}" alt="Image placeholder">
                      </div>
                      <div class="comment-body">
                        <h3>{{ $comment->authorName }}</h3>
                        <div class="meta">{{ date("F j, Y, g:i a", strtotime($comment->created_at)) }}</div>
                        <p>{!! $comment->comment !!}</p>
                      </div>
                  </li>
                @endforeach




              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <div class="alert alert-dismissible" role="alert" id="Msg" style="display: none" >
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span id="text"></span>
                </div>
                <form  class="p-5 bg-light" id="commentForm">
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <input type="hidden" name="blog_id" value={{$post->id}} />
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control" required></textarea>
                    <span class="text-danger" id="commentErrorMsg"></span>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary">
                  </div>
                </form>
              </div>
            </div>

          </div>

          <!-- END main-content -->

          <div class="col-md-12 col-lg-4 sidebar">
  
            <!-- END sidebar-box -->
            <div class="sidebar-box">
              <div class="bio text-center">
                <img src="{{ asset('uploads/userProfile/'.$authorInfo->photo_name) }}" alt="Image Placeholder" class="img-fluid mb-5">
                <div class="bio-body">
                  <h2>{{ $authorInfo->name }}</h2>
                  <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>

                </div>
              </div>
            </div>
            <!-- END sidebar-box -->  
            <div class="sidebar-box">
              <h3 class="heading">Latest Posts</h3>
              <div class="post-entry-sidebar">
                <ul>

                  @foreach ($latest_posts as $rec_post)
                  <li>
                    <a href="{{url('single/'.$rec_post->id)}}">
                      <img src="{{ asset('uploads/blog/'.$rec_post->photo_name) }}" alt="Image placeholder" class="mr-4">
                      <div class="text">
                        <h4>{{ $rec_post->blog_title }}</h4>
                        <div class="post-meta">
                          <span class="mr-2">{{ date('F j, Y', strtotime($rec_post->created_at)) }}</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  @endforeach

                </ul>
              </div>
            </div>
            <!-- END sidebar-box -->

          </div>
          <!-- END sidebar -->

        </div>
      </div>
    </section>

    {{-- <div class="site-section bg-light">
      <div class="container">

        <div class="row mb-5">
          <div class="col-12">
            <h2>More Related Posts</h2>
          </div>
        </div>

        <div class="row align-items-stretch retro-layout">
          
          <div class="col-md-5 order-md-2">
            <a href="single.html" class="hentry img-1 h-100 gradient" style="background-image: url('{{ asset('website')}}/images/img_4.jpg');">
              <span class="post-category text-white bg-danger">Travel</span>
              <div class="text">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
              </div>
            </a>
          </div>

          <div class="col-md-7">
            
            <a href="single.html" class="hentry img-2 v-height mb30 gradient" style="background-image: url('{{ asset('website')}}/images/img_1.jpg');">
              <span class="post-category text-white bg-success">Nature</span>
              <div class="text text-sm">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
              </div>
            </a>
            
            <div class="two-col d-block d-md-flex">
              <a href="single.html" class="hentry v-height img-2 gradient" style="background-image: url('{{ asset('website')}}/images/img_2.jpg');">
                <span class="post-category text-white bg-primary">Sports</span>
                <div class="text text-sm">
                  <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                  <span>February 12, 2019</span>
                </div>
              </a>
              <a href="single.html" class="hentry v-height img-2 ml-auto gradient" style="background-image: url('{{ asset('website')}}/images/img_3.jpg');">
                <span class="post-category text-white bg-warning">Lifestyle</span>
                <div class="text text-sm">
                  <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                  <span>February 12, 2019</span>
                </div>
              </a>
            </div>  
            
          </div>
        </div>

      </div>
    </div> --}}


    {{-- <div class="site-section bg-lightx">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-5">
            <div class="subscribe-1 ">
              <h2>Subscribe to our newsletter</h2>
              <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nesciunt error illum a explicabo, ipsam nostrum.</p>
              <form action="#" class="d-flex">
                <input type="text" class="form-control" placeholder="Enter your email address">
                <input type="submit" class="btn btn-primary" value="Subscribe">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

@endsection


@push('javascript')
    <script type="text/javascript">

        $("#commentForm").submit(function(e) {
            e.preventDefault();
            e.stopPropagation();

            var form = document.getElementById('commentForm');
            var formdata = new FormData(form);

            $.ajax({
                type: "POST",
                url: "/comment",
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('#token').val() },
                data: formdata,
                success: function(data) {
                    console.log('success');
                    console.log(data);
                    
                    if(data.msgtype == "success"){
                        $('#Msg').removeClass('alert-danger');
                        $('#Msg').addClass('alert-success');
                        $('#text').text(data.messege);
                        $('#Msg').show();
                        setTimeout(function(){ 
                            location.reload();
                        }, 2000);
                    }else{
                        $('#Msg').removeClass('alert-success');
                        $('#Msg').addClass('alert-danger');
                        $('#text').text(data.messege);
                        $('#Msg').show();
                    }
                },
                error: function(response) {
                    console.log('error');
                    $('#commentErrorMsg').text(response.responseJSON.errors.comment);
                }
            });
        });

    </script>
@endpush
    

