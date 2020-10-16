
{{-- Thanh tiêu đề: Logo, search, cart, login|register|logout --}}
<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ route('app.index') }}">AppStore</a>
	</div>
	<form method="GET" class="navbar-form navbar-left" role="search">
		<div class="form-group">
			<input type="text" class="form-control" name="keyword" value="{{ request()->get('keyword') }}" placeholder="Search">
		</div>
		<button type="submit" class="btn btn-default">Search</button>
	</form>
	<ul class="nav navbar-nav navbar-right">
        <li><a href="{{ view('app.cart') }}" class="fa fa-shopping-cart">
            Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
        </a></li>
        @php
            if (Auth::check()):
        @endphp

		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-bottom: 5px;">
                @php
                    $currentUser = Auth::user();
                    // if ($currentUser['avatar'] != null):
                @endphp
                {{-- <img src="<?= url("{$currentUser['avatar']}") ?>" alt="Avatar" title="Avatar" class="img-circle img-responsive">
                @php
                    endif
                @endphp --}}
                <?= $currentUser->name; ?><b class="caret"></b>
            </a>

            <ul class="dropdown-menu">
                <li><a href="{{ route('app.create') }}">Upload new App</a></li>
                <li><a href="{{ route('app.myApps', ['id' => $currentUser->id]) }}">My apps</a></li>
				<li><a href="{{ route('profile', ['id' => $currentUser->id]) }}">Profile</a></li>
				<li><a href="#">Change password</a></li>
				<li><a href="{{ route('logout') }}">Logout</a></li>
			</ul>
        </li>
        @php
            else:
        @endphp
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
        @php
            endif
        @endphp
	</ul>
</div>

{{-- Thanh menu --}}
<nav class="navbar menu" role="navigation">
	<div class="container-fluid">
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-left">
				<li><a href="{{ route('app.index') }}">Trang chủ</a></li>
				<li><a href="#">Danh mục</a></li>
				<li><a href="#">Ứng dụng mới</a></li>
			</ul>
		</div>
	</div>
</nav>



