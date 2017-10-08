@extends('main')

@section('title', ' | Homepage')

@section('content')
    <!-- jumbotron row -->
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Hello, Welcome to my Blog</h1>
                <p class="lead">Thankyou for being a part of my test blog</p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
            </div>
        </div>
    </div>

    <!-- post list row -->
    <div class="row">
        <!-- post list column -->
        <div class="col-md-8">
            <div class="post">
                <h3>Post Title</h3>
                <p>In psychology, an attitude is a psychological construct, it is a mental and emotional entity that inheres in, or characterizes a person. They are complex and an acquired state through experiences. It is an individual's predisposed state of mind regarding a value and it is precipitated through a responsive expression toward a person, place, thing, or event (the attitude object) which in turn influences the individual's thought and action...</p>
                <a href="#" class="btn btn-primary">Read more</a>
            </div>

            <hr/>

            <div class="post">
                <h3>Post Title</h3>
                <p>In psychology, an attitude is a psychological construct, it is a mental and emotional entity that inheres in, or characterizes a person. They are complex and an acquired state through experiences. It is an individual's predisposed state of mind regarding a value and it is precipitated through a responsive expression toward a person, place, thing, or event (the attitude object) which in turn influences the individual's thought and action...</p>
                <a href="#" class="btn btn-primary">Read more</a>
            </div>

            <hr/>

            <div class="post">
                <h3>Post Title</h3>
                <p>In psychology, an attitude is a psychological construct, it is a mental and emotional entity that inheres in, or characterizes a person. They are complex and an acquired state through experiences. It is an individual's predisposed state of mind regarding a value and it is precipitated through a responsive expression toward a person, place, thing, or event (the attitude object) which in turn influences the individual's thought and action...</p>
                <a href="#" class="btn btn-primary">Read more</a>
            </div>
        </div>

        <!-- sidebar column -->
        <div class="col-md-3 col-md-offset-1">
            <h2>Sidebar</h2>
        </div>
    </div>
@endsection