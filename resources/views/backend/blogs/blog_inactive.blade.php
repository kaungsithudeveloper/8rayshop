@extends('backend.layout.layout')

@section('content')


            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">
                                Inactive Posts ( {{ count($inActivePost) }} )
                                
                            </h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Inactive Posts
                                        
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 -->
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="{{ route('admins.create') }}" class="btn btn-primary ">Create New Post</a>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="responsive-datatable" class="table table-bordered text-nowrap mb-0 table-striped">
                                                <thead class="border-top">
                                                    <tr>
                                                        <th class="bg-transparent border-bottom-0 text-center" style="width: 3%;">ID</th>
                                                        <th class="bg-transparent border-bottom-0" style="width: 20%;"> Post Title</th>
                                                        <th class="bg-transparent border-bottom-0"> post Slug</th>
                                                        <th class="bg-transparent border-bottom-0"> Description </th>
                                                        <th class="bg-transparent border-bottom-0 text-center " style="width: 10%;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($inActivePost as $key => $post)
                                                    <tr class="border-bottom">
                                                        <td class="text-center">
                                                            <div class="mt-0 mt-sm-2 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold"> {{ $key+1 }} </h6>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="ms-3 mt-0 mt-sm-2 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold"> {{ $post->title }} </h6>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="ms-3 mt-0 mt-sm-2 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold"> {{ $post->post_slug }} </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="mt-0 mt-sm-3 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                        @php
                                                                        $description = strip_tags($post->description); // Remove HTML tags
                                                                        $description = str_replace('&nbsp;', ' ', $description); // Replace &nbsp; with a space
                                                                        $maxLength = 60; // Set the maximum length you want to display
                                                                        @endphp
                                                        
                                                                        @if (strlen($description) > $maxLength)
                                                                            {{ substr($description, 0, $maxLength) }} 
                                                                        @else
                                                                            {{ $description }}
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="g-2 text-center">
                                                                <a href="{{ route('posts.edit',$post->id) }}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                                    <span class="fe fe-edit fs-14"></span>
                                                                </a>

                                                                <a href="{{ route('posts.delete',$post->id) }}" class="btn text-danger btn-sm" id="delete" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                                    <span class="fe fe-trash-2 fs-14"></span>
                                                                </a>

                                                                @if($post->status == 1)
                                                                    <a href="{{ route('post.inactive',$post->id) }}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Inactive">
                                                                        <span class="fa fa-toggle-on fs-14"></span>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('post.active',$post->id) }}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Active">
                                                                        <span class="fa fa-toggle-off fs-14"></span>
                                                                    </a>
                                                                @endif


                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- ROW-1 END -->
                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->


@endsection
@push('scripts')
    <!-- Include the JavaScript files needed for the create page -->
    <script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/js/table-data.js') }}"></script>
    
@endpush