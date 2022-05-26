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

    /* .each_folder{
        width: 100px;
        height: 100px;
        cursor: default;
    } */
    .folder-image{
        max-width: 100%;
        max-height: 100%;
        border-radius: 5%;
    }

    .file-actions {
        width: 125px;
        height: 120px;
        border: 1px solid grey;
        position: absolute;
        top: -70px;
        left: 70px;
        z-index: 9;
        background-color: white;
        border-radius: 5px;
        padding: 5px;
        display: none;
    }

    .file-actions .file-actions-content{
        width: 50%;
        height: 50%;
        margin: auto;
    }

    .file-actions .file-actions-content a{
        display: block;
        margin-bottom: 5px;
        color: #000;

    }

    
</style>
@endsection

@section('content')

    @section('extra_header')
    
    @endsection

    <!--Container Main start-->
    <div class="height-100 bg-light">
        
        <div class="upload-main">
            <h5>Path: /{{$folder->path_by_title}}</h5>
            
            <form method="post" action="{{ route('uploadsPost') }}"
                enctype="multipart/form-data" class="dropzone" id="my-great-dropzone">@csrf
                <div class="dz-message" data-dz-message>
                    <div class="icon">
                        <i class="bx bx-file" style="font-size: 24px;"></i>
                    </div>
                    <h4 class="message">Click or Drop files here to upload</h4>
                </div>
                <input type="hidden" name="store_path" value="{{$folder->id}}">
            </form> 

            <div class="file-validate">
                <span class="pull-left"><strong>Allowed extensions: .jpeg, .jpg, .png, .gif, .pdf, .docx, .xlx</strong></span>
                <span class="pull-right"><strong>Maximum file upload: 5MB</strong></span>
            </div>

            <div class="mt-5">
                <div class="folder-nav">
                    <h6>All Contents</h6>
                    <button class="add-folder" type="button" style="font-weight: 900"
                    onclick="modalDisplay('Add Folder', 'createfolder', '', 'Folder name', '{{ $folder->id }}')">
                        <i class='bx bx-plus' id="header-toggle"></i>
                        Add folder
                    </button>
                </div>
                
                @if ($mergedItems->count() > 0)
                <div class="upload_folders">

                    @foreach ($mergedItems as $item)

                        @php
                            $uniq = $item->unique_key;
                        @endphp
                        @if ($item->type == 'folder') 
                            <div class="each_folder" onclick="showFileActions('{{ $uniq }}')">
                                <div class="mb-1"><i class="bx bx-folder"></i></div>
                                <p class="subs">Subs: {{ $item->folders->count() }}</p>
                                <span class="title">{{ $item->title }}</span>

                                <div id="{{ $uniq }}" class="file-actions">
                                    <div class="file-actions-content">
                                        <a href="{{ route('singleFolder', $item->id) }}">Open</a>

                                        <a href="javascript:void(0)" class="renameFolder"
                                            onclick="modalDisplay('Rename Folder', 'renameFolder', '{{ $item->title }}', 'Folder name', '{{ $item->id }}')">
                                            Rename</a>

                                        <a href="javascript:void(0)" class="add-folder"
                                        onclick="modalDisplay('Add Folder', 'createfolder', '', 'Folder name', '{{ $item->id }}')">
                                            +folder</a>

                                        <a href="">Remove</a>
                                    </div>
                                </div>
                            </div>
                            
                        @endif
                        
                        
                        @if (in_array($item->type, $extensionArray))
                            <div class="each_folder" onclick="showFileActions('{{ $uniq }}')">
                                <img src="{{ asset('storage/'.$item->folder->path_by_slug.'/'.$item->title) }}" alt="" class="folder-image">
                                <div id="{{ $uniq }}" class="file-actions">
                                    <div class="file-actions-content">
                                        <a
                                            href="{{ asset('storage/'.$item->folder->path_by_slug.'/'.$item->title) }}"
                                            data-fancybox="gallery"
                                            data-caption="{{ isset($item->original_name) ? $item->original_name : 'no caption'  }}"
                                        >Preview</a>

                                        <a href="javascript:void(0)" class="renameFile"
                                        onclick="modalDisplay('Rename File', 'renameFile', '{{ $item->original_name ? $item->original_name : '' }}', 'File name', '{{ $item->id}} ')">
                                            Rename</a>

                                            <a href="{{ route('downloadFile', $item->id) }}">Download</a>
                                        <a href="">Remove</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

                @else
                    <div class="upload_folders">
                        No contents
                    </div>
                @endif
                

            </div>
        </div>
    </div>

