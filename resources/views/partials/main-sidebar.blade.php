<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li @if($active['sup'] == 'dashboard')class="active treeview" @else class="treeview" @endif>
                <a href="{{ URL::route('home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li @if($active['sup'] == 'clients')class="active treeview" @else class="treeview" @endif>
                <a href="#">
                    <i class="fa fa-users"></i> <span>Clients</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>