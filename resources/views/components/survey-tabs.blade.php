<div class="flex flex-row">
    <div class="join">
        @if ($isAdmin)
        <a href="{{ route('christmas.surveys') }}" class="btn join-item">Surveys</a>
        @endif
        <a href="{{ route('christmas.attendance') }}" class="btn join-item">Attendance</a>
        <a href="{{ route('christmas.vote') }}" class="btn join-item">Vote</a>
    </div>
</div>