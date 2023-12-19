{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Admins" icon="la la-question" :link="backpack_url('admin')" />
<x-backpack::menu-item title="Albums" icon="la la-question" :link="backpack_url('album')" />
<x-backpack::menu-item title="Album users" icon="la la-question" :link="backpack_url('album-user')" />
<x-backpack::menu-item title="Authors" icon="la la-question" :link="backpack_url('author')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />