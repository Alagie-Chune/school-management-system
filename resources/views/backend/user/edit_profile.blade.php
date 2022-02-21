@extends('admin.admin_master')

@section('admin')

{{-- jQuery CDN --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->

        <!-- Main content -->
		<section class="content">

            <!-- Basic Forms -->
             <div class="box">
               <div class="box-header with-border">
                 <h4 class="box-title">Update User</h4>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">

                       <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                        @csrf
                         <div class="row">
                           <div class="col-12">	

                            {{-- First row --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control"  value="{{ $editData->name }}" required=""> 
                                        </div>
                                    </div>
                                </div>

                                {{-- Email field --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="email" class="form-control"  value="{{ $editData->email }}" required=""> 
                                        </div>
                                    </div>
                                </div>

                                {{-- Mobile field --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Mobile <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="mobile" class="form-control"  value="{{ $editData->mobile }}" required=""> 
                                        </div>
                                    </div>
                                </div>

                                {{-- Address field --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Address <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="address" class="form-control"  value="{{ $editData->address }}" required=""> 
                                        </div>
                                    </div>
                                </div>
                            </div>  {{-- End First row --}}

                            {{-- Second row --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Gender <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="gender" id="gender" required class="form-control">
                                                <option value="" selected="" disabled="">Select Gender</option>
                                                <option value="Male" {{ ($editData->gender == "Male" ? "selected" : "") }}>Male</option>
                                                <option value="Female" {{ ($editData->gender == "Female" ? "selected" : "") }}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Profile Image field --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Profile Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="image" id="image" class="form-control"> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="controls">
                                            <img id="showImage" src="{{ (!empty($user->image)) ? url('upload/user_images/'.$user->image) : url('upload/no_image.jpg') }}" style="width:100px; height:100px; border: 1px solid #000000">
                                        </div>
                                    </div>

                                </div>
                            </div>  {{-- End Second row --}}

                           <div class="text-xs-right">
                               <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
                           </div>

                       </form>
   
                   </div>
                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
   
           </section>
           <!-- /.content -->
    
    </div>
</div>

{{-- jQuery Ajax  --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection