@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'breadcrumb')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <a href="{{ route('user.post.create') }}" class="btn btn-primary float-end">Add New Post</a>
                            {{--  <button href="" class="btn btn-primary float-end">Add New Category</button>  --}}
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Link</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            @if ($post->status == 0)
                                                <span class="badge badge-danger">Pending</span></a>
                                            @else
                                                <span class="badge badge-primary">Published</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($post->status == 1)
                                                <a href="{{ route('postView', $post->slug) }}" class="btn">Click</a>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('user.post.edit', $post->id) }}" class=""><i
                                                    class="las la-pen-fancy"></i>Edit Now</a></td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="5"> No Record Found</td>
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