<!-- Modal -->
<div class="bg-modal">
    <div class="modal-content p-5">
        <div class="close">+</div>
        <h6 class="modal-title"></h6>
        <form class="modal-form" action=""  method="POST">@csrf
            <input type="text" name="title" class="form-control input-title" id="" placeholder="">
            <input type="hidden" class="item_id" name="item_id" value="">
            <button type="submit" class="pull-right">Submit</button>
        </form>

        <div class="save-path mt-3">
            <p>Save path: /{{$folder->path_by_title}}</p>
        </div>
    </div>
    
</div>

<!-- Modal rename folder-->
{{-- <div class="bg-modal renameFolder">
    <div class="modal-content renameFolder p-5">
        <div class="close">+</div>
        <h6>Rename folder</h6>
        <form action="{{ route('renameFolder') }}"  method="POST">@csrf
            <input type="text" name="title" class="form-control" id="title" placeholder="Folder name" value="">
            <input type="hidden" class="save_path" name="save_path" value="">
            <button type="submit" class="pull-right">Submit</button>
        </form>

        <div class="save-path mt-3">
            <p>Save path: /Main</p>
        </div>
    </div>
    
</div> --}}

<!-- Modal rename file -->
{{-- <div class="bg-modal renameFile">
    <div class="modal-content renameFile p-5">
        <div class="close">+</div>
        <h6>Rename file</h6>
        <form action="{{ route('renameFile') }}"  method="POST">@csrf
            <input type="text" name="file_title" class="form-control file_title" id="file_title" placeholder="File name" value="">
            <input type="hidden" class="file_id" name="file_id" value="">
            <button type="submit" class="pull-right">Submit</button>
        </form>

        <div class="save-path mt-3">
            <p>Save path: /Main</p>
        </div>
    </div> 
</div> --}}

<!--Container Main end-->

@endsection

@section('extra_js')
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>


<script>
    //save_path is an id value;
    function modalDisplay ($modal_title="", $route="", $input_value="", $input_placeholder="", $item_id=""){
        $('.bg-modal').css({'display':'flex'});
        console.log($modal_title);
        $('.modal-title').text($modal_title);
        var base_url = window.location.origin; //http://127.0.0.1:8000
        $('.modal-form').attr('action', base_url+'/'+$route);

        if($input_value != ""){
            $('.input-title').val($input_value);
        }
        $('.input-title').attr('placeholder', $input_placeholder);

        if($item_id != "") {
            // $path = $(this).attr("data-path")
            $('.bg-modal .item_id').val($item_id)
        } 
    }
    
    $(".close").click(function(){
        $('.bg-modal').css({'display':'none'});
        $('.input-title').val('');
        $('.bg-modal .item_id').val('');
   })

</script>

<script>
    function showFileActions(uniq) {
        $('#'+uniq).toggle();
    }
    // $('.each_folder').click(function(e) {
    //     $('.file-actions').toggle();
    // });
</script>

<!--dropZone-->
<script type="text/javascript">
    Dropzone.options.myGreatDropzone  =
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
        queuecomplete: function(file){
            location.reload();
        },
        
        success: function(file, response) 
        {
            console.log(response)
            
            //if(response) window.location.reload(true);
        },
        error: function(file, response)
        {
           return false;
        }
    };


</script>


@endsection

