@extends('layouts.blog-home')

@section('content')

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                My Blog
                <small>Lets chat about it!</small>
            </h1>

            <!-- First Blog Post -->

            @if($posts)

                @foreach($posts as $post)

            <h2>
                <a href="#">{{$post->title}}</a>
            </h2>
            <p class="lead">
                by {{$post->user->name}}
            </p>
            <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>
            <hr>
          {{--<img class="img-responsive" src="http://placehold.it/900x300" alt="">--}}
            <img class="img-responsive" src="{{$post->photo ? $post->photo->file: $post->photoPlaceholder()}}" alt="">

            <hr>
            <p>{!!str_limit($post->body, 300)!!}</p>
            <a class="btn btn-primary" href="/post/{{$post->id}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
            @endforeach
          @endif

            <!--pagination-->
        <div class="row">
             <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}
             </div>
        </div>

        </div>

        <!-- Blog Sidebar  -->
        @include('includes.front_sidebar')

    </div>
    <!-- /.row -->





@endsection





{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-10 col-md-offset-1">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Dashboard</div>--}}

                {{--<div class="panel-body">--}}
                    {{--You are logged in!--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}