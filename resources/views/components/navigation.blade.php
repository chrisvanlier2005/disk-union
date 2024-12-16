<?php
    class NavItem {
        public function __construct(
            public string $label,
            public string $href,
            public bool $active,
        ) {
        }
    }

    $request = request();

    $items = [
        new NavItem(
            'Dashboard',
            route('dashboard'),
            $request->routeIs('dashboard')
        ),
        new NavItem(
            'Records',
            route('records.index'),
            $request->routeIs('records.*')
        ),
    ];
?>
<nav class="navbar bg-base-100">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul
                tabindex="0"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                @foreach($items as $item)
                    <li>
                        <a href="{{ $item->href }}">{{ $item->label }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <a class="btn btn-ghost text-xl" href="{{ route('dashboard') }}">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-8"
                viewBox="0 0 55.334 55.334"
                xml:space="preserve">
                    <g>
                        <g>
                            <circle style="fill:#010002;" cx="27.667" cy="27.667" r="3.618" />
                            <path
                                style="fill:#010002;"
                                d="M27.667,0C12.387,0,0,12.387,0,27.667s12.387,27.667,27.667,27.667s27.667-12.387,27.667-27.667    S42.947,0,27.667,0z M17.118,6.881c3.167-1.61,6.752-2.518,10.549-2.518c0.223,0,0.444,0.003,0.665,0.009    c0.367,0.01,0.619,0.922,0.564,2.025l-0.282,5.677c-0.055,1.103-0.289,1.986-0.523,1.979c-0.141-0.004-0.282-0.006-0.424-0.006    c-1.997,0-3.894,0.43-5.603,1.202c-1.007,0.455-2.212,0.184-2.774-0.767l-2.896-4.897C15.832,8.634,16.133,7.382,17.118,6.881z     M15.986,17.295l-4.278-3.742c-0.832-0.727-0.918-1.994-0.119-2.756c0.019-0.018,0.037-0.035,0.057-0.053    c0.802-0.76,2.059-0.605,2.737,0.266l3.494,4.484c0.679,0.871,0.837,1.889,0.391,2.314C17.821,18.235,16.818,18.022,15.986,17.295    z M17.877,27.667c0-5.407,4.383-9.79,9.79-9.79s9.79,4.383,9.79,9.79s-4.383,9.79-9.79,9.79S17.877,33.074,17.877,27.667z     M38.17,48.476c-3.156,1.596-6.725,2.495-10.503,2.495c-0.248,0-0.495-0.004-0.741-0.011c-0.409-0.013-0.692-0.929-0.632-2.032    l0.31-5.676c0.061-1.103,0.322-1.981,0.586-1.972c0.158,0.005,0.317,0.008,0.477,0.008c1.834,0,3.582-0.362,5.179-1.018    c1.022-0.42,2.275-0.144,2.877,0.782l3.101,4.77C39.426,46.747,39.156,47.977,38.17,48.476z M43.619,44.656    c-0.766,0.72-2.005,0.551-2.703-0.305l-3.59-4.407c-0.698-0.856-0.876-1.848-0.435-2.255c0.442-0.407,1.443-0.179,2.274,0.549    l4.28,3.744C44.277,42.709,44.386,43.936,43.619,44.656z" />
                        </g>
                    </g>
                </svg>
            Disk Union
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            @foreach ($items as $item)
                <li @class([
                    'rounded-lg',
                    'bg-primary/20' => $item->active,
                ])>
                    <a href="{{ $item->href }}">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="navbar-end">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img
                        alt="Tailwind CSS Navbar component"
                        src="https://api.dicebear.com/9.x/thumbs/svg?seed={{auth()->user()->name}}"
                    />
                </div>
            </div>
            <ul
                tabindex="0"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
