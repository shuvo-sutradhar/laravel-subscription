<header class="px-6 bg-white ">
    <div class="container mx-auto flex flex-wrap items-center lg:py-0 py-2">
        <div class="flex-1 flex justify-between items-center font-black text-gray-700">
            <a href="{{ route('dashboard') }}">
                <img src="/img/logo-icon.png" alt="WeTeach Logo">
            </a>
        </div>

        <label for="menu-toggle" class="cursor-pointer lg:hidden block">
            <svg class="fill-current text-gray-600 hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"</path></svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />

        <div class="hidden lg:flex lg:items-center lg:w-auto w-full relative" id="menu">
            <nav>
                <ul class="lg:flex items-center justify-between text-sm font-medium text-gray-700 pt-4 lg:pt-0">
                    <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent  font-bold @if(Request::is('dashboard')) {{'text-indigo-500'}} @else {{ 'text-gray-600 hover:text-gray-900' }} @endif" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent  font-bold @if(Request::is('support')){{'text-indigo-500'}} @else {{ 'text-gray-600 hover:text-gray-900' }} @endif" href="{{ route('support') }}">Support</a></li>
                    <li>
                        <a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent relative @if(Request::is('announcements/unread')){{'text-pink-500 font-bold'}} @else {{ 'text-gray-500 hover:text-gray-700' }} @endif" href="{{ route('announcements.unread') }}">
                            @if(auth()->user()->hasUnreadAnnouncements())
                                <span class="bg-pink-400 w-2 h-2 absolute rounded-full left-0 top-0 ml-2 mt-3 announcement-indicator"></span>
                            @endif
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="18.93" height="18.34"><g data-name="Group 1"><path data-name="Path 1" d="M5.96 1.13L5.43 0A9.55 9.55 0 000 7.84l1.23.1a8.28 8.28 0 014.73-6.82z"/><path data-name="Path 2" d="M13.5 0l-.52 1.13a8.35 8.35 0 014.73 6.81l1.23-.1A9.55 9.55 0 0013.5 0z"/><path data-name="Path 3" d="M15.46 8.64a5.92 5.92 0 00-5.07-5.86v-.7a.9.9 0 10-1.79 0v.7a5.95 5.95 0 00-5.06 5.86v5.86H1.65v1.95h6.03v.07a1.82 1.82 0 103.64 0v-.07h6.02V14.5h-1.89V8.64z"/></g></svg>
                        </a>
                    </li>
                </ul>
            </nav>
            <a href="#" class="group lg:ml-4 flex items-center justify-start lg:mb-0 mb-4 pointer-cursor border-l border-gray-300 pl-6" id="userdropdown">
                <p class="font-bold text-xs pr-2 text-gray-700 text-right ignore-body-click">{{ auth()->user()->name }}<br>
                    @if(auth()->user()->onTrial())
                        <span class="text-xs text-teal-500 ignore-body-click">Tril Period</span>
                    @else
                        <span class="text-xs text-indigo-600 ignore-body-click">{{ ucfirst(auth()->user()->plan->name) }} plan</span>
                    @endif
                </p>
                <img class="rounded-full w-10 h-10 border-2 border-gray-300 border-transparent group-hover:border-indigo-400 ignore-body-click" src="{{ auth()->user()->photo }}" alt="avatar">
            </a>
            <div id="usermenu" class="absolute lg:mt-12 pt-1 z-40 left-0 lg:left-auto lg:right-0 lg:top-0 invisible lg:w-auto w-full">
                <div class="bg-white shadow-xl lg:px-8 px-6 lg:py-4 pb-4 pt-0 rounded rounded-t-none">
                <a href="{{ route('profile') }}" class="pb-2 block text-gray-600 hover:text-gray-900 font-medium ignore-body-click">Settings</a>
                <a href="/logout" class="block text-gray-600 hover:text-gray-900 font-medium ignore-body-click">Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>


@if ($errors->any())
    <div class="container mx-auto max-w-3xl mt-8">
        <div class="bg-red-500 text-white p-4 rounded-lg">
            <p class="font-bold">Please fix the following errors</p>
            <ul class="list-disc ml-8">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (session('alert'))
    <div class="container mx-auto max-w-3xl mt-8">
        @php $alert_type = session('alert_type'); @endphp
        <div class="@if($alert_type == 'info') {{ 'bg-blue-400' }} @elseif($alert_type == 'success') {{ 'bg-green-400' }} @elseif($alert_type == 'error') {{ 'bg-red-400' }} @elseif($alert_type == 'warning') {{ 'bg-orange-400' }} @endif text-white p-4 rounded-lg" role="alert">
            <p class="font-bold">{{ session('alert_type') }}</p>
            <p>{{ session('alert') }}</p>
        </div>
    </div>
@endif