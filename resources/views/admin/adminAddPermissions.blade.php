@php
  //use App\Models\Permission;
@endphp 
@extends('admin.layouts.admin_design')

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
  <div class="file-header">
      <h5>Add Permissions</h5>
      <h5>Role: {{$role->title  }}</h5>
  </div>

  <form action="{{ route('adminAddPermissionsPost', $role->id) }}" method="post">@csrf
  <div id="singleFile">
        <div id="card-container" class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-11">
                <input type="text" class="form-control" name="title[]" id="" value="" placeholder="Permission title"> 
              </div>
              
              <div class="col-sm-1">
                <a class="delete text-danger" href="#"><i class="bx bx-trash"></i></a>
              </div>
            </div>
          </div>
        </div>
        <a href="#0" class="btn_1 gray add-item"><i class="bx bx-plus"></i>Add Item</a>
  </div>
  <button id="file-btn" type="submit" class="btn mt-5">Submit</button>
</form>

  


    <div class="mt-5">
        <div class="role-nav">
            <h6>Permissions</h6>
        </div>
        
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 5%"><input type="checkbox" name="" id=""></th>
                    <th>Name</th>
                    <th>Users Privileged Count</th>
                    <th>Date Added</th>
                    {{-- <th>Status</th> --}}
                    <th>Action</th>
                </tr>
                
            </thead>

            <tbody>
                @if (count($permissions))
                    
                @foreach ($permissions as $permission)
                <tr>
                    <td><input type="checkbox" name="" id=""></td>

                    <td>{{ $permission->name }}</td>

                    <?php //$allUsersCount = Permission::allUsersCount($permission->id); ?>
                    <td>{{ $permission->name }}</td>

                    <td>{{ $permission->created_at }}</td>

                    

                    <td class="action-btns">
                        <a href=""><i class="bx bx-edit"></i></a>
                        <a href="" class="text-danger"><i class="bx bx-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                    
                @endif
                
                
            
            </tbody>

            <tfoot>
                <tr>
                <th style="width: 5%"><input type="checkbox" name="" id=""></th>
                <th>Name</th>
                <th>Users Privileged Count</th>
                <th>Date Added</th>
                {{-- <th>Status</th> --}}
                <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
<!--Content Main start-->

@endsection

@section('extra_js')

<script>
  //append multiple fields
  function newMenuItem() {
				var newElem = $('div.card-body').first().clone();
				newElem.find('input').val('');
				newElem.appendTo('div#card-container');
			}
			if ($("div#card-container").is('*')) {
				$('.add-item').on('click', function (e) {
					e.preventDefault();
					newMenuItem();
				});
				$(document).on("click", "#card-container .delete", function (e) {
					e.preventDefault();
					$(this).parent().parent().parent().remove();
				});
			}
</script>

@endsection

