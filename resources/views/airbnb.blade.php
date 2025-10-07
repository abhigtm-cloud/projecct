<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextBNB - Vacation Rentals, Cabins, Beach Houses & More</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/nextbnb.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a href="#" class="nav-link">Stays</a>
                    <a href="#" class="nav-link">Experiences</a>
                </div>

                <!-- User Menu -->
                <div class="nav-user">
                    <a href="#" class="host-link">Airbnb your home</a>
                    <button class="globe-btn">
                        <i class="fas fa-globe"></i>
                    </button>
                    <div class="user-menu">
                        <button class="user-menu-btn">
                            <i class="fas fa-bars"></i>
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                        </button>
                        <div class="user-dropdown">
                            <a href="#" class="dropdown-item">Sign up</a>
                            <a href="#" class="dropdown-item">Log in</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Airbnb your home</a>
                            <a href="#" class="dropdown-item">Host an experience</a>
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
                
                <div class="search-inputs">
                    <div class="search-input-group">
                        <label class="search-label">Where</label>
                        <input type="text" placeholder="Search destinations" class="search-input">
                    </div>
                    <div class="search-divider"></div>
                    <div class="search-input-group">
                        <label class="search-label">Check in</label>
                        <input type="text" placeholder="Add dates" class="search-input">
                    </div>
                    <div class="search-divider"></div>
                    <div class="search-input-group">
                        <label class="search-label">Check out</label>
                        <input type="text" placeholder="Add dates" class="search-input">
                    </div>
                    <div class="search-divider"></div>
                    <div class="search-input-group">
                        <label class="search-label">Who</label>
                        <input type="text" placeholder="Add guests" class="search-input">
                    </div>
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Category Filters -->
    <div class="category-container">
        <div class="category-wrapper">
            <div class="category-scroll">
                <button class="category-item active">
                    <i class="fas fa-home"></i>
                    <span>Iconic cities</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-umbrella-beach"></i>
                    <span>Beach</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-mountain"></i>
                    <span>Mountains</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-tree"></i>
                    <span>Cabins</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-swimming-pool"></i>
                    <span>Amazing pools</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-fire"></i>
                    <span>Trending</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-city"></i>
                    <span>Design</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-leaf"></i>
                    <span>Countryside</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-water"></i>
                    <span>Lakefront</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-snowflake"></i>
                    <span>Skiing</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-wine-glass"></i>
                    <span>Vineyards</span>
                </button>
                <button class="category-item">
                    <i class="fas fa-castle"></i>
                    <span>Castles</span>
                </button>
            </div>
            
            <!-- Filters Button -->
            <div class="filters-section">
                <button class="filters-btn">
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
                <!-- Property Card 1 -->
                <div class="property-card">
                    <div class="property-images">
                        <img src="https://a0.muscache.com/im/pictures/miso/Hosting-53274539/original/365299e3-f926-47b0-bc3f-e5562c987655.jpeg" alt="Property" class="property-img">
                        <button class="wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <div class="image-indicators">
                            <span class="indicator active"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                        </div>
                    </div>
                    <div class="property-info">
                        <div class="property-location">
                            <h3>Lisbon, Portugal</h3>
                            <div class="property-rating">
                                <i class="fas fa-star"></i>
                                <span>4.91</span>
                            </div>
                        </div>
                        <p class="property-details">Stay with João · Host</p>
                        <p class="property-dates">Nov 5 – 12</p>
                        <div class="property-price">
                            <span class="price">$89</span>
                            <span class="price-unit">night</span>
                        </div>
                    </div>
                </div>

                <!-- Property Card 2 -->
                <div class="property-card">
                    <div class="property-images">
                        <img src="https://a0.muscache.com/im/pictures/hosting/Hosting-U3RheVN1cHBseUxpc3Rpbmc6MTE2MjI1NA%3D%3D/original/55a5cd54-c2c8-4351-888c-afa0867d936b.jpeg" alt="Property" class="property-img">
                        <button class="wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <div class="image-indicators">
                            <span class="indicator active"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                        </div>
                    </div>
                    <div class="property-info">
                        <div class="property-location">
                            <h3>Prague, Czech Republic</h3>
                            <div class="property-rating">
                                <i class="fas fa-star"></i>
                                <span>4.87</span>
                            </div>
                        </div>
                        <p class="property-details">686 kilometers away</p>
                        <p class="property-dates">Nov 1 – 8</p>
                        <div class="property-price">
                            <span class="price">$62</span>
                            <span class="price-unit">night</span>
                        </div>
                    </div>
                </div>

                <!-- Property Card 3 -->
                <div class="property-card">
                    <div class="property-images">
                        <img src="https://a0.muscache.com/im/pictures/miso/Hosting-53797406/original/2cc26140-5e64-4c35-b962-8c0c95de8634.jpeg" alt="Property" class="property-img">
                        <button class="wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <div class="image-indicators">
                            <span class="indicator active"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                        </div>
                    </div>
                    <div class="property-info">
                        <div class="property-location">
                            <h3>Barcelona, Spain</h3>
                            <div class="property-rating">
                                <i class="fas fa-star"></i>
                                <span>4.95</span>
                            </div>
                        </div>
                        <p class="property-details">859 kilometers away</p>
                        <p class="property-dates">Nov 12 – 19</p>
                        <div class="property-price">
                            <span class="price">$156</span>
                            <span class="price-unit">night</span>
                        </div>
                    </div>
                </div>

                <!-- Property Card 4 -->
                <div class="property-card">
                    <div class="property-images">
                        <img src="https://a0.muscache.com/im/pictures/miso/Hosting-53797604/original/976e4ce8-e99b-4c0c-b7b6-6c8df3b4d02e.jpeg" alt="Property" class="property-img">
                        <button class="wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <div class="image-indicators">
                            <span class="indicator active"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                        </div>
                    </div>
                    <div class="property-info">
                        <div class="property-location">
                            <h3>Rome, Italy</h3>
                            <div class="property-rating">
                                <i class="fas fa-star"></i>
                                <span>4.92</span>
                            </div>
                        </div>
                        <p class="property-details">1,243 kilometers away</p>
                        <p class="property-dates">Oct 28 – Nov 4</p>
                        <div class="property-price">
                            <span class="price">$134</span>
                            <span class="price-unit">night</span>
                        </div>
                    </div>
                </div>

                <!-- Property Card 5 -->
                <div class="property-card">
                    <div class="property-images">
                        <img src="https://a0.muscache.com/im/pictures/hosting/Hosting-U3RheVN1cHBseUxpc3Rpbmc6MTE0NDI1MzE1Nw%3D%3D/original/c92d2c87-b1c5-4b9d-a8e6-22b8d1ad250b.jpeg" alt="Property" class="property-img">
                        <button class="wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <div class="image-indicators">
                            <span class="indicator active"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                        </div>
                    </div>
                    <div class="property-info">
                        <div class="property-location">
                            <h3>Amsterdam, Netherlands</h3>
                            <div class="property-rating">
                                <i class="fas fa-star"></i>
                                <span>4.88</span>
                            </div>
                        </div>
                        <p class="property-details">1,156 kilometers away</p>
                        <p class="property-dates">Nov 2 – 9</p>
                        <div class="property-price">
                            <span class="price">$198</span>
                            <span class="price-unit">night</span>
                        </div>
                    </div>
                </div>

                <!-- Property Card 6 -->
                <div class="property-card">
                    <div class="property-images">
                        <img src="https://a0.muscache.com/im/pictures/miso/Hosting-53797818/original/b912f7e2-fa7b-4c0f-8b04-935e82b7e34e.jpeg" alt="Property" class="property-img">
                        <button class="wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <div class="image-indicators">
                            <span class="indicator active"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                        </div>
                    </div>
                    <div class="property-info">
                        <div class="property-location">
                            <h3>Paris, France</h3>
                            <div class="property-rating">
                                <i class="fas fa-star"></i>
                                <span>4.93</span>
                            </div>
                        </div>
                        <p class="property-details">1,034 kilometers away</p>
                        <p class="property-dates">Nov 15 – 22</p>
                        <div class="property-price">
                            <span class="price">$245</span>
                            <span class="price-unit">night</span>
                        </div>
                    </div>
                </div>

                <!-- More property cards would be repeated here -->
                @for($i = 0; $i < 12; $i++)
                <div class="property-card">
                    <div class="property-images">
                        <img src="https://a0.muscache.com/im/pictures/miso/Hosting-53274{{ $i+100 }}/original/365299e3-f926-47b0-bc3f-e5562c987655.jpeg" alt="Property" class="property-img">
                        <button class="wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <div class="image-indicators">
                            <span class="indicator active"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                            <span class="indicator"></span>
                        </div>
                    </div>
                    <div class="property-info">
                        <div class="property-location">
                            <h3>Beautiful Location {{ $i+1 }}</h3>
                            <div class="property-rating">
                                <i class="fas fa-star"></i>
                                <span>4.{{ 80 + $i }}</span>
                            </div>
                        </div>
                        <p class="property-details">{{ rand(100, 2000) }} kilometers away</p>
                        <p class="property-dates">Nov {{ rand(1, 28) }} – {{ rand(1, 28) }}</p>
                        <div class="property-price">
                            <span class="price">${{ rand(50, 300) }}</span>
                            <span class="price-unit">night</span>
                        </div>
                    </div>
                </div>
                @endfor
            </div>

            <!-- Load More -->
            <div class="load-more">
                <button class="load-more-btn">Continue exploring</button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">AirCover</a></li>
                    <li><a href="#">Anti-discrimination</a></li>
                    <li><a href="#">Disability support</a></li>
                    <li><a href="#">Cancellation options</a></li>
                    <li><a href="#">Report neighborhood concern</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Hosting</h3>
                <ul>
                    <li><a href="#">Airbnb your home</a></li>
                    <li><a href="#">AirCover for Hosts</a></li>
                    <li><a href="#">Hosting resources</a></li>
                    <li><a href="#">Community forum</a></li>
                    <li><a href="#">Hosting responsibly</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Airbnb</h3>
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
                    <span>© 2024 Airbnb Clone, Inc.</span>
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

    <script src="{{ asset('js/airbnb.js') }}"></script>
</body>
</html>