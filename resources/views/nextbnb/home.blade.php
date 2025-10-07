<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextBNB - Vacation Rentals, Cabins, Beach Houses & More</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <!-- Logo -->
                <div class="nav-logo">
                    <a href="{{ route('home') }}" class="logo-link">
                        <svg width="102" height="32" style="color: #FF385C;">
                            <path d="M29.24 22.68c-.16-.39-.31-.8-.47-1.15l-.74-1.67-.03-.03c-2.2-4.8-4.55-9.68-7.04-14.48l-.1-.2c-.25-.47-.5-.99-.76-1.47-.32-.57-.63-1.18-1.14-1.76a5.3 5.3 0 00-8.2 0c-.47.58-.82 1.19-1.14 1.76-.25.52-.5 1.03-.76 1.5l-.1.2c-2.45 4.8-4.84 9.68-7.04 14.48l-.06.06c-.22.52-.48 1.06-.73 1.64-.16.35-.32.73-.48 1.15a6.8 6.8 0 007.2 9.23 8.38 8.38 0 003.18-1.1c1.3-.73 2.55-1.79 3.95-3.32 1.4 1.53 2.68 2.59 3.95 3.33A8.38 8.38 0 0022.75 32a6.79 6.79 0 006.75-5.83 5.94 5.94 0 00-.26-3.5zm-14.36 1.66c-1.72-2.2-2.84-4.22-3.22-5.95a5.2 5.2 0 01-.1-1.96c.07-.51.26-.96.52-1.34.6-.87 1.65-1.41 2.8-1.41a3.3 3.3 0 012.8 1.4c.26.4.45.84.51 1.35.1.58.06 1.25-.1 1.96-.38 1.7-1.5 3.74-3.21 5.95zm12.74 1.48a4.76 4.76 0 01-2.9 3.75c-.76.32-1.6.41-2.42.32-.8-.1-1.6-.36-2.42-.84a27.17 27.17 0 01-2.49-2.34c-1.85-2.5-2.5-4.6-1.89-6.84a4.67 4.67 0 012.43-2.75c.85-.32 1.8-.24 2.64.13a5.39 5.39 0 012.57 2.15c.4.55.71 1.2.87 1.9.19.9.13 1.9-.4 2.52z" fill="currentColor"></path>
                        </svg>
                        <span class="logo-text">nextbnb</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="nav-links">
                    <a href="{{ route('properties.index') }}" class="nav-link">Stays</a>
                    <a href="#" class="nav-link">Experiences</a>
                </div>

                <!-- User Menu -->
                <div class="nav-user">
                    @auth
                        <a href="{{ route('host.dashboard') }}" class="host-link">Host Dashboard</a>
                    @else
                        <a href="{{ route('properties.create') }}" class="host-link">NextBNB your home</a>
                    @endauth
                    
                    <button class="globe-btn">
                        <i class="fas fa-globe"></i>
                    </button>
                    <div class="user-menu">
                        <button class="user-menu-btn">
                            <i class="fas fa-bars"></i>
                            <div class="user-avatar">
                                @auth
                                    @if(auth()->user()->profile_photo)
                                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                                    @else
                                        <span>{{ auth()->user()->initials }}</span>
                                    @endif
                                @else
                                    <i class="fas fa-user"></i>
                                @endauth
                            </div>
                        </button>
                        <div class="user-dropdown">
                            @guest
                                <a href="{{ route('login') }}" class="dropdown-item">Log in</a>
                                <a href="{{ route('register') }}" class="dropdown-item">Sign up</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('properties.create') }}" class="dropdown-item">NextBNB your home</a>
                            @else
                                <a href="{{ route('trips') }}" class="dropdown-item">Your trips</a>
                                <a href="{{ route('wishlists.index') }}" class="dropdown-item">Wishlists</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('host.dashboard') }}" class="dropdown-item">Host Dashboard</a>
                                <a href="{{ route('host.properties') }}" class="dropdown-item">Manage properties</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log out</button>
                                </form>
                            @endguest
                            <a href="#" class="dropdown-item">Help Center</a>
                        </div>
                    </div>
                </div>
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
            <!-- Property Listings Grid -->
            <div class="listings-grid">
                @forelse($featuredProperties as $property)
                    <a href="{{ route('properties.show', $property) }}" class="property-card-link">
                        <div class="property-card" data-property-id="{{ $property->id }}">
                            <div class="property-images">
                                @if($property->images->count() > 0)
                                    <img src="{{ $property->primary_image_url }}" alt="{{ $property->title }}" class="property-img">
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
                                <span class="price-unit">night</span>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                    <div class="empty-state">
                        <h2>No properties available</h2>
                        <p>Be the first to list your property!</p>
                        @auth
                            <a href="{{ route('properties.create') }}" class="btn btn-primary">List your property</a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary">Sign up to list</a>
                        @endauth
                    </div>
                @endforelse
            </div>

            @if($featuredProperties->count() >= 12)
                <!-- Load More -->
                <div class="load-more">
                    <a href="{{ route('properties.index') }}" class="load-more-btn">
                        Continue exploring amazing stays
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