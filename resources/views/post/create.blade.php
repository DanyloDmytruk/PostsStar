@extends('layouts.main')

@section('main_content')
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white mt-2" style="width: 89em;">



        <form id="createPostForm" method="POST">
            @csrf

            <div class="form-group mb-2">
                <label for="title">Title </label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group mb-2">
                <label for="image">Post Image</label>
                <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}"
                    required>
            </div>

            <div class="form-group mb-2">
                <label for="description">Content</label>
                <textarea rows="17" class="form-control" name="content"></textarea>
            </div>


            <div class="form-group mb-2">
                <label for="title">Category </label>
                <select name="category" class="form-select mb-2" aria-label="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="title">Tags </label>
                <small> (separated with commas)</small>
                <input type="text" class="form-control" id="tags" name="tags">
            </div>



            <div class="form-group mb-1">
                <button type="submit" class="mr-2 btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Create
                </button>
                <button type="button" class="mr-2 btn btn-danger" onclick="location.href='{{ route('home') }}'">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </button>
            </div>

        </form>

        <script>
            $('#createPostForm').submit(function(e) {
                e.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var formData = new FormData(this);
                formData.append('_token', csrfToken);

                $.ajax({
                    url: "{{ route('ajax.createpost') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.message);
                        location.href = "{{ route('home') }}";
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        </script>
    @endsection
