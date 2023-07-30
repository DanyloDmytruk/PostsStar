@extends('layouts.admin')

@section('main_content')
    @foreach ($bannedUsers as $bannedUser)
        <div class="list-group-item list-group-item-action py-2 lh-sm">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <a href="{{ route('blog', ['id' => $bannedUser->id]) }}" class="w-100" style="display: block;">
                    <strong class="mb-1">{{ $bannedUser->name }}</strong>
                    <div class="col-10 mb-0 small">Count of Posts: {{ $bannedUser->posts->count() }}</div>
                </a>
                <small onclick="UnbanUser('{{ $bannedUser->id }}')" class="text-danger">Unban</small>
            </div>
        </div>
    @endforeach
@endsection


@section('script')
    <script>
        function UnbanUser(id) {

            event.preventDefault();

            $.ajax({
                url: '{{ route('ajax.unbanuser') }}',
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
