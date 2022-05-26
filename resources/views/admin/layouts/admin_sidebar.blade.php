<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div> <a href="{{ route('adminDashboard') }}" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">SmartFM Admin</span> </a>
            <div class="nav_list">
                <a href="{{ route('adminDashboard') }}" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                <a href="{{ route('files') }}" class="nav_link"> <i class='bx bx-task nav_icon'></i> <span class="nav_name">Roles</span> </a> 
                <a href="{{ route('adminUsers') }}" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a> 
                <a href="{{ route('adminFolders') }}" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Folders</span> </a>
                <a href="{{ route('adminFiles') }}" class="nav_link"> <i class='bx bx-file nav_icon'></i> <span class="nav_name">Files</span> </a>  
                <a href="{{ route('uploads') }}" class="nav_link"> <i class='bx bx-cloud-upload nav_icon'></i> <span class="nav_name">Upload</span> </a> 
            </div>
        </div> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
    </nav>
</div>