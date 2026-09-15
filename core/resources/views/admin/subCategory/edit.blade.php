@extends('admin.layouts.app')

@section('panel')
<div class="container">
    <header class="text-center">{{ $pageTitle }}</header>
    <div class="align-item-senter justify-content-between">
        <form action="{{ route('admin.post.subCategory.update', [$subCategory->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
           <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="">sub Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Category Name" value="{{ $subCategory->name }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="status">@lang('Status')</label>
                        <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="Active" data-off="Banned" data-width="100%" name="status" @if($subCategory->status) checked @endif >
                    </div>
                </div>
           </div>
           <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <textarea name="description" id="" cols="5" rows="10" class="">{{ $subCategory->description }}</textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="avatar-edit">
                        <input type='file' name="image" id="imageUpload" class="upload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload" class="imgUp"></label>
                    </div>
                    <div class="">
                        <img src="{{ getImage('assets/images/subCategory/'. $subCategory->image)}}" alt="profile-image" height="300" width="300" class="b-radius--10 w-10">
                    </div>
                </div>
           </div>
           <div class="form-group">
            <div class="col-6">
                <select class="form-select px-4 py-3 w-full rounded" name="category_id">
                    <option>Select Category</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}" selected='selected'>{{$category->name}}</option>
                    @endforeach
                 </select>
            </div>
           </div>
           <div class="form-group">
            <button class="btn btn-primary btn-block btn-lg">Update Category</button>
           </div>
        </form>
    </div>
</div>
@endsection
