@extends('front.layouts.front_design')

@section('extra_css')
  <style>
    .action-btns{
      align-items: center;
      justify-content: space-between;
    }
    .action-btns i{
      cursor: pointer;
    }
  </style>
@endsection

@section('content')

<!--Content Main start-->
<div class="height-100 bg-light">
  
  <div class="mt-5">
      <h6>My Files</h6>
      <table id="myTable" class="table table-striped">
          <thead>
              <tr>
                  <th style="width: 5%"><input type="checkbox" name="" id=""></th>
                  <th>File</th>
                  <th>Name</th>
                  <th>Size</th>
                  <th>Folder</th>
                  <th>Created</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              
          </thead>

          <tbody>
              @if (count($files))
                  
                @foreach ($files as $file)
                <tr>
                  <td><input type="checkbox" name="" id=""></td>

                  <td style="width: 5%;"><img src="{{ asset('storage/'.$file->folder->path_by_slug.'/'.$file->title) }}"
                    alt="" class="img-fluid"></td>

                  <td>{{ isset($file->original_name) ? $file->original_name : 'no caption'  }}</td>

                  <td>{{ round($file->size / 1024 ) }}kb</td>

                  <td>{{ $file->folder->title }}</td>

                  <td>{{ $file->created_at }}</td>

                  <td>{{ $file->status ? 'Approved' : 'Unapproved' }}</td>

                  <td class="action-btns">

                    <a
                      href="{{ asset('storage/'.$file->folder->path_by_slug.'/'.$file->title) }}"
                      data-fancybox="gallery"
                      data-caption="{{ isset($file->original_name) ? $file->original_name : 'no caption'  }}"
                  ><i class="bx bx-show"></i></a>

                    
                    <a href="{{ route('singleFile', $file->id) }}"><i class="bx bx-edit"></i></a></td>
              </tr>
                @endforeach
                  
              @endif
              
              
            
          </tbody>

          <tfoot>
              <tr>
                <th style="width: 5%"><input type="checkbox" name="" id=""></th>
                <th>File</th>
                <th>Name</th>
                <th>Size</th>
                <th>Folder</th>
                <th>Created</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
          </tfoot>
      </table>
  </div>

  <div class="mt-5 d-none">
      <h6>All Files</h6>
      <div class="row row-cols-1 row-cols-md-5 g-4">
          <div class="col">
              <div class="card h-100">
              <div class="folder-files">
                  <img src="/assets/images/img1.jpg" class="card-img-top" alt="...">
              </div>
              
              <div class="card-body text-center">
                  <p class="card-text">This is a short card.</p>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card h-100">
              <img src="/assets/images/pdf.png" class="card-img-top" alt="...">
              <div class="card-body text-center">
                  <p class="card-text">This is a short card.</p>
              </div>
              </div>
          </div>

          <div class="col">
          <div class="card h-100">
              <img src="/assets/images/word.png" class="card-img-top" alt="...">
              <div class="card-body text-center">
              <p class="card-text">This is a short card.</p>
              </div>
          </div>
          </div>
          <div class="col">
          <div class="card h-100">
              <img src="/assets/images/excel.png" class="card-img-top" alt="...">
              <div class="card-body text-center">
              <p class="card-text">This is a short card.</p>
              </div>
          </div>
          </div>
          <div class="col">
          <div class="card h-100">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body text-center">
              <p class="card-text">This is a short card.</p>
              </div>
          </div>
          </div>
      </div>
  </div>
</div>
<!--Content Main start-->

@endsection

@section('extra_js')
@endsection

