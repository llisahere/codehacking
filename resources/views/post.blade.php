@extends('layouts.blog-home');


@section('content')

    <div class="row">

     <div class="col-md-8">



    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by {{$post->user->name}}
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo ? $post->photo->file: $post->photoPlaceholder()}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{!! $post->body !!}</p>

    <hr>


    <!-- Blog Comments -->

@if(Auth::check())
    <!-- Comments Form -->
    <div class="well">

    {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
        <input type="hidden" name="post_id" value="{{$post->id}}">

    <div class="form-group">
        {!! Form::label('body', 'Leave a comment:') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3])!!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    </div>
@endif
    <!-- Posted Comments -->

@if(count($comments) >0)
    @foreach($comments as $comment)

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            <p>{{$comment->body}}</p>

            <div class="comment-reply-container">

                <div class="comment-reply ">

                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                    <div class="form-group">
                        {{--<button class="toggle-reply btn btn-primary pull-right">Reply</button>--}}

                        <input type="hidden" name="comment_id" value="{{$comment->id}}">

                        {!! Form::label('body', 'Reply:') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>



    @if(count($comment->replies) >0)
        @foreach($comment->replies as $reply)

            @if($reply->is_active == 1)
            <!-- Nested Comment -->
            <div id="nested-comment" class="media">
                <a href="#">
                    <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
                </a>
            <div class="media-body">
                <h4 class="media-heading">{{$reply->author}}
                   <small>{{$reply->created_at->diffForHumans()}}</small>
                </h4>
                 <p>{{$reply->body}}</p>
            </div>

            <!-- End Nested Comment -->
            </div>

            @endif

         @endforeach

        <hr>
    @endif

        </div>
    </div>
    @endforeach

@endif
    </div><!--col-md-8-->

@include('includes.front_sidebar')

    </div><!--row-->
  @stop

@section('scripts')

    {{--<script>--}}
        {{--$(".comment-reply-container .toggle-reply").click(function(){--}}

            {{--$(this).next().slideToggle("slow");--}}

        {{--});--}}
    {{--</script>--}}

@stop