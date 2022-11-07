@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 d-flex flex-column gap-2">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    {{ __('Questions:') }}
                    <a class="btn btn-primary" href="/add-qustion">Add new Question</a>
                </div>
            </div>
            @forelse ($questions as $item)
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span>{{ $item->name }}</span>
                        @if (isset($user->id) && isset($item->user_id))
                            @if ($item->user_id === $user->id)
                                <div class="d-flex gap-1">
                                    <a class="btn btn-primary" href="/edit-question/{{$item->id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="btn btn-danger" href="/delete-question/{{$item->id}}"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="card-body row">
                        <textarea class="col-12 form-control" disabled rows="5" >{{ $item->question }}</textarea>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span>{{ $item->created_at }}</span>
                        <div class="d-flex gap-2">
                            <a class="btn btn-primary" href="/answers/{{$item->id}}">Show Answers</i></a>
                        </div>
                    </div>
                </div>
            @empty
                <h1>Questions list is empty!</h1>
            @endforelse
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    {{ __('Filters:') }}
                    <a class="btn btn-primary" href="/"><i class="fa-solid fa-arrows-rotate"></i></a>
                </div>
                <div class="card-body">
                    <form class="form-group" action="/home" method="GET">
                        @csrf
                        <label class="form-control" for="date">Sort</label>
                        <select class="form-control" name="date" id="date">
                            <option value="DESC" @if (isset($date))
                                @if ($date === 'DESC')
                                    selected
                                @endif
                            @endif>Date ( newest )</option>
                            <option value="ASC" @if (isset($date))
                            @if ($date === 'ASC')
                                selected
                            @endif
                        @endif>Date ( oldest )</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection