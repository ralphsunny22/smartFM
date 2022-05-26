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
    #singleFile{
        margin-left: auto;
        margin-right: auto;
    }

    .file-header{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
  </style>
@endsection

@section('content')

<!--Content Main start-->
<div class="height-100 bg-light">
  <div class="file-header"><h5 class="file-title">File: {{ isset($file->original_name) ? $file->original_name : 'no caption'  }}</h5>
  <h5 class="file-location">Location: {{ $file->folder->path_by_title }}</h5></div>

  <form action="{{ route('singleFileEdit', $file->id) }}" method="post" enctype="multipart/form-data">@csrf
  <div id="singleFile" class="row">

    
      <div class="col">
          <div class="card">
            
            <div class="card-body text-center">
                <img src="{{ asset('storage/'.$file->folder->path_by_slug.'/'.$file->title) }}"
                alt="" class="img-fluid mb-3">
                <input type="file" name="file" id="">
            </div>
          </div>
      </div>

      <div class="col">
        <div class="card">
          
          <div class="card-body">
              
                  <label for="title">Change title</label>
                  <input type="text" class="form-control" name="title" id=""
                    value="{{ isset($file->original_name) ? $file->original_name : ''  }}" placeholder="File title">
                  <button id="file-btn" type="submit" class="btn">Submit</button>
              
            {{-- <h6 class="card-title">Total Files</h6>
            <p class="card-text">10</p> --}}
          </div>
        </div>
      </div>
    
      
  </div>
</form>

  
</div>
<!--Content Main start-->

@endsection

@section('extra_js')
@endsection

