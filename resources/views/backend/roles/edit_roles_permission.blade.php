@extends('backend.layout.layout')

@section('content')

<!-- Taginput CSS-->
<link href="{{ url('backend/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style type="text/css">
	.form-check-label {
		text-transform: capitalize;
	}
</style>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Add Roles Permission</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Roles Permission</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form id="myForm" method="post" action="{{ route('admin.roles.update',$role->id) }}">
                                        @csrf
                                        <div class="card-header">
                                            <div class="card-title">Add Roles Permission</div>
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
                                                <label for="name" class="form-label">Role Name :<span class="text-red">*</span></label>
                                                <input type="text" name="name" class="form-control" value="{{ $role->name }}" readonly/>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultAll">
                                                <label class="form-check-label" for="flexCheckDefaultAll">Permission All</label>
                                            </div>

                                            <hr>

                                            @foreach($permission_groups as $group)
                                                <div class="row"><!--  // Start row  -->
                                                    <div class="col-3">

                                                        @php
                                                        $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                                                        @endphp

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ App\Models\User::roleHasPermissions($role,$permissions) ? 'checked' : '' }}  >
                                                            <label class="form-check-label" for="flexCheckDefault">{{ $group->group_name }}</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-9">

                                                        @foreach($permissions as $permission)
                                                            <div class="form-check">
                                                                <input class="form-check-input" name="permission[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}  type="checkbox" value="{{$permission->id}}" id="flexCheckDefault{{$permission->id}}">
                                                            <label class="form-check-label" for="flexCheckDefault{{$permission->id}}">{{ $permission->name }}</label>
                                                        </div>
                                                        @endforeach	
                                                        <br>		
                                                    </div>

                                                </div><!--  // end row  -->
                                                @endforeach

                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary mt-4 mb-0">Post</button>
                                            <a href="{{ route('all.roles') }}" class="btn btn-default float-end">Discard</a>
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
                $('#flexCheckDefaultAll').click(function(){
                    if ($(this).is(':checked')) {
                        $('input[type = checkbox]').prop('checked',true);
                    }else{
                        $('input[type = checkbox]').prop('checked',false);
                    }
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