<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'NextBNB - Book unique homes and experiences')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <a href="{{ route('home') }}" class="logo">
                    NextBNB
                </a>
            </div>

            <div class="header-center">
                <form action="{{ route('search') }}" method="GET" class="search-bar">
                    <input type="text" 
                           name="location" 
                           placeholder="Where are you going?" 
                           value="{{ request('location') }}">
                    <input type="date" 
                           name="check_in" 
                           placeholder="Check in" 
                           value="{{ request('check_in') }}"
                           min="{{ date('Y-m-d') }}">
                    <input type="date" 
                           name="check_out" 
                           placeholder="Check out" 
                           value="{{ request('check_out') }}"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    <select name="guests">
                        <option value="">Guests</option>
                        @for($i = 1; $i <= 16; $i++)
                            <option value="{{ $i }}" {{ request('guests') == $i ? 'selected' : '' }}>
                                {{ $i }} guest{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                    <button type="submit" class="search-btn">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="white">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </form>
            </div>

            <div class="header-right">
                <div class="user-menu">
                    @auth
                        <a href="{{ route('properties.create') }}" class="nav-link">List your property</a>
                        
                        <div class="user-dropdown">
                            <button class="user-dropdown-btn" onclick="toggleDropdown()">
                                <div class="menu-icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M2 4h12a1 1 0 0 1 0 2H2a1 1 0 0 1 0-2zm0 4h12a1 1 0 0 1 0 2H2a1 1 0 0 1 0-2zm0 4h12a1 1 0 0 1 0 2H2a1 1 0 0 1 0-2z"/>
                                    </svg>
                                </div>
                                <div class="user-avatar">
                                    <img src="https://via.placeholder.com/32x32/ff385c/ffffff?text={{ substr(auth()->user()->name, 0, 1) }}" 
                                         alt="{{ auth()->user()->name }}" 
                                         class="user-img">
                                </div>
                            </button>
                            <div class="user-dropdown-menu" id="userDropdown">
                                <a href="#" class="dropdown-item">Messages</a>
                                <a href="{{ route('trips') }}" class="dropdown-item">Trips</a>
                                <a href="{{ route('wishlists.index') }}" class="dropdown-item">Wishlists</a>
                                <hr class="dropdown-divider">
                                <a href="{{ route('properties.create') }}" class="dropdown-item">List your property</a>
                                <a href="{{ route('host.dashboard') }}" class="dropdown-item">Host dashboard</a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">Account settings</a>
                                <a href="#" class="dropdown-item">Help Center</a>
                                <form method="POST" action="{{ route('logout') }}" class="dropdown-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn">Log out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('properties.create') }}" class="nav-link">List your property</a>
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        <a href="{{ route('register') }}" class="btn btn-outline nav-link">Sign up</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Safety information</a></li>
                    <li><a href="#">Cancellation options</a></li>
                    <li><a href="#">Report a concern</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Community</h3>
                <ul>
                    <li><a href="#">NextBNB.org: disaster relief housing</a></li>
                    <li><a href="#">Combating discrimination</a></li>
                    <li><a href="#">Supporting people with disabilities</a></li>
                    <li><a href="#">Report neighborhood concern</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Hosting</h3>
                <ul>
                    <li><a href="{{ route('properties.create') }}">NextBNB your home</a></li>
                    <li><a href="#">Hosting resources</a></li>
                    <li><a href="#">Community forum</a></li>
                    <li><a href="#">Hosting responsibly</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>NextBNB</h3>
                <ul>
                    <li><a href="#">Newsroom</a></li>
                    <li><a href="#">New features</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Investors</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-container">
                <div class="footer-bottom-left">
                    <p>&copy; {{ date('Y') }} NextBNB, Inc. All rights reserved.</p>
                    <div class="footer-links">
                        <a href="#">Privacy</a>
                        <a href="#">Terms</a>
                        <a href="#">Sitemap</a>
                        <a href="#">Company details</a>
                    </div>
                </div>
                <div class="footer-bottom-right">
                    <div class="language-currency">
                        <button class="footer-btn">
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zM5.78 8.5a6.9 6.9 0 0 0 4.44 0 6.9 6.9 0 0 0 0-1 6.9 6.9 0 0 0-4.44 0 6.9 6.9 0 0 0 0 1z"/>
                            </svg>
                            English (US)
                        </button>
                        <button class="footer-btn">
                            $ USD
                        </button>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <svg width="18" height="18" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link">
                            <svg width="18" height="18" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link">
                            <svg width="18" height="18" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.219-5.175 1.219-5.175s-.311-.622-.311-1.541c0-1.444.83-2.52 1.863-2.52.878 0 1.303.659 1.303 1.448 0 .882-.562 2.2-.849 3.42-.241 1.018.511 1.848 1.515 1.848 1.819 0 3.219-1.919 3.219-4.69 0-2.45-1.76-4.16-4.278-4.16-2.915 0-4.624 2.186-4.624 4.444 0 .88.339 1.825.762 2.341.084.1.096.188.071.29-.077.321-.249 1.011-.283 1.152-.044.183-.145.222-.334.134-1.247-.581-2.027-2.408-2.027-3.87 0-3.161 2.295-6.064 6.612-6.064 3.472 0 6.169 2.473 6.169 5.776 0 3.447-2.173 6.22-5.19 6.22-1.013 0-1.966-.527-2.291-1.155l-.623 2.378c-.226.869-.835 1.958-1.244 2.621.937.29 1.931.446 2.962.446 6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // User dropdown toggle
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const button = document.querySelector('.user-dropdown-btn');
            
            if (dropdown && !dropdown.contains(event.target) && !button.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            });
        }, 5000);
    </script>
</body>
</html>