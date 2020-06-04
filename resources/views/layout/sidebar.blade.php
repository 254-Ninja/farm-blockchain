<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{route('dashboard')}}"><img src="{{asset('/assets/images/logo1.png')}}" width="25" alt="Aero"><span class="m-l-10">Aero</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="image"><a href="#"><img src="{{url((\Illuminate\Support\Facades\Auth::user()->profile_pic)?\Illuminate\Support\Facades\Auth::user()->profile_pic:'../assets/images/profile/user.png')}}" alt="User"></a></div>
                    <div class="detail">
                        <h4>{{\Illuminate\Support\Facades\Auth::user()->name}}</h4>
                        <small>{{\Illuminate\Support\Facades\Auth::user()->roles->first()->display_name}}</small>
                    </div>
                </div>
            </li>
            <li class="{{active(['dashboard'])}}"><a href="{{route('dashboard')}}"><i class="zmdi zmdi-view-dashboard"></i><span>Dashboard</span></a></li>
            <li class="{{active(['product_category','product_category/*','product','product/*'])}}">
                <a href="#App" class="menu-toggle"><i class="zmdi zmdi-apps"></i> <span>Products</span></a>
                <ul class="ml-menu">
                    <li class="{{active(['product','product/*'])}}"><a href="{{route('product.index')}}">List</a></li>
                    @permission('read-product_categories')
                    <li class="{{active(['product_category','product_category/*'])}}"><a href="{{route('product_category.index')}}">Categories</a></li>
                    @endpermission
                </ul>
            </li>
            <li class="{{active(['certificate','certificate/*'])}}">
                <a href="#App" class="menu-toggle"><i class="zmdi zmdi-card-membership"></i> <span>Certificates</span></a>
                <ul class="ml-menu">
                    <li class="{{active(['certificate','certificate/*'])}}"><a href="{{route('certificate.index')}}">List</a></li>
                </ul>
            </li>
            @permission(['verify-users','verify-products'])
            <li class="{{active(['users','users/*'])}}">
                <a href="#" class="menu-toggle"><i class="zmdi zmdi-card"></i> <span>Users</span></a>
                <ul class="ml-menu">
                    <li class="{{active(['users','users/*'])}}"><a href="{{route('users.index')}}">List</a></li>
                </ul>
            </li>
            @endpermission
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('processingcompany'))
            <li class="{{active(['farmers','farmer/*'])}}">
                <a href="#" class="menu-toggle"><i class="zmdi zmdi-male"></i> <span>Farmers</span></a>
                <ul class="ml-menu">
                    <li class="{{active(['farmers','farmer/*'])}}"><a href="{{route('farmers')}}">List</a></li>
                </ul>
            </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('farmer'))
            <li class="{{active(['processingcompanies','processingcompany/*'])}}">
                <a href="#" class="menu-toggle"><i class="zmdi zmdi-home"></i> <span>Processing Companies</span></a>
                <ul class="ml-menu">
                    <li class="{{active(['processingcompanies','processingcompany/*'])}}"><a href="{{route('processingcompanies')}}">List</a></li>
                </ul>
            </li>
            @endif
            @permission('read-blacklist_files')
            <li class="{{active(['blacklist/*'])}}">
                <a href="#App" class="menu-toggle"><i class="zmdi zmdi-stop"></i> <span>Blacklist</span></a>
                <ul class="ml-menu">
                    @permission('verify-users')
                    <li class="{{active(['blacklist/users'])}}"><a href="{{route('blacklist/users')}}">Users</a></li>
                    <li class="{{active(['blacklist/products'])}}"><a href="{{route('blacklist/products')}}">Products</a></li>
                    @endpermission
                    <li class="{{active(['blacklist/*/documents','blacklist/documents'])}}"><a href="{{route('blacklist.index')}}">Documents</a></li>
                </ul>
            </li>
            @endpermission
            <li class="{{active(['profile/*'])}}">
                <a href="#App" class="menu-toggle"><i class="zmdi zmdi-wrench"></i> <span>Settings</span></a>
                <ul class="ml-menu">
                    <li class="{{active(['profile/*'])}}"><a href="{{route('profile/view')}}">Profile</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
