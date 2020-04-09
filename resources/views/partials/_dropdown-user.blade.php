<!--begin: Navigation -->
<div class="kt-notification">
    <div class="kt-notification__custom kt-space-between">
        <a href="{{ url('logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
<!--end: Navigation -->
