@extends('admin.layouts.app')

@section('panel')
    <div class="container">
        <div class="align-item-senter justify-content-between">
            <form action="{{ route('admin.page.update', $page->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="">page Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $page->name }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" name="image" class="file">
                        </div>
                        <div class="">
                            <img src="{{ asset($page->path . '/' . $page->image) }}" alt="profile-image" height="300"
                                width="300" class="b-radius--10 w-10">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="" class="">page meta</label>
                        <textarea name="meta" id="" cols="2" rows="2" class="form-control">{{ $page->meta }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-5">
                        <label for="" class="">page Description</label>
                        <textarea class="form control " rows="4" cols="50" name="description" id="editor">{{ $page->description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block btn-lg">Edit a this page</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
    <style>
        .select2-search__field {
            width: 24.75em !important;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
    <script>
        $(".select2-auto-tokenize").select2({
            tags: true,
            tokenSeparators: [","],
            dropdownParent: $(".skill-body"),
        });
    </script>
@endpush
