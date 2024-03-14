@extends('backend.layout.layout')

@section('content')

<!-- Taginput CSS-->
<link href="{{ url('backend/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Post Create</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Post Create</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form id="myForm" method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-header">
                                            <div class="card-title">Add New Post</div>
                                        </div>
                                        <div class="card-body">

                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            @foreach ($errors->all() as $err )
                                                                {{ $err }}
                                                            @endforeach
                                                        </div>
                                                    @endif

                                            <div class="form-group">
                                                <label for="name" class="form-label">Post Title :<span class="text-red">*</span></label>
                                                <input type="text" class="form-control" placeholder="Name" name="title" autocomplete="name" >
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="form-label">Post Description :</label>
                                                <textarea name="description" id="myTextarea" class="content"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="form-label">Post Tags :</label>
                                                <input type="text" name="meta_keywords" class="form-control" data-role="tagsinput">
                                            </div>
                                            

                                            <div class="form-group">
                                                <label for="phone">Photo</label>
                                                <input type="file" name="photo" class="form-control" id="image" />
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-9 text-secondary">
                                                    <img id="showImage" src="" style="width:200px; height: 100px;" >
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary mt-4 mb-0">Post</button>
                                            <a href="{{ route('blogs') }}" class="btn btn-default float-end">Discard</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ROW-1 END -->

                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

            <script type="text/javascript">
                $(document).ready(function(){
                    $('#image').change(function(e){
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('#showImage').attr('src',e.target.result);
                        }
                        reader.readAsDataURL(e.target.files['0']);
                    });
                });
            </script>

            <script type="text/javascript">
                $(document).ready(function (){
                    $('#myForm').validate({
                        rules: {
                            title:       { required : true,},
                            meta_keywords:       { required : true,},
                          
                        },
                        messages :{
                            title:       { required : 'Please Enter Post Title',},
                            meta_keywords:       { required : 'Please Enter Post Tags',},
                            
                        },
                        errorElement : 'span',
                        errorPlacement: function (error,element) {
                            error.addClass('invalid-feedback');
                            element.closest('.form-group').append(error);
                        },
                        highlight : function(element, errorClass, validClass){
                            $(element).addClass('is-invalid');
                        },
                        unhighlight : function(element, errorClass, validClass){
                            $(element).removeClass('is-invalid');
                        },
                    });
                });
            
            </script>
@endsection

@push('scripts')

    <script src="{{ url('backend/plugins/input-tags/js/tagsinput.js') }}"></script>

    <!-- INPUT MASK JS -->
    <script src="{{ asset('backend/plugins/input-mask/jquery.mask.min.js') }}"></script>

    <!-- INTERNAL WYSIWYG Editor JS -->
    <script src="{{ asset('backend/plugins/wysiwyag/jquery.richtext.js') }}"></script>
    <script src="{{ asset('backend/plugins/wysiwyag/wysiwyag.js') }}"></script>

@endpush