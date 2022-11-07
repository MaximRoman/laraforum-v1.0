@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    {{ __('Question:') }}
                </div>
                <div class="card-body">
                    <form class="form-group row align-items-center justify-content-end gap-3" action="/home/{{$question->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <textarea class="form-control" class="col-12" name="question" rows="15" placeholder="Enter your question here...">{{$question->question}}</textarea>
                        <input type="hidden" name="user_id" value="{{Illuminate\Support\Facades\Auth::user()->id}}">
                        <button class="btn btn-primary col-1 fbtn" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection