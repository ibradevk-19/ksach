<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">القائمة</li>
                <li>
                    <a href="{{route('home')}}" class="waves-effect">
                        <i class="mdi mdi-home-variant-outline"></i>
                        <span>الصفحة الرئيسية</span>
                    </a>
                </li>
                @if(checkSuperAdmin())
                <li>
                    <a href="{{route('admin.index')}}" class=" waves-effect">
                        <i class="fas fa-user-check"></i>
                        <span>المسؤولين</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('roles.index')}}" class=" waves-effect">
                        <i class="fas fa-signature"></i>
                        <span>الأذونات</span>
                    </a>
                </li>
                @endif
                @if(checkPermission('mang families'))
                <li>
                    <a href="{{route('families.index')}}" class=" waves-effect">
                        <i class="fas fa-signature"></i>
                        <span>العائلات</span>
                    </a>
                </li>
                @endif
                @if(checkPermission('mang actors'))
                <li>
                    <a href="{{route('actors.index')}}" class=" waves-effect">
                        <i class="fas fa-signature"></i>
                        <span>الممثلين</span>
                    </a>
                </li>
                @endif
                @if(checkPermission('mang beneficial'))
                <li>
                    <a href="{{route('admin.main.index')}}" class=" waves-effect">
                        <i class="fas fa-signature"></i>
                        <span>المستفيدين</span>
                    </a>
                </li>
                @endif
                @if(checkPermission('mang delivry'))
                <li>
                    <a href="{{route('delivry.index')}}" class=" waves-effect">
                        <i class="fas fa-signature"></i>
                        <span>التسليم</span>
                    </a>
                </li>
                @endif
                @if(checkPermission('mang store'))
                <li class="menu-title">المخازن</li>
                <li>

                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-cog"></i>
                        <span>المخازن</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                         @if(checkPermission('mang providers'))
                        <li><a href="{{route('providers.index')}}">إدارة الموردين </a></li>
                        @endif
                        @if(checkPermission('mang categories'))
                        <li><a href="{{route('categories.index')}}">إدارة التصنيفات </a></li>
                        @endif
                        @if(checkPermission('mang products'))
                        <li><a href="{{route('products.index')}}">إدارة المنتجات </a></li>
                        @endif
                        @if(checkPermission('mang invoices'))
                        <li><a href="{{route('invoices.index')}}">الفواتير </a></li>
                        @endif
                    </ul>
                </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
