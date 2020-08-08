@extends('layouts.admin.app',[
  'headers' => 'active',
  'menu' => 'categories',
  'title' => 'Categories',
  'first_title' => 'Category',
  'first_link' => route('admin.category.index'),
  'second_title' => 'show',
  'second_link' => route('admin.category.show', $category->id),
  'third_title' => $category->name
])

@section('content_alert')
<div id="alert-section">
  @if(Session::get('message'))
    <div class="alert alert-{{ Session::get('status') }} alert-dismissible fade show alert-result" role="alert">
      <span class="alert-icon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
      <span class="alert-text">{{ Session::get('message') }}</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
</div>
@endsection

@section('content_body')
<div class="row">
  <div class="col-lg-6">
    <div class="card-wrapper">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">{{ $category->name }} Detail Information</h3>
        </div>
        <div class="card-body">
          {{-- name --}}
          <div class="row">
            <div class="col-6">
              <h3 class="mb-0">Category Name</h3>
            </div>
            <div class="col-6">
              <h4 class="mb-0">{{ $subcategory->name}}</h4>
            </div>
          </div>
          <hr>

          {{-- description --}}
          <div class="row">
            <div class="col-6">
              <h3 class="mb-0">Desciption</h3>
            </div>
            <div class="col-6">
              <h4 class="mb-0">{{ $subcategory->description}}</h4>
            </div>
          </div>
          <hr>

          {{-- schedule --}}
          <div class="row">
            <div class="col-6">
              <h3 class="mb-0">Schedule</h3>
            </div>
            <div class="col-6">
              <h4 class="mb-0">Every {{ $subcategory->schedule}}</h4>
            </div>
          </div>
          <hr>

          {{-- youtube --}}
          <div class="row">
            <div class="col-6">
              <h3 class="mb-0">Link Youtube</h3>
            </div>
            <div class="col-6">
              <h4 class="mb-0">{{ $subcategory->link_youtube}}</h4>
            </div>
          </div>
          <hr>

          {{-- Social Media --}}
          <div class="row">
            <div class="col-6">
              <h3 class="mb-0">Social Media</h3>
            </div>
            <div class="col-6">
              <h4 class="mb-0">
                <a href="{{ $subcategory->instagram }}" target="_blank">Instagram</a> || 
                <a href="{{ $subcategory->whatsapp }}" target=_blank>Whatsapp</a>
              </h4>
            </div>
          </div>
          <hr>

          {{-- Status --}}
          <div class="row">
            <div class="col-6">
              <h3 class="mb-0">Status</h3>
            </div>
            <div class="col-6">
              <h4 class="mb-0">{{ ($subcategory->is_active == 1) ? 'Active' : 'Non-Active' }}</h4>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-6">
              <h3 class="mb-0">Category Image</h3>
            </div>
            <div class="col-6" style="justify-content: center">
              <img class="img-responsive" width="150px;" style="padding:.25rem;background:#eee;display:block;" src="{{ url('/storage'.'/'.$category->image) }}">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card-wrapper">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Category Images</h3>
        </div>
        <div class="card-body d-flex" style="flex-wrap: wrap">
            @foreach($subcategory->subCategoryImages as $item => $value)
              <div class="p-2">
                <img class="img-responsive" width="150px;" style="padding:.25rem;background:#eee;display:block;" src="{{ url('/storage'.'/'.$value->image_link) }}">
              </div> 
            @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection