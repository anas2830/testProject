@extends('layouts.website')

@section('content')

    <div class="site-section bg-light">
      <div class="container">
        <div class="row align-items-stretch retro-layout-2">

          <div class="col-md-4">
            @foreach ($firstTwoBlogs as $key => $blog)
              <a href="{{url('single/'.$blog->id)}}" class="h-entry mb-30 v-height gradient" style="background-image: url('{{ asset('uploads/blog/'.$blog->photo_name) }}');">
                <div class="text">
                  <h2>The AI magically removes moving objects from videos.</h2>
                  <span class="date">{{ date('F j, Y', strtotime($blog->created_at)) }}</span>
                </div>
              </a>
            @endforeach
          </div>

          <div class="col-md-4" style="height:430px">
            @foreach ($middleBlogs as $key => $blog)
                  <a href="{{url('single/'.$blog->id)}}" class="h-entry img-5 h-100 gradient" style="background-image: url('{{ asset('uploads/blog/'.$blog->photo_name) }}');">
                    <div class="text">
                      <h2>The AI magically removes moving objects from videos.</h2>
                      <span class="date">{{ date('F j, Y', strtotime($blog->created_at)) }}</span>
                    </div>
                  </a>
            @endforeach
          </div>


          <div class="col-md-4">
            @foreach ($lastTwoBlogs as $key => $blog)
              <a href="{{url('single/'.$blog->id)}}" class="h-entry mb-30 v-height gradient" style="background-image: url('{{ asset('uploads/blog/'.$blog->photo_name) }}');">
                <div class="text">
                  <h2>The AI magically removes moving objects from videos.</h2>
                  <span class="date">{{ date('F j, Y', strtotime($blog->created_at)) }}</span>
                </div>
              </a>
            @endforeach
          </div>

        </div>
      </div>
    </div>



    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12">
            <h2>Recent Posts</h2>
          </div>
        </div>
        <div class="row">

         

              @foreach ($recent_posts as $post)
                <div class="col-lg-4 mb-4">
                  <div class="entry2">
                      <a href="{{url('single/'.$post->id)}}"><img src="{{ asset('uploads/blog/'.$post->photo_name) }}" alt="Image" class="img-fluid rounded" style="width: 370px;height: 250px;"></a>
                      <div class="excerpt">
                        <span class="post-category text-white bg-secondary mb-3">All</span>

                        <h2><a href="{{url('single/'.$post->id)}}">The AI magically removes moving objects from videos.</a></h2>
                        <div class="post-meta align-items-center text-left clearfix">
                          <figure class="author-figure mb-0 mr-3 float-left"><img src="{{ asset('uploads/userProfile/'.$post->authorImage) }}" alt="Image" class="img-fluid"></figure>
                          <span class="d-inline-block mt-1">By <a href="{{url('single/'.$post->id)}}">{{ $post->authorName }}</a></span>
                          <span>&nbsp;-&nbsp; {{ date('F j, Y', strtotime($post->created_at)) }}</span>
                        </div>
                        
                          <p>{!! Str::words($post->blog_description, 60, '.....') !!}</p>
                          <p><a href="{{url('single/'.$post->id)}}">Read More</a></p>
                      </div>
                  </div>
                </div>
              @endforeach


        </div>

      </div>
    </div>

    {{-- <div class="site-section bg-light">
      <div class="container">

        <div class="row align-items-stretch retro-layout">
          
          <div class="col-md-5 order-md-2">
            <a href="{{url('single/'.$blog->id)}}" class="hentry img-1 h-100 gradient" style="background-image: url('{{ asset('website')}}/images/img_4.jpg');">
              <span class="post-category text-white bg-danger">Travel</span>
              <div class="text">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
              </div>
            </a>
          </div>

          <div class="col-md-7">
            
            <a href="{{url('single/'.$blog->id)}}" class="hentry img-2 v-height mb30 gradient" style="background-image: url('{{ asset('website')}}/images/img_1.jpg');">
              <span class="post-category text-white bg-success">Nature</span>
              <div class="text text-sm">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
              </div>
            </a>
            
            <div class="two-col d-block d-md-flex">
              <a href="{{url('single/'.$blog->id)}}" class="hentry v-height img-2 gradient" style="background-image: url('{{ asset('website')}}/images/img_2.jpg');">
                <span class="post-category text-white bg-primary">Sports</span>
                <div class="text text-sm">
                  <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                  <span>February 12, 2019</span>
                </div>
              </a>
              <a href="{{url('single/'.$blog->id)}}" class="hentry v-height img-2 ml-auto gradient" style="background-image: url('{{ asset('website')}}/images/img_3.jpg');">
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

@endsection