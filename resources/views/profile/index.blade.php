   @extends('layouts.app')

   @section('content')
   
   
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
              </ol>
            </div>
            
          </div>
        </div>
      </div>
 <section class="content">
        <div class="container-fluid">
               @include('partials.alert')

        <section class="content">
    <div class="">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img style="width: 200px;" class="profile-user-img img-fluid img-circle" src="{{url('dist/img/user3-128x128.jpg')}}" alt="">


                        </div>

                        <h3 class="profile-username text-center" style="text-transform: uppercase">{{ $data->name }} </h3>
                        <p class="text-muted text-center">{{ $data->email }}</p>
                        <p class="text-muted text-center">{{ $data->name }}</p>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div>

                            <div>
                                <form class="form-horizontal" method="POST" action="{{ route('postProfile') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name"  id="name" class="form-control @error('email') is-invalid @enderror" value="{{ $data->name }}" required placeholder="Name">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $data->email }}" placeholder="E-mail Address">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                            </div>

                                      


                                        </div>
                                        <div class="col-12">
                                            <div class="form-group button">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Update Profile</button>
                                                {{--  <a role="button" href="admin/index.html" class="bizwheel-btn theme-2">Login</a>  --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
   
    </div>
    <!-- /.content-wrapper -->

    @endsection