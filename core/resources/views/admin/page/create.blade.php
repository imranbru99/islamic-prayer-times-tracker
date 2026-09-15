@extends('admin.layouts.app')

@section('panel')
    <div class="container">
        <div class="align-item-senter justify-content-between">
            <form action="{{ route('admin.page.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="">Post Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Post Title">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" name="image" class="file">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="" class="">Page meta</label>
                        <textarea name="meta" id="" cols="2" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-5">
                        <label for="" class="">Page Description</label>
                        <textarea class="form control nicEdit" rows="4" cols="50" name="description"></textarea>
                    </div>
                </div>



                <div class="form-group">
                    <button class="btn btn-primary btn-block btn-lg">Crate a New Page</button>
                </div>
            </form>
        </div>
    </div>
@endsection
