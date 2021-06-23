<div class="w-full p-4 h-auto top-0 sticky bg-gray-100">
    <div class="flex flex-row gap-4 justify-end pr-8">
        <div>
            <a href="{{ route('home') }}">Домашня</a>
        </div>
        @if(auth()->user()->isAdmin())
            <div>
                <a href="{{ route('groups.index') }}">Групи</a>
            </div>
            <div>
                <a href="{{ route('teachers.index') }}">Викладачі</a>
            </div>
            <div>
                <a href="{{ route('students.index') }}">Студенти</a>
            </div>
        @endif
        @if(auth()->user()->isStudent())
            <div>
                <a href="{{ route('testings.student.index') }}">Тестування</a>
            </div>
            <div>
                <a href="{{ route('results.student.index') }}">Результати</a>
            </div>
        @else
            <div>
                <a href="{{ route('tests.index') }}">Тести</a>
            </div>
            <div>
                <a href="{{ route('disciplines.index') }}">Дисципліни</a>
            </div>
            <div>
                <a href="{{ route('results.teacher.index') }}">Результати</a>
            </div>
        @endif
        <div>
            <a href="{{ route('logout') }}">Вийти</a>
        </div>
    </div>
</div>
