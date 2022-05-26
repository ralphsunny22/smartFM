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
      <h6>All Folders</h6>
      <table id="myTable" class="table table-striped">
          <thead>
              <tr>
                  <th style="width: 5%"><input type="checkbox" name="" id=""></th>
                  <th>Name</th>
                  <th>Sub-folders</th>
                  <th>Files</th>
                  <th>Created by</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              
          </thead>

          <tbody>
              @if (count($folders))
                  
                @foreach ($folders as $folder)
                <tr>
                  <td><input type="checkbox" name="" id=""></td>

                  <td>{{ $folder->title }}</td>

                  <td>{{ $folder->folders->count()  }}</td>

                  <td>{{ $folder->myFiles->count() }}</td>

                  <td>{{ $folder->user->name }}</td>

                  <td>{{ $folder->created_at }}</td>

                  <td>{{ $folder->status ? 'Approved' : 'Unapproved' }}</td>

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
                <th>Sub-folders</th>
                <th>Files</th>
                <th>Created by</th>
                <th>Date</th>
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

