@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center gap-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    {{ __('Question:') }}
                </div>
                <div class="card-body">
                    <textarea class="col-12 form-control" disabled rows="20" >{{ $question->question }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    {{ __('Answer:') }}
                </div>
                <div class="card-body">
                    <form class="form-group row align-items-center justify-content-end gap-3" action="/answers" method="POST">
                        @csrf
                        <textarea class="form-control" class="col-12" name="answer" rows="8" placeholder="Enter your answer here..."></textarea>
                        <span>
                            @error('answer')
                                {{ $message }}
                            @enderror
                        </span>
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        <input type="hidden" name="answer_user_id" value="{{Illuminate\Support\Facades\Auth::user()->id}}">
                        <button class="btn btn-primary col-1 fbtn" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection