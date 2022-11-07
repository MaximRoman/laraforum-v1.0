@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center gap-2">
            <div class="col-md-12">
                @forelse ($question as $item)
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            {{ __('Question:') }}
                            <span>{{ $item->name }}</span>
                        </div>
                        <div class="card-body">
                            <textarea class="col-12 form-control" disabled rows="20" >{{ $item->question }}</textarea>
                        </div>
                        <div class="card-footer">
                            <span>{{ $item->created_at }}</span>
                        </div>
                    </div>
                @empty
                    
                @endforelse
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        {{ __('Answer:') }}
                    </div>
                    <div class="card-body">
                        <form class="form-group row align-items-center justify-content-end gap-3" action="/answers/{{$answer->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            <textarea class="form-control" class="col-12" name="answer" rows="8" placeholder="Enter your answer here...">{{ $answer->answer }}</textarea>
                            <span>
                                @error('answer')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="hidden" name="question_id" value="{{$answer->question_id}}">
                            <input type="hidden" name="answer_user_id" value="{{Illuminate\Support\Facades\Auth::user()->id}}">
                            <button class="btn btn-primary col-1 fbtn" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection