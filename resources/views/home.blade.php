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
                        <button type="button" class="btn btn-primary">Ajukan Pertanyaan</button>
                    </div>
                </div>
            </div>

            <div class="col-2">
                right side
            </div>
        </div>
    </div>
</div>
@endsection
