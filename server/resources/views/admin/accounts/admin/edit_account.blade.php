@extends('layouts.admin.app',[
  'headers' => 'non-active',
  'menu' => 'accounts',
  'title' => 'Admin',
  'first_title' => 'Admin',
  'first_link' => route('admin.dashboard')
])

@section('content_alert')
  @if(Session::get('message'))
    <div class="alert alert-{{ Session::get('status') }} alert-dismissible fade show" role="alert">
      <span class="alert-icon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
      <span class="alert-text">{{ Session::get('message') }}</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
@endsection

@section('headers')
<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url({{ asset('img/default/profile-cover.jpg')}}); background-size: cover; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white">Hello {{ $employee->name }}</h1>
        <a href="#!" class="btn btn-neutral">Edit Banner</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('plugins_css')
<link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
@endsection

@section('content_body')
<div class="row">
  <div class="col-xl-4 order-xl-2">
    <div class="card card-profile">
      <img src="{{ asset('img/default/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top">
      <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
          <div class="card-profile-image">
            <img src="{{ 
                  !empty(auth()->guard('employee')->user()->image)
                      ? url('/storage'.'/'.auth()->guard('employee')->user()->image)
                          : asset('img/default/team-4.jpg')
              }}" alt="User Avatar" class="rounded-circle">
          </div>
        </div>
      </div>
      <br>
      <div class="text-center">
        <h5 class="h3">
          {{ $employee->name }}
        </h5>
        <div class="h5 mt-4">
          <i class="ni business_briefcase-24 mr-2"></i>{{ $employee->role }} - {{ (!empty(config('app.name')) ? config('app.name') : 'Ikada Dashboard') }}
        </div>
        <div>
          <i class="ni education_hat mr-2"></i>Jurang Belimbing
        </div>
      </div>
      <br>
    </div>
    <!-- Progress track -->
    <div class="card">
      <form action="">
        <!-- Card header -->
        <div class="card-header">
          <!-- Title -->
          <div class="row align-items-center">
            <div class="col-8">
              <h5 class="h3 mb-0">Update Photo Profile</h5>
            </div>
            <div class="col-4 text-right">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
        <!-- Card body -->
        <div class="card-body">
          <!-- Single -->
          <div class="dropzone dropzone-single mb-3" data-toggle="dropzone" data-dropzone-url="http://">
            <div class="fallback">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="projectCoverUploads">
                <label class="custom-file-label" for="projectCoverUploads">Choose file</label>
              </div>
            </div>
            <div class="dz-preview dz-preview-single">
              <div class="dz-preview-cover">
                <img class="dz-preview-img" src="..." alt="..." data-dz-thumbnail>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-xl-8 order-xl-1">
    <div class="card">
      {{-- Edit Profile --}}
      <form action="">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Edit profile </h3>
            </div>
            <div class="col-4 text-right">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="heading-small text-muted mb-4">User information</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-username">Name</label>
                  <input type="text" id="input-username" class="form-control" placeholder="Name" value="{{ $employee->name }}" name="name">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-email">Email address</label>
                  <input type="email" id="input-email" class="form-control" placeholder="Email" name="email" value="{{ $employee->email }}">
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4" />
        </div>
      </form>

      {{-- Edit Password --}}
      <form action="">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Edit Password </h3>
            </div>
            <div class="col-4 text-right">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="heading-small text-muted mb-4">Password information</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-username">New Password</label>
                  <input type="password" id="input-username" class="form-control" placeholder="Password" name="password">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-email">Confirmation New Password</label>
                  <input type="password" id="input-email" class="form-control" placeholder="Confirmation New Password" name="password_confirmation">
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4" />
        </div>
      </form>
    </div>
  </div>
</div>
  
@endsection

@section('plugins_js')
<script src="{{ asset('vendor/select2/dist/js/select2.min.js')}}"></script>
<script src="{{ asset('vendor/dropzone/dist/min/dropzone.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
@endsection