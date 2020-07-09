@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ajukan Pertanyaan</h3>

    <div class="row mt-5">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    {{-- title goes here --}}
                    <div class="form-group">
                        <label for="questionTitle">Judul</label>
                        <small id="questionHelp" class="form-text">
                            Jelaskan dan bayangkan jika Anda sedang bertanya kepada seseorang.
                        </small>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="questionTitle"
                            placeholder="Contohnya apakah benar buwong puyoh dapat terbang?"
                        >
                    </div><br>

                    {{-- question field --}}
                    <div class="form-group">
                        <label for="questionContent">Pertanyaan</label>
                        <small id="questionContentHelp" class="form-text">
                            Masukan semua informasi yang Anda ketahui agar orang lain mau membantu menjawab masalah yang Anda tanyakan.
                        </small>
                        <textarea
                            class="form-control form-control-sm"
                            name="name"
                            rows="8"
                            cols="95"
                            id="questionContent"
                        ></textarea>
                    </div><br>

                    {{-- tags --}}
                    <div class="form-group">
                        <label for="questionTag">Tag</label>
                        <small id="questionTagHelp" class="form-text">
                            Anda dapat menambahkan lebih dari 5 tag yang berkaitan dengan pertanyaan yang Anda ajukan.
                        </small>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="questionTag"
                            placeholder="Contohnya apakah benar buwong puyoh dapat terbang?"
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
          <div class="card">
              <div class="card-body">

              </div>
          </div>
        </div>
    </div>

    <div class="mt-3">
        <button type="button" class="btn btn-primary">Simpan Pertanyaan</button>
    </div>
</div>
@endsection
