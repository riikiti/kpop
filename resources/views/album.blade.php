<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite([ 'resources/js/app.js','resources/scss/app.scss','resources/css/app.css'])

</head>
<body>
<header class="header">
    <a href="/">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
    </a>

    @if (Route::has('login'))
        <div>
            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">


                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
</header>

<main class="main">

    <div class="album-page">
        <div class="album-page__img">
            <img src="http://127.0.0.1:8000/storage/{{$album->photo}}" alt="{{$album->photo}}">
        </div>
        <div class="album-page__info">
            <div class="album-page__header"><h2 class="title title--2">Альбом {{$album->name}}</h2> @if($album->new)
                    <div class="album-page__header-new">
                        <span>Новинка!</span>
                    </div>
                @endif</div>
            <div class="album-page__description">
                <h3 class="title title--3">Описание:</h3>
                <p>{{$album->description}}</p>
            </div>
            <p class="album-page__price">{{$album->price}} руб.</p>
            @auth
                <form method="post" action="{{ route('albumUser.store') }}">
                    @csrf
                    <input type="hidden" name="album_id" value="{{ $album->id }}">
                    <div class="albums__card-submit ">
                        <button  class="custom-btn btn-3" type="submit"><span>Заказать</span></button>
                    </div>
                </form>
            @endauth
        </div>
    </div>

    <h2 class="title title--2">Комментарии</h2>
    <div class="comment">
        @if(empty(\App\Models\Comment::query()->where('album_id', $album->id )->get()[0]))
            <h3 class="title title--3" style="text-align: center"> Комментариев нет</h3>
        @endif

        @foreach( \App\Models\Comment::query()->where('album_id', $album->id )->get() as $comment)
            <div class="comment__item">
                <div class="comment__header">
                    {{$comment->user->name}}
                </div>
                <div class="comment__body">
                    {{$comment->body}}</div>
            </div>
        @endforeach
    </div>
    @auth
        <form method="post" action="{{ route('albumUser.addComment') }}">
            @csrf
            <input type="hidden" name="album_id" value="{{ $album->id}}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->getAuthIdentifier()}}">
            <textarea name="body"></textarea>
            <div class="album-card__submit">
                <button type="submit" class="custom-btn btn-16">Отправить</button>
            </div>
        </form>
    @endauth


    <h2 class="title title--2">Так же может быть интересно</h2>

    <div class="albums">
        @foreach(App\Models\Album::take(5)->where('group_id','=',$album->group_id)->where('id','!=',$album->id)->get() as $album)
            <div class="albums__card">
                @if($album->new)
                    <div class="albums__card-new">
                        <span>Новинка!</span>
                    </div>
                @endif
                <a href="{{ route('album.show', ['id' => $album->id]) }}" class="albums__card-img">
                    <img src="http://127.0.0.1:8000/storage/{{$album->photo}}" alt="{{$album->photo}}">
                </a>
                <div class="albums__card-info">
                    <a href="{{ route('album.show', ['id' => $album->id]) }}"
                       class="title title--3">{{$album->name}}</a>
                    <p>{{$album->price}} руб.</p>
                    @auth
                        <form method="post" action="{{ route('albumUser.store') }}">
                            @csrf
                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                            <div class="albums__card-submit">
                                <button type="submit">Заказать</button>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>


</main>
</body>
</html>
