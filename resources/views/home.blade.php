@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <div class="row">
            <div class="col-2">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                </ul>
            </div>

            <div class="col-8">
                <div class="d-flex bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        <h3>Daftar Pertanyaan</h3>
                    </div>

                    <div class="ml-auto p-2 bd-highlight">
                        <a href="/questions/ask" class="btn btn-primary" role="button">Ajukan Pertanyaan</a>
                    </div>
                </div>

                @foreach ($questions as $question)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-auto text-center">
                                    {{count($question->upvotes) - count($question->downvotes)}}
                                    <br>
                                    <small>Vote</small>
                                </div>

                                <div class="col-md-auto text-center">
                                    {{ count($question->answers) }}<br>
                                    <small>Jawaban</small>
                                </div>

                                <div class="col">
                                    <a href="/questions/{{$question->id}}" style="text-decoration: none">{{$question->title}}</a>

                                    <div class="text-right">
                                        <small class="text-muted">Ditanyakan oleh {{$question->user->name}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-2">
                right side
            </div>
        </div>
    </div>
</div>
@endsection
