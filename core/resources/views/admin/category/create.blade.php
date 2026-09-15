@extends('admin.layouts.app')

@section('panel')
    <div class="container">
        <header class="text-center">{{ $pageTitle }}</header>
        <div class="align-item-senter justify-content-between">
            <form action="{{ route('admin.post.category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Category Name">
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
                            <textarea name="description" id="" cols="5" rows="10" class=""></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" name="image" class="file">
                        </div>
                        <div class="">
                            <img src="{{ getImage('assets/images/category/'. $category->image)}}" alt="profile-image" height="300" width="300" class="b-radius--10 w-10">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block btn-lg">Crate a New Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
