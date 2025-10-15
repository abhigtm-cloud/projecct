@php
    use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'NextBNB - Book unique homes and experiences')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/nextbnb.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Modern Professional Header -->
    <header class="modern-header">
        <nav class="modern-navbar">
            <div class="navbar-container">
                <!-- Brand Logo Section -->
                <div class="brand-section">
                    <a href="{{ route('home') }}" class="brand-link">
                        <div class="logo-container">
                            <svg width="34" height="34" viewBox="0 0 34 34" class="brand-icon">
                                <path d="M29.24 22.68c-.16-.39-.31-.8-.47-1.15l-.74-1.67-.03-.03c-2.2-4.8-4.55-9.68-7.04-14.48l-.1-.2c-.25-.47-.5-.99-.76-1.47-.32-.57-.63-1.18-1.14-1.76a5.3 5.3 0 00-8.2 0c-.47.58-.82 1.19-1.14 1.76-.25.52-.5 1.03-.76 1.5l-.1.2c-2.45 4.8-4.84 9.68-7.04 14.48l-.06.06c-.22.52-.48 1.06-.73 1.64-.16.35-.32.73-.48 1.15a6.8 6.8 0 007.2 9.23 8.38 8.38 0 003.18-1.1c1.3-.73 2.55-1.79 3.95-3.32 1.4 1.53 2.68 2.59 3.95 3.33A8.38 8.38 0 0022.75 32a6.79 6.79 0 006.75-5.83 5.94 5.94 0 00-.26-3.5zm-14.36 1.66c-1.72-2.2-2.84-4.22-3.22-5.95a5.2 5.2 0 01-.1-1.96c.07-.51.26-.96.52-1.34.6-.87 1.65-1.41 2.8-1.41a3.3 3.3 0 012.8 1.4c.26.4.45.84.51 1.35.1.58.06 1.25-.1 1.96-.38 1.7-1.5 3.74-3.21 5.95zm12.74 1.48a4.76 4.76 0 01-2.9 3.75c-.76.32-1.6.41-2.42.32-.8-.1-1.6-.36-2.42-.84a27.17 27.17 0 01-2.49-2.34c-1.85-2.5-2.5-4.6-1.89-6.84a4.67 4.67 0 012.43-2.75c.85-.32 1.8-.24 2.64.13a5.39 5.39 0 012.57 2.15c.4.55.71 1.2.87 1.9.19.9.13 1.9-.4 2.52z" fill="currentColor"/>
                            </svg>
                            <span class="brand-text">NextBNB</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links Section -->
                <div class="nav-center">
                    <div class="nav-links-container">
                        <a href="{{ route('properties.index') }}" class="nav-item {{ request()->routeIs('properties.*') ? 'active' : '' }}">
                            <i class="fas fa-home nav-icon"></i>
                            <span>Stays</span>
                        </a>
                        <a href="#" class="nav-item">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <span>Experiences</span>
                        </a>
                        <a href="#" class="nav-item">
                            <i class="fas fa-plane nav-icon"></i>
                            <span>Adventures</span>
                        </a>
                    </div>
                </div>

                <!-- User Actions Section -->
                <div class="nav-actions">
                    @auth
                        <!-- Host Mode Toggle -->
                        <div class="host-mode-toggle">
                            <a href="{{ route('host.dashboard') }}" class="host-link">
                                <i class="fas fa-plus-circle"></i>
                                <span>Host Dashboard</span>
                            </a>
                        </div>
                    @else
                        <!-- Become Host Button -->
                        <div class="become-host">
                            <a href="{{ route('properties.create') }}" class="become-host-btn">
                                <span>Become a host</span>
                            </a>
                        </div>
                    @endauth

                    <!-- Language/Region Button -->
                    <button class="region-btn" title="Choose language and region">
                        <i class="fas fa-globe"></i>
                    </button>

                    <!-- User Menu -->
                    <div class="user-menu-wrapper">
                        <button class="user-menu-trigger">
                            <div class="menu-icon">
                                <i class="fas fa-bars"></i>
                            </div>
                            <div class="user-avatar">
                                @auth
                                    @if(auth()->user()->profile_photo)
                                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="avatar-img">
                                    @else
                                        <div class="avatar-initials">{{ auth()->user()->initials }}</div>
                                    @endif
                                @else
                                    <div class="avatar-placeholder">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                @endauth
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="user-dropdown-menu">
                            @guest
                                <div class="dropdown-section">
                                    <a href="{{ route('login') }}" class="dropdown-link primary">
                                        <i class="fas fa-sign-in-alt"></i>
                                        <span>Log in</span>
                                    </a>
                                    <a href="{{ route('register') }}" class="dropdown-link">
                                        <i class="fas fa-user-plus"></i>
                                        <span>Sign up</span>
                                    </a>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-section">
                                    <a href="{{ route('properties.create') }}" class="dropdown-link">
                                        <i class="fas fa-home"></i>
                                        <span>NextBNB your home</span>
                                    </a>
                                    <a href="#" class="dropdown-link">
                                        <i class="fas fa-calendar"></i>
                                        <span>Host an experience</span>
                                    </a>
                                </div>
                            @else
                                <div class="dropdown-section user-info">
                                    <div class="user-greeting">
                                        <span class="greeting-text">Hi, {{ auth()->user()->name }}!</span>
                                        <span class="user-status">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-section">
                                    <a href="{{ route('trips') }}" class="dropdown-link">
                                        <i class="fas fa-suitcase"></i>
                                        <span>Your trips</span>
                                    </a>
                                    <a href="{{ route('wishlists.index') }}" class="dropdown-link">
                                        <i class="fas fa-heart"></i>
                                        <span>Wishlists</span>
                                    </a>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-section">
                                    <a href="{{ route('host.dashboard') }}" class="dropdown-link">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <span>Host Dashboard</span>
                                    </a>
                                    <a href="{{ route('host.properties') }}" class="dropdown-link">
                                        <i class="fas fa-building"></i>
                                        <span>Manage properties</span>
                                    </a>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-section">
                                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-link logout-btn">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Log out</span>
                                        </button>
                                    </form>
                                </div>
                            @endguest
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-section">
                                <a href="#" class="dropdown-link">
                                    <i class="fas fa-question-circle"></i>
                                    <span>Help Center</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </nav>
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

    <script src="{{ asset('js/nextbnb.js') }}"></script>
</body>
</html>