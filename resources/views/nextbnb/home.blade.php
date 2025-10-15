@php
    use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextBNB - Vacation Rentals, Cabins, Beach Houses & More</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/nextbnb.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .property-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
            cursor: pointer;
        }
        .property-card-link:hover {
            text-decoration: none;
            color: inherit;
        }
    </style>
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

        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-bar">
                <div class="search-tabs">
                    <button class="search-tab active">Stays</button>
                    <button class="search-tab">Experiences</button>
                </div>
                
                <form action="{{ route('search') }}" method="GET" class="search-inputs">
                    <div class="search-input-group">
                        <label class="search-label">Where</label>
                        <input type="text" name="location" placeholder="Search destinations" class="search-input" value="{{ request('location') }}">
                    </div>
                    <div class="search-divider"></div>
                    <div class="search-input-group">
                        <label class="search-label">Check in</label>
                        <input type="date" name="check_in" class="search-input" value="{{ request('check_in') }}">
                    </div>
                    <div class="search-divider"></div>
                    <div class="search-input-group">
                        <label class="search-label">Check out</label>
                        <input type="date" name="check_out" class="search-input" value="{{ request('check_out') }}">
                    </div>
                    <div class="search-divider"></div>
                    <div class="search-input-group">
                        <label class="search-label">Who</label>
                        <select name="guests" class="search-input">
                            <option value="">Add guests</option>
                            @for($i = 1; $i <= 16; $i++)
                                <option value="{{ $i }}" {{ request('guests') == $i ? 'selected' : '' }}>
                                    {{ $i }} guest{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Category Filters -->
    <div class="category-container">
        <div class="category-wrapper">
            <div class="category-scroll">
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}" class="category-item {{ request()->route('category') && request()->route('category')->slug === $category->slug ? 'active' : '' }}">
                        <i class="{{ $category->icon }}"></i>
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
            
            <!-- Filters Button -->
            <div class="filters-section">
                <button class="filters-btn" data-toggle="modal" data-target="#filtersModal">
                    <i class="fas fa-sliders-h"></i>
                    Filters
                </button>
                <button class="display-toggle">
                    <span>Display total before taxes</span>
                    <div class="toggle-switch">
                        <input type="checkbox" id="toggle">
                        <label for="toggle"></label>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="listings-container">
            @if($featuredProperties->count() > 0)
                <!-- Featured Properties Section -->
                <div class="listings-section">
                    <div class="section-header">
                        <h2 class="section-title">Featured destinations</h2>
                    </div>
                    <div class="listings-grid">
                        @foreach($featuredProperties->take(8) as $property)
                            <a href="{{ route('properties.show', $property) }}" class="property-card-link">
                                <div class="property-card" data-property-id="{{ $property->id }}">
                                    <div class="property-images">
                                        @if($property->images->count() > 0)
                                            @php
                                                $imagePath = $property->images->first()->image_path;
                                                $imageUrl = (str_starts_with($imagePath, 'http')) ? $imagePath : Storage::url($imagePath);
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $property->title }}" class="property-img" loading="lazy">
                                        @else
                                            <div class="property-placeholder">
                                                <span>No Image</span>
                                            </div>
                                        @endif
                                        
                                        <button class="wishlist-btn" data-property-id="{{ $property->id }}" onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist({{ $property->id }})">
                                            @auth
                                                <i class="{{ $property->isWishlistedBy(auth()->id()) ? 'fas' : 'far' }} fa-heart"></i>
                                            @else
                                                <i class="far fa-heart"></i>
                                            @endauth
                                        </button>
                                        
                                        @if($property->images->count() > 1)
                                            <div class="image-indicators">
                                                @foreach($property->images->take(5) as $index => $image)
                                                    <span class="indicator {{ $index === 0 ? 'active' : '' }}"></span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="property-info">
                                        <div class="property-location">
                                            <h3>{{ $property->title }}</h3>
                                            <div class="property-rating">
                                                @if($property->rating > 0)
                                                    <i class="fas fa-star"></i>
                                                    <span>{{ number_format($property->rating, 2) }}</span>
                                                @else
                                                    <span class="no-rating">New</span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        <p class="property-details">{{ $property->city }}, {{ $property->country }}</p>
                                        <p class="property-host">Hosted by {{ $property->host->full_name }}</p>
                                        
                                        <div class="property-price">
                                            <span class="price">${{ number_format($property->price_per_night, 0) }}</span>
                                            <span class="price-unit"> night</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                @if($featuredProperties->count() > 8)
                <!-- More Properties Section -->
                <div class="listings-section">
                    <div class="section-header">
                        <h2 class="section-title">More amazing stays</h2>
                    </div>
                    <div class="listings-grid">
                        @foreach($featuredProperties->skip(8)->take(8) as $property)
                            <a href="{{ route('properties.show', $property) }}" class="property-card-link">
                                <div class="property-card" data-property-id="{{ $property->id }}">
                                    <div class="property-images">
                                        @if($property->images->count() > 0)
                                            @php
                                                $imagePath = $property->images->first()->image_path;
                                                $imageUrl = (str_starts_with($imagePath, 'http')) ? $imagePath : Storage::url($imagePath);
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $property->title }}" class="property-img" loading="lazy">
                                        @else
                                            <div class="property-placeholder">
                                                <span>No Image</span>
                                            </div>
                                        @endif
                                        
                                        <button class="wishlist-btn" data-property-id="{{ $property->id }}" onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist({{ $property->id }})">
                                            @auth
                                                <i class="{{ $property->isWishlistedBy(auth()->id()) ? 'fas' : 'far' }} fa-heart"></i>
                                            @else
                                                <i class="far fa-heart"></i>
                                            @endauth
                                        </button>
                                        
                                        @if($property->images->count() > 1)
                                            <div class="image-indicators">
                                                @foreach($property->images->take(5) as $index => $image)
                                                    <span class="indicator {{ $index === 0 ? 'active' : '' }}"></span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="property-info">
                                        <div class="property-location">
                                            <h3>{{ $property->title }}</h3>
                                            <div class="property-rating">
                                                @if($property->rating > 0)
                                                    <i class="fas fa-star"></i>
                                                    <span>{{ number_format($property->rating, 2) }}</span>
                                                @else
                                                    <span class="no-rating">New</span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        <p class="property-details">{{ $property->city }}, {{ $property->country }}</p>
                                        <p class="property-host">Hosted by {{ $property->host->full_name }}</p>
                                        
                                        <div class="property-price">
                                            <span class="price">${{ number_format($property->price_per_night, 0) }}</span>
                                            <span class="price-unit"> night</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            @else
                <div class="empty-state">
                    <h2>No properties available</h2>
                    <p>Be the first to list your property!</p>
                    @auth
                        <a href="{{ route('properties.create') }}" class="btn btn-primary">List your property</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign up to list</a>
                    @endauth
                </div>
            @endif

            <!-- Show All Properties Link -->
            @if($featuredProperties->count() > 0)
            <div class="show-all-section">
                <a href="{{ route('properties.index') }}" class="show-all-btn">
                    Show all properties
                </a>
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">NextCover</a></li>
                    <li><a href="#">Anti-discrimination</a></li>
                    <li><a href="#">Disability support</a></li>
                    <li><a href="#">Cancellation options</a></li>
                    <li><a href="#">Report neighborhood concern</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Hosting</h3>
                <ul>
                    <li><a href="{{ route('properties.create') }}">NextBNB your home</a></li>
                    <li><a href="#">NextCover for Hosts</a></li>
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
                    <li><a href="#">Gift cards</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <div class="footer-left">
                    <span>© 2024 NextBNB, Inc.</span>
                    <span>·</span>
                    <a href="#">Terms</a>
                    <span>·</span>
                    <a href="#">Sitemap</a>
                    <span>·</span>
                    <a href="#">Privacy</a>
                    <span>·</span>
                    <a href="#">Your Privacy Choices</a>
                </div>
                <div class="footer-right">
                    <button class="language-btn">
                        <i class="fas fa-globe"></i>
                        English (US)
                    </button>
                    <button class="currency-btn">
                        $ USD
                    </button>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/nextbnb.js') }}"></script>
</body>
</html>