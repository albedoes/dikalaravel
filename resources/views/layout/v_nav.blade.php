<ul class="sidebar-menu" data-widget="tree">
 <li class="header">MAIN NAVIGATION</li>
<li class="{{ request() ->is('home') ? 'active' : '' }}"><a href="/home"><i class="fa fa-home"></i> <span>Home</span></a></li>
@if (auth()->user()->level == 1)
<li class="{{ request() ->is('guru') ? 'active' : '' }}"><a href="/guru"><i class="fa fa-user"></i> <span>Guru</span></a></li>
<li class="{{ request() ->is('siswa') ? 'active' : '' }}"><a href="/siswa"><i class="fa fa-graduation-cap"></i> <span>Siswa</span></a></li>
@endif
@if (auth()->user()->level == 2)
<li class="{{ request() ->is('user') ? 'active' : '' }}"><a href="/user"><i class="fa fa-users"></i> <span>User</span></a></li>
@endif
@if (auth()->user()->level == 3)
<li class="{{ request() ->is('koperasi') ? 'active' : '' }}"><a href="/koperasi"><i class="fa fa-shopping-cart"></i> <span>Koperasi</span></a></li>
@endif
 </ul>
