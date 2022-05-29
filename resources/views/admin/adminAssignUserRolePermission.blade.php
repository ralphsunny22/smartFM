@php
    use App\Models\User;
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

    .each_role_container {
      display: flex;
      justify-content: left;
      align-items: center;
      flex-wrap: wrap;
      border: 1px solid rgba(0,0,0,.125);
      padding: 5px;
    }

    .each_role {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 1px solid rgba(0,0,0,.125);
      border-radius: 0.25rem;
      padding: 5px;
      margin-right: 5px;
      margin-bottom: 5px;
    }
  </style>
@endsection

@section('content')

<!--Content Main start-->
<div class="height-100 bg-light">
  <h5>Assign Roles and Permission to {{ $user->name }}</h5>

   <div class="row">
      <!--add-role--->
      <div class="col-sm-6">

        <form action="{{ route('adminAssignUserRolePermissionPost', $user->id) }}" method="post">@csrf
        <div class="each_role_container">

          @foreach ($roles as $role)

          <div class="each_role">
            
            <div class="form-group">
              <label for="{{ $role->name }}">{{ $role->name }}</label>

              @if (!($user->hasRole($role)))
                <input type="checkbox" class="role-list" name="role_ids[]" value="{{ $role->id }}">
              @endif

            </div><hr>
            
            @if (count($role->permissions) > 0)

              @foreach ($role->permissions as $permission)
              <?php $x = User::not_user_permissions($permission->id, $user->id); ?>
                    <div class="form-group {{ $x ? 'd-none' : '' }}">
                      <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                      <input class="permission_checkbox" type="checkbox" data-role="role-{{ $role->id }}"
                      name="permission_ids[]"
                      id="{{ $permission->name }}" value="{{ $permission->id }}"
                      >
                    </div>
                     
                
              @endforeach
            @endif
                
          </div>
            
          @endforeach
          
        </div>
        <button id="file-btn" type="submit" class="btn mt-5">Add Permission</button>
        </form>

      </div>

      <!--remove-role--->
      <div class="col-sm-6">

        <form action="{{ route('adminRemoveUserRolePermission', $user->id) }}" method="post">@csrf
          <div class="each_role_container">

            @foreach ($roles as $role)

            <div class="each_role">
              
              @if ($user->hasRole($role))
              <div class="form-group">
                <label for="{{ $role->name }}">{{ $role->name }}</label>
                <input type="checkbox" class="role-list" name="role_ids[]" value="{{ $role->id }}">
              </div><hr>
              @endif
              

              @if (count($role->permissions) > 0)
                
                @foreach ($role->permissions as $permission)
                <?php $x = User::not_user_permissions($permission->id, $user->id); ?>
                      <div class="form-group {{ !$x ? 'd-none' : '' }}">
                        <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                        <input class="permission_checkbox" type="checkbox"
                        name="permission_ids[]"
                        id="{{ $permission->name }}" value="{{ $permission->id }}"
                        >
                      </div>
                       
                  
                @endforeach
              @endif
                  
            </div>
              
            @endforeach

          </div>
          <button id="file-btn" type="submit" class="btn mt-5 bg-danger">Remove Permission</button>
        </form>

      </div>
   </div>


 
  

  

  
</div>
<!--Content Main start-->

@endsection

@section('extra_js')

<script>
    //onclick of checkbox, append values to hidden input field
    var selected_checkbox=[];

    // $('.permission_checkbox').change(function(){
    //     if($(this).is(':checked')){
    //         //If checked add it to the array
    //         selected_checkbox.push($(this).val());
    //     } else {
    //     //If unchecked remove it from array
    //     for (var i=selected_checkbox.length-1; i>=0; i--) {
    //         if (selected_checkbox[i] === $(this).val()) 
    //             selected_checkbox.splice(i, 1);
    //         }
    //     }
    //     $('#mainFeaturesCheckboxHidden').val(selected_checkbox.join(', '));
    // });
 </script>

@endsection

