@extends('admin.layouts.app')

@section('panel')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <a href="{{ route('admin.post.subCategory.create') }}" class="btn btn-primary float-end">Add New Sub Category</a>
                        {{--  <button href="" class="btn btn-primary float-end">Add New Category</button>  --}}
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subCategories as $subCategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subCategory->name }}</td>
                                    <td><a href="{{ route('admin.post.subCategory.edit', $subCategory->id) }}" class=""><i class="las la-pen-fancy"></i></a></td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"> No Record Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                            {{--  {{ $subject->links() }}  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
