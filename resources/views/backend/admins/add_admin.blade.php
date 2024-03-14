@extends('backend.layout.layout')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Create Admin</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Admin</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Create New Admin</h4>
                                    </div>
                                    <form id="myForm" method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                                <div class="">

                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            @foreach ($errors->all() as $err )
                                                                {{ $err }}
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Name<span class="text-red">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Name" name="name" autocomplete="name" >
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="username" class="form-label">User Name<span class="text-red">*</span></label>
                                                        <input type="text" class="form-control" placeholder="User Name" autocomplete="username" name="username" required>
                                                        <small class="text text-danger">Remember this username, user will login using this username</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Email address<span class="text-red">*</span></label>
                                                        <input name="email" class="form-control" type="email" placeholder="Email" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone" class="form-label">Phone</label>
                                                        <input type="phone" class="form-control" placeholder="09......" autocomplete="mobile" name="phone" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label"> Password </label>
                                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                            <a href="" class="input-group-text bg-white text-muted">
                                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                            </a>
                                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"   placeholder=" password" />
        
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">About Me</label>
                                                        <textarea class="form-control" rows="5" name="aboutme"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Assign Roles">Assign Roles</label>
                                                        <select name="roles" class="form-select mb-3" aria-label="Default select example">
                                                            <option selected="">Open this select menu</option>
                                                            @foreach($roles as $role)
                                                                @if ($role->name == 'Admin' || $role->name == 'Editor')
                                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="photo">Photo</label>
                                                        <input type="file" name="photo" class="form-control" id="image" />
                                                    </div>
                                                    
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0"></h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <img id="showImage" src="{{ (!empty($admin->photo))?url('upload/admin_images/'.$admin->photo):url('upload/profile.jpg') }}" alt="Admin" style="width:100px; height: 100px;" >
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary mt-4 mb-0">Submit</button>
                                            <a href="{{ route('all.admin') }}" class="btn btn-danger mt-4 mb-0 text-end">Cancle</a>
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
                            name:       { required : true,},
                            username:       { required : true,},
                            email:       { required : true,},
                            phone:       { required : true,},
                            password:       { required : true,},
                            address:       { required : true,},
                            photo:       { required : true,},
                        },
                        messages :{
                            name:       { required : 'Please Enter Name',},
                            username:       { required : 'Please Enter User Name',},
                            email:       { required : 'Please Enter Email',},
                            phone:       { required : 'Please Enter Mobile',},
                            password:       { required : 'Please Enter Password',},
                            address:       { required : 'Please Enter About Me',},
                            photo:       { required : 'Please Enter Photo',},
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
<!-- SHOW PASSWORD JS -->
<script src="{{ asset('backend/js/show-password.min.js') }}"></script>

@endpush