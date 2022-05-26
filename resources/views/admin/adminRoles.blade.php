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
  </style>
@endsection

@section('content')

<!--Content Main start-->
<div class="height-100 bg-light">
  
  <div class="mt-5">
      <h6>All Users</h6>
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

                  <td>{{ $role->name }}</td>

                  <td>{{ $role->permissions  }}</td>

                  <td>{{ $role->id }}</td>

                  <td>{{ $role->created_at }}</td>

                  <td>{{ $role->status ? 'Approved' : 'Unapproved' }}</td>

                  <td class="action-btns">

                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add Permissions">
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
                <th>Email</th>
                <th>Type</th>
                <th>Folders</th>
                <th>Files</th>
                <th>Date Joined</th>
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

