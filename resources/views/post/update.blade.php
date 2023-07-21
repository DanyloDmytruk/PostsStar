@extends('layouts.main')

@section('main_content')
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white mt-2" style="width: 89em;">


        <div class="alert alert-danger" role="alert" id="errorData">
            Error has occured. Check input data again.
        </div>

        <form id="updatePostForm" method="POST">
            @csrf

            <div class="form-group mb-2">
                <h4>{{ $post->title }} </h4>
            </div>


            <div class="form-group mb-2">
                <label for="description">Content</label>
                <textarea rows="17" class="form-control" name="content">{{ $post->content }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="title">Tags </label>
                <small> (separated with commas)</small>
                <input type="text" class="form-control" id="tags" name="tags"
                value="@foreach ($post->tags as $tag){{$tag->title.', '}}@endforeach">
                

            </div>




            <div class="form-group mb-1">
                <button type="submit" class="mr-2 btn btn-primary">
                    <i class="fa-solid fa-square-pen"></i> Update
                </button>
                <button type="button" class="mr-2 btn btn-danger" onclick="location.href='{{ route('home') }}'">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </button>
            </div>

        </form>

        <script>
            $('#errorData').hide();


            $('#updatePostForm').submit(function(e) {
                e.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var formData = new FormData(this);
                formData.append('_token', csrfToken);
                formData.append('postid', '{{ $post->id }}');

                $.ajax({
                    url: "{{ route('ajax.updatepost') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 'FAIL') {
                            $('#errorData').show();
                        } else {

                            console.log(response.message);
                            location.href = "{{ route('home') }}";
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        $('#errorData').show();
                    }
                });
            });
        </script>
    @endsection
