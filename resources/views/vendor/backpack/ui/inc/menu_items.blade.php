{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}">Главная</a></li>

<x-backpack::menu-item title="Администраторы"  :link="backpack_url('admin')" />
<x-backpack::menu-item title="Пользователи"  :link="backpack_url('user')" />
<x-backpack::menu-item title="Альбомы пользователей" :link="backpack_url('album-user')" />
<x-backpack::menu-item title="Группы" :link="backpack_url('group')" />
<x-backpack::menu-item title="Альбомы"  :link="backpack_url('album')" />
