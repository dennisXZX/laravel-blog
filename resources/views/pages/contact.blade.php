@extends('layouts.main')

@section('title', ' | Contact')

@section('content')
    <!-- contact form -->
    <div class="row">
        <div class="col-md-12">
            <h3>Contact Me</h3>
            {{-- since we are not posting to a named route, so we use url() to specify the route --}}
            <form action="{{ url('contact') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" id="message" name="bodyMessage" placeholder="Message" maxlength="140" rows="7"></textarea>
                </div>

                <input type="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
    <!-- end contact form -->
@endsection