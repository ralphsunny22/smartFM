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
                  <th>Email</th>
                  <th>Type</th>
                  <th>Folders</th>
                  <th>Files</th>
                  <th>Date Joined</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              
          </thead>

          <tbody>
              @if (count($users))
                  
                @foreach ($users as $user)
                <tr>
                  <td><input type="checkbox" name="" id=""></td>

                  <td>{{ $user->name }}</td>

                  <td>{{ $user->email  }}</td>

                  <td>{{ $user->type }}</td>

                  <td>{{ $user->folders->count() }}</td>

                  <td>{{ $user->myFiles->count() }}</td>

                  <td>{{ $user->created_at }}</td>

                  <td>{{ $user->status ? 'Approved' : 'Unapproved' }}</td>

                  <td class="action-btns">

                    <a href="{{ route('adminAssignUserRolePermission', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Assign Role & Permission">
                        <i class="bx bx-plus"></i></a>

                    <a href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bx bx-edit"></i></a></td>
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

<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>

@endsection

