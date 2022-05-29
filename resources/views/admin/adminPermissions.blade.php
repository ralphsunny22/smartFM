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

    .role-nav{
      display: flex;
      align-items: center;
      justify-content: left; 
    }

    .role-nav a {
        background-color: #4723D9;
        font-weight: 900;
        color: white;
        margin-left: 5px;
        margin-bottom: 10px;
        padding: 5px;
        border-radius: 5px;
    }
  </style>
@endsection

@section('content')

<!--Content Main start-->
<div class="height-100 bg-light">
  
  <div class="mt-5">
      <div class="role-nav">
        <h6>All Roles</h6>
        <a href="{{ route('adminAddRoles') }}" class="add-folder" type="button" style="font-weight: 900">
            <i class='bx bx-plus' id="header-toggle"></i>
            Add Role
        </a>
      </div>
      
      <table id="myTable" class="table table-striped">
          <thead>
              <tr>
                  <th style="width: 5%"><input type="checkbox" name="" id=""></th>
                  <th>Name</th>
                  <th>Permissions</th>
                  <th>Users Assigned Count</th>
                  <th>Date Added</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              
          </thead>

          <tbody>
              @if (count($roles))
                  
                @foreach ($roles as $role)
                <tr>
                  <td><input type="checkbox" name="" id=""></td>

                  <td>{{ $role->title }}</td>

                  <td>{{ $role->permissions  }}</td>

                  <td>{{ $role->users_assigned_count }}</td>

                  <td>{{ $role->created_at }}</td>

                  <td>{{ $role->status ? 'Approved' : 'Unapproved' }}</td>

                  <td class="action-btns">

                    <a href="{{ route('adminAddPermissions', $role->id) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add Permissions">
                        <i class="bx bx-plus"></i></a>
                    <a href=""><i class="bx bx-edit"></i></a></td>
              </tr>
                @endforeach
                  
              @endif
              
              
            
          </tbody>

          <tfoot>
              <tr>
                <th style="width: 5%"><input type="checkbox" name="" id=""></th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Users Assigned Count</th>
                <th>Date Added</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
          </tfoot>
      </table>
  </div>

  
</div>
<!--Content Main start-->

@endsection

@section('extra_js')
@endsection

