@extends('front.layouts.front_design')

@section('extra_css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<title>@section('extra_title') Uploads @endsection</title>

<style>
    .dropzone {
        padding: 25px!important;
        border: 2px dashed rgba(0,0,0,.13)!important;
        background: transparent!important;
    }

    .file-validate, .folder-nav{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>
@endsection

@section('content')

    @section('extra_header')
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
      </svg>
    <div class="alert alert-primary alert-dismissible d-flex align-items-center mt-4" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
        <div>
          By default, all uploaded files are stored in your root folder. To save in a another folder(subfolder),
          open the appropriate folder, before uploading
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endsection

    <!--Container Main start-->
    <div class="height-100 bg-light">
        
        <div class="upload-main">
            <h5>Main Components</h5>
            <div class="row row-cols-1 row-cols-md-4 g-4 d-none">
                <div class="col">
                    <div class="card h-100">
                    
                    <div class="card-body text-center">
                        <h6 class="card-title">Card title</h6>
                        <p class="card-text">This is a short card.</p>
                    </div>
                    </div>
                </div>

                <div class="col">
                <div class="card h-100">
                    
                    <div class="card-body text-center">
                    <h6 class="card-title">Card title</h6>
                    <p class="card-text">This is a short card.</p>
                    </div>
                </div>
                </div>
                <div class="col">
                <div class="card h-100">
                
                    <div class="card-body text-center">
                    <h6 class="card-title">Card title</h6>
                    <p class="card-text">This is a short card.</p>
                    </div>
                </div>
                </div>
                <div class="col">
                <div class="card h-100">
                    
                    <div class="card-body text-center">
                    <h6 class="card-title">Card title</h6>
                    <p class="card-text">This is a short card.</p>
                    </div>
                </div>
                </div>
            </div>

            <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">@csrf
                <div class="dz-message" data-dz-message>
                    <div class="icon">
                        <i class="bx bx-file" style="font-size: 24px;"></i>
                    </div>
                    <h4 class="message">Click or Drop files here to upload</h4>
                    
                </div>
            </form> 
            <div class="file-validate">
                <span class="pull-left"><strong>Allowed extensions: .jpeg, .jpg, .png, .gif, .pdf, .docx, .xlx</strong></span>
                <span class="pull-right"><strong>Maximum file upload: 5MB</strong></span>
            </div>

            <div class="mt-5">
                <div class="folder-nav">
                    <h6>All Folders</h6>
                    <button class="add-folder" type="button" style="font-weight: 900"><i class='bx bx-plus' id="header-toggle"></i> Add folder</button>
                </div>
                
                <div class="upload_folders">
                    <div class="each_folder">
                        <div class="mb-1"><i class="bx bx-folder"></i></div>
                        <p class="subs">Subs: 1</p>
                        <span class="title">Images</span>
                    </div>

                    <div class="each_folder p-2">
                        <div class="mb-1"><i class="bx bx-folder"></i></div>
                        <p class="subs">Subs: 2</p>
                        <span class="title">Images</span>
                    </div>

                    

                
                </div>
            </div>
        </div>
    </div>
    <!--Container Main end-->
    
@endsection

@section('extra_js')
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

<script type="text/javascript">
    Dropzone.options.dropzone =
     {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        acceptedFiles: ".jpeg, .jpg, .png, .gif, .pdf, .docx, .xlx",
        addRemoveLinks: true,
        timeout: 5000,
        success: function(file, response) 
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
};
</script>
@endsection

