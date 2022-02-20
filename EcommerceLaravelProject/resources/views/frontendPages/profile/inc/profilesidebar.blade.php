<div class="card">
    <div class="card-body">
        <img class="card-img-top" style="border-radius: 50%" src="#" height="100%" width="100%" alt="not found">
        <ul class="list-group list-group-flush">
            <a href="{{route('home')}}" class="btn btn-sm btn-primary btn-block">Home</a>
            <a href="{{route('profile.order')}}" class="btn btn-sm btn-warning btn-block">My Order</a>
            <a class="btn btn-sm btn-danger btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>
</div>