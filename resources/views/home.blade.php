@extends('layouts.main')

@section('main_content')
    <div class="d-flex mt-5">
        <div class="flex-fill">
            <div class="container border-bottom" style="padding-bottom: 1em; margin-bottom: 1em">
                <div class="row justify-content-md-left">
                    <div class="col-md-1">
                        <img src="avatars/{{ auth()->user()->avatar }}" title="{{ auth()->user()->name }}"
                            style="border-radius: 5%; height: 5em; width: 5em">
                        <a data-toggle="modal" data-target="#myModal" href="#" id="photoLink"><small class="fs-8"><i
                                    class="fa-solid fa-pen-to-square"></i>
                                Photo</small></button></a>
                    </div>

                    <div class="col-md-auto">
                        <div class="row justify-content-md-left mb-2">
                            <div style="width: 2.1em; padding-right: 0">
                                <i style="font-size: 21px" class="fa-solid fa-circle-info"> </i>
                            </div>
                            <div class="col-11">
                                <input id="bio" maxlength="70" style="width: 50em; margin-right: 0; padding-right: 0"
                                    placeholder="Enter your bio" class="border-0 mt-0 mb-0"
                                    value="{{ auth()->user()->bio }}">
                            </div>
                        </div>

                        <div class="row justify-content-md-left">
                            <div style="width: 2.1em; padding-right: 0">
                                <i style="font-size: 20px" class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="col-11">
                                <label>{{ auth()->user()->email }}</label>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="container border-bottom" style="padding-bottom: 1em">
                <div class="row justify-content-md-left mb-1">
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Create New
                        Post</button>
                </div>

                <div class="list-group list-group-flush border-bottom border-primary scrollarea">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm ">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <small class="text-muted">11</small>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="list-group list-group-flush border-bottom border-primary scrollarea">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm ">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <small class="text-muted">11</small>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="list-group list-group-flush border-bottom scrollarea border-primary">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <small class="text-muted">11</small>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="list-group list-group-flush border-bottom scrollarea border-primary">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <small class="text-muted">11</small>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="list-group list-group-flush border-bottom scrollarea border-primary">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <div class="d-flex justify-content-end">
                                <div class="p-1">
                                    <small class="text-muted">del up</small>
                                </div>
                                <div class="p-1">
                                    <small class="text-muted">02/12/2023</small>
                                </div>

                            </div>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="container">
                    <div class="row justify-content-md-center mb-1 mt-2">
                        <div class="col-md-auto">
                            <button type="button" class="btn btn-secondary"><i class="fa-solid fa-spinner"></i> Load
                                Other </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div>
            <div class="flex-shrink-0 p-3" style="width: 280px;">
                <span class="fs-6 border-bottom">ARCHIVE POSTS</span>
                <a href="{{ route('posts') }}"
                    class="d-flex align-items-center pb-3 mt-2 mb-3 link-dark text-decoration-none">
                    <span class="fs-6 fw-semibold"><i class="fa-solid fa-up-right-and-down-left-from-center"></i> Read
                        Lastest Posts</span>
                </a>

                <span class="fs-6 border-bottom">TOP BLOGS</span>
                <a href="/" class="d-flex align-items-center pb-3 mb-3 mt-2 link-dark text-decoration-none ">
                    <span class="fs-6 fw-semibold"></span>
                </a>

                <span class="fs-6 border-bottom">LAST POSTS</span>
                <a href="/" class="d-flex align-items-center pb-3 mb-3 mt-2 link-dark text-decoration-none">
                    <span class="fs-6 fw-semibold"></span>
                </a>

            </div>
        </div>
    </div>




    <!-- Bootstrap Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal content goes here -->
                <form id="photoForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa-solid fa-image"></i> Change Profile Photo
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input id="changeAvatar" type="file" class="form-control" name="changeAvatar"
                            value="{{ old('avatar') }}" required>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#bio").change(function() {
                var value = $(this).val();

                $.post("{{ route('ajax.changebio') }}", {
                    "_token": "{{ csrf_token() }}",
                    method: 'changebio',
                    bio: value,
                });
            });

            $('#photoForm').submit(function(e) {
                e.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var formData = new FormData(this);
                formData.append('_token', csrfToken);

                $.ajax({
                    url: "{{ route('ajax.changeavatar') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.message);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        
                    }
                });
            });

        });
    </script>
@endsection
