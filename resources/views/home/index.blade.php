@extends('layouts.app')

@section('title', $pageTitle)
@section('content')
<div class="content">

    <!-- Basic card -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Isi Formulir</h5>
        </div>

        @include('layouts.message')

        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <fieldset class="mb-3">
                            <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Data Diri</legend>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control @error('name') is-invalid @enderror">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No. HP</label>
                                <input type="text" name="phone" class="form-control @error('name') is-invalid @enderror">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('name') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="4" cols="4" placeholder="Default textarea"></textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </fieldset>

                        
                        <fieldset class="mb-3">
                            <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Isi Keterangan Aduan</legend>
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Permasalahan/Aduan</label>
                                <textarea class="form-control  @error('body') is-invalid @enderror" rows="4" cols="4" name="body"></textarea>
                                @error('body')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dokumen</label>
                                <input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment">
                            </div>
                        </fieldset>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    <!-- /basic card -->

</div>
@endsection