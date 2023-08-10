@extends('layouts.admin')

@section('main_content')
    @foreach ($unbannedUsers as $unbannedUser)
        <div class="list-group-item list-group-item-action py-2 lh-sm">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <a href="{{ route('blog', ['id' => $unbannedUser->id]) }}" class="w-100" style="display: block;">
                    <strong class="mb-1">{{ $unbannedUser->name }}</strong>
                    <div class="col-10 mb-0 small">Count of Posts: {{ $unbannedUser->posts->count() }}</div>
                </a>
                <small style="cursor: pointer" onclick="banUser('{{ $unbannedUser->id }}')" class="text-danger">Ban</small>
            </div>
        </div>
    @endforeach
@endsection


@section('script')
    <script>
        function banUser(id) {

            event.preventDefault();

            $.ajax({
                url: '{{ route('ajax.banuser') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
