@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'breadcrumb')
    <div class="container">
        <header class="text-center">{{ $pageTitle }}</header>
        <div class="align-item-senter justify-content-between">
            <form action="{{ route('user.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="">Post Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <select class="form-select px-4 py-3 w-full rounded" name="sub_category_id">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" selected='selected'>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" name="image" class="file">
                        </div>
                        <div class="">
                            <img src="{{ asset($post->path . '/' . $post->image) }}" alt="profile-image" height="300"
                                width="300" class="b-radius--10 w-10">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="" class="">Post meta</label>
                        <textarea name="meta" id="" cols="2" rows="2" class="form-control">{{ $post->meta }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-5">
                        <label for="" class="">Post Description</label>
                        <textarea class="form control" rows="4" cols="50" name="content" id="editor">{{ $post->content }}</textarea>
                    </div>
                </div>


                <div class="row">
                    <label for="skill" class="form-label">@lang('Tags')</label>
                    <div class="skill-body">
                        <select class="select2-auto-tokenize form-control form--control" multiple="multiple" name="tags[]"
                            required>
                            @if ($post->tags)
                                @foreach ($post->tags as $tag)
                                    <option value="{{ $tag->id }}" selected='selected'>{{ $tag->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block btn-lg">Edit a this Post</button>
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
