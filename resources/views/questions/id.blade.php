@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <div class="row">
            <div class="col-2">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Pertanyaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                </ul>
            </div>

            <div class="col-10">
                <div class="d-flex bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        <h3>{{$question->title}}</h3>
                    </div>

                    <div class="ml-auto p-2 bd-highlight">
                        <a href="/questions/ask" class="btn btn-primary" role="button">Ajukan Pertanyaan</a>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-9">
                        <div class="row">
                            <div class="col-1">
                              <button type="button" class="btn btn-link btn-sm">
                                  <i class='fas fa-caret-up' style='font-size:36px'></i>
                              </button>
                              <span style='font-size:24px'>0</span>
                              <button type="button" class="btn btn-link btn-sm">
                                  <i class='fas fa-caret-down' style='font-size:36px'></i>
                              </button>
                            </div>

                            <div class="col-11">
                                {{$question->content}}
                            </div>
                        </div>
                    </div>

                    <div class="3">
                        right side
                    </div>
                </div>
            </div>
            {{-- <div class="col-8">

                <div class="row">

                </div>
            </div>

            <div class="col-2">
                right side
            </div> --}}
        </div>
    </div>
</div>
@endsection
