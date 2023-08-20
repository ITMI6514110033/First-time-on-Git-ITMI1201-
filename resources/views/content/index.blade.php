@extends('master');

@section('title', 'Content CRUD');

@section('content')

    <h1>First time to my blog content.</h1>


    <div class="mb-2">
        <a href="{{ url('content/create') }}" role="button" class="btn btn-sm btn-success">Create Content</a>
        <a href="{{ url("/") }}" role="button"class="btn btn-sm btn-warning">Main Menu</a>
        <a href="{{ url("/login")}}" role="button" class="btn btn-primary">logout</a>
    </div>
    <div>

    </div>
    <table class="table table-bordered" id="tbContent">
        <thead>
            <tr>
                <th>ID</th>
                <th>Topic</th>
                <th>Tags</th>
                <th>Links</th>
                <th>Create Date</th>
                <th>Status</th>
                <th style="width: 150px">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($contents as $content)
                <tr>
                    <td>{{ $content->id }}</td>

                    <td><a href="{{ url('#') }}" class="detail-item" data-detail="{{ $content->description }}"
                            data-topic="{{ $content->topic }}">{{ $content->topic }}</a>
                    </td>

                    <td>{{ $content->tags }}</td>
                    <td><a href="{{ $content->links }}" target="_blank">{{ $content->links }}</a></td>
                    <td>{{ $content->created_at->format('d/m/Y H:i') }}</td>
                    @if ($content->status)
                        <td>แสดง</td>
                    @else
                        <td>ไม่แสดง</td>
                    @endif
                    <td>
                        <a href="{{ url("content/{$content->id}/edit") }}" role="button"
                            class="btn btn-sm btn-warning">Edit</a>

                        @if ($content->status)
                            <button type="button" class="btn btn-danger delete-item"
                                data-id="{{ $content->id }}">Disable</button>
                        @else
                            <button type="button" class="btn btn-success delete-item"
                                data-id="{{ $content->id }}">Enable</button>
                        @endif

                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $contents->links() }}

@endsection

@push('script')
    <script>
        document.querySelector('#tbContent').addEventListener('click', (e) => {
            if (e.target.matches('.delete-item')) {
                console.log(e.target.dataset.id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be edit status!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'

                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete($url + '/content/' + e.target.dataset.id).then((response) => {
                            Swal.fire(
                                'Success!',
                                'Your status has been edited.',
                                'success'
                            );

                            setTimeout(() => {
                                window.location.href = $url + '/content';
                            }, 2000);

                        });
                    }
                });

            } else if (e.target.matches('.detail-item')) {

                Swal.fire({
                    title: '[' + e.target.dataset.topic + ']',
                    text: e.target.dataset.detail,
                    icon: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Close'
                });
            }


        });
    </script>
@endpush
