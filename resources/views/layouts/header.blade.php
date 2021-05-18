<div class="w-full p-4 h-auto fixed">
    <div class="flex flex-row gap-4 justify-end pr-8">
        @if(auth()->user()->isAdmin())
            <div>
                <a href="{{ route('groups.index') }}">Групи</a>
            </div>
            <div>
                <a href="{{ route('teachers.index') }}">Вчителі</a>
            </div>
        @endif
        <div>
            <a href="{{ route('logout') }}">Вийти</a>
        </div>
    </div>
</div>
