@extends('admin.layouts.app')

@section('panel')
    <div class="container">
        <header class="text-center">{{ $pageTitle }}</header>
        <div class="align-item-senter justify-content-between">
            <form action="{{ route('admin.post.subCategory.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="">Sub-Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Sub-Category Name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">@lang('Status')</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                data-offstyle="-danger" data-toggle="toggle" id="status" data-on="@lang('Enable')"
                                data-off="@lang('Disable')" name="status">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" name="image" class="file">
                        </div>
                    </div>
                    <div class="col-6">
                        <select class="form-select px-4 py-3 w-full rounded" name="category_id">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="" class="">Description</label>
                        <div class="form-group">
                            <textarea name="description" id="" cols="5" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block btn-lg">Crate a New Sub Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
