// Airbnb Clone JavaScript - Interactive Features

document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth Image Loading
    const propertyImages = document.querySelectorAll('.property-img');
    
    propertyImages.forEach(img => {
        // Set initial state
        img.classList.remove('loaded');
        
        // Create a new image to preload
        const imageLoader = new Image();
        
        imageLoader.onload = function() {
            // Once loaded, update the src and add loaded class
            img.src = this.src;
            img.classList.add('loaded');
        };
        
        imageLoader.onerror = function() {
            // If image fails to load, show placeholder
            img.style.display = 'none';
            const placeholder = img.parentElement.querySelector('.property-placeholder');
            if (!placeholder) {
                const placeholderDiv = document.createElement('div');
                placeholderDiv.className = 'property-placeholder';
                placeholderDiv.innerHTML = '<span>Image unavailable</span>';
                img.parentElement.appendChild(placeholderDiv);
            }
        };
        
        // Start loading
        imageLoader.src = img.src;
    });
    
    // Modern User Menu Dropdown
    const userMenuTrigger = document.querySelector('.user-menu-trigger');
    const userDropdownMenu = document.querySelector('.user-dropdown-menu');
    let dropdownTimeout;
    
    if (userMenuTrigger && userDropdownMenu) {
        // Show dropdown on hover
        userMenuTrigger.addEventListener('mouseenter', function() {
            clearTimeout(dropdownTimeout);
            userDropdownMenu.style.opacity = '1';
            userDropdownMenu.style.visibility = 'visible';
            userDropdownMenu.style.transform = 'translateY(0)';
        });
        
        // Keep dropdown open when hovering over it
        userDropdownMenu.addEventListener('mouseenter', function() {
            clearTimeout(dropdownTimeout);
        });
        
        // Hide dropdown when leaving both trigger and menu
        [userMenuTrigger, userDropdownMenu].forEach(element => {
            element.addEventListener('mouseleave', function() {
                dropdownTimeout = setTimeout(() => {
                    userDropdownMenu.style.opacity = '0';
                    userDropdownMenu.style.visibility = 'hidden';
                    userDropdownMenu.style.transform = 'translateY(-10px)';
                }, 200);
            });
        });
        
        // Also handle click for mobile
        userMenuTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            const isVisible = userDropdownMenu.style.opacity === '1';
            
            if (isVisible) {
                userDropdownMenu.style.opacity = '0';
                userDropdownMenu.style.visibility = 'hidden';
                userDropdownMenu.style.transform = 'translateY(-10px)';
            } else {
                userDropdownMenu.style.opacity = '1';
                userDropdownMenu.style.visibility = 'visible';
                userDropdownMenu.style.transform = 'translateY(0)';
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuTrigger.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                userDropdownMenu.style.opacity = '0';
                userDropdownMenu.style.visibility = 'hidden';
                userDropdownMenu.style.transform = 'translateY(-10px)';
            }
        });
    }
    
    // Search Input Focus Effects
    const searchInputGroups = document.querySelectorAll('.search-input-group');
    searchInputGroups.forEach(group => {
        const input = group.querySelector('.search-input');
        
        group.addEventListener('click', function() {
            input.focus();
        });
        
        input.addEventListener('focus', function() {
            group.style.backgroundColor = '#ebebeb';
            group.style.borderRadius = '32px';
        });
        
        input.addEventListener('blur', function() {
            group.style.backgroundColor = '';
            group.style.borderRadius = '';
        });
    });
    
    // Category Filter Selection
    const categoryItems = document.querySelectorAll('.category-item');
    categoryItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all items
            categoryItems.forEach(i => i.classList.remove('active'));
            // Add active class to clicked item
            this.classList.add('active');
        });
    });
    
    // Search Tabs
    const searchTabs = document.querySelectorAll('.search-tab');
    searchTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            searchTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Wishlist Heart Toggle
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.classList.add('liked');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.classList.remove('liked');
            }
        });
    });
    
    // Property Card Image Carousel (simplified version)
    const propertyCards = document.querySelectorAll('.property-card');
    propertyCards.forEach(card => {
        const indicators = card.querySelectorAll('.indicator');
        let currentIndex = 0;
        
        if (indicators.length > 1) {
            const imageContainer = card.querySelector('.property-images');
            let startX = 0;
            let isSwipping = false;
            
            // Touch/Swipe support
            imageContainer.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
                isSwipping = true;
            });
            
            imageContainer.addEventListener('touchend', function(e) {
                if (!isSwipping) return;
                
                const endX = e.changedTouches[0].clientX;
                const diffX = startX - endX;
                
                if (Math.abs(diffX) > 50) { // Minimum swipe distance
                    if (diffX > 0 && currentIndex < indicators.length - 1) {
                        // Swipe left - next image
                        currentIndex++;
                    } else if (diffX < 0 && currentIndex > 0) {
                        // Swipe right - previous image
                        currentIndex--;
                    }
                    
                    updateIndicators();
                }
                isSwipping = false;
            });
            
            // Mouse click navigation
            imageContainer.addEventListener('click', function(e) {
                e.preventDefault();
                const rect = this.getBoundingClientRect();
                const clickX = e.clientX - rect.left;
                const centerX = rect.width / 2;
                
                if (clickX > centerX && currentIndex < indicators.length - 1) {
                    currentIndex++;
                } else if (clickX < centerX && currentIndex > 0) {
                    currentIndex--;
                }
                
                updateIndicators();
            });
            
            function updateIndicators() {
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentIndex);
                });
            }
        }
    });
    
    // Filters Button
    const filtersBtn = document.querySelector('.filters-btn');
    if (filtersBtn) {
        filtersBtn.addEventListener('click', function() {
            // This would open a filters modal in a real app
            console.log('Filters clicked');
        });
    }
    
    // Toggle Switch
    const toggleInput = document.querySelector('#toggle');
    if (toggleInput) {
        toggleInput.addEventListener('change', function() {
            // Update price display logic would go here
            console.log('Toggle changed:', this.checked);
        });
    }
    
    // Smooth scroll for categories
    const categoryScroll = document.querySelector('.category-scroll');
    let isScrolling = false;
    
    if (categoryScroll) {
        // Add scroll buttons (optional enhancement)
        const scrollLeft = () => {
            categoryScroll.scrollBy({ left: -200, behavior: 'smooth' });
        };
        
        const scrollRight = () => {
            categoryScroll.scrollBy({ left: 200, behavior: 'smooth' });
        };
        
        // Keyboard navigation
        categoryScroll.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                scrollLeft();
            } else if (e.key === 'ArrowRight') {
                scrollRight();
            }
        });
    }
    
    // Load more functionality
    const loadMoreBtn = document.querySelector('.load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            this.textContent = 'Loading...';
            this.disabled = true;
            
            // Simulate loading more content
            setTimeout(() => {
                // In a real app, this would make an AJAX request
                console.log('Loading more properties...');
                this.textContent = 'Continue exploring';
                this.disabled = false;
            }, 2000);
        });
    }
    
    // Modern Navbar Scroll Effects
    let lastScrollTop = 0;
    const modernHeader = document.querySelector('.modern-header');
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Add shadow effect when scrolling
        if (scrollTop > 10) {
            modernHeader.style.boxShadow = '0 8px 30px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08)';
            modernHeader.style.background = 'rgba(255, 255, 255, 0.98)';
        } else {
            modernHeader.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.1)';
            modernHeader.style.background = 'linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%)';
        }
        
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });

    // Mobile Menu Toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navCenter = document.querySelector('.nav-center');
    
    if (mobileMenuToggle && navCenter) {
        mobileMenuToggle.addEventListener('click', function() {
            const isVisible = navCenter.style.display === 'flex';
            
            if (isVisible) {
                navCenter.style.display = 'none';
                mobileMenuToggle.classList.remove('active');
            } else {
                navCenter.style.display = 'flex';
                navCenter.style.position = 'absolute';
                navCenter.style.top = '100%';
                navCenter.style.left = '0';
                navCenter.style.right = '0';
                navCenter.style.background = 'white';
                navCenter.style.padding = '20px';
                navCenter.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
                navCenter.style.borderRadius = '0 0 20px 20px';
                mobileMenuToggle.classList.add('active');
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Search functionality - Form will submit naturally
    // No need to intercept the click event
    
    // Date picker simulation (you'd integrate with a real date picker)
    const dateInputs = document.querySelectorAll('.search-input[placeholder*="dates"]');
    dateInputs.forEach(input => {
        input.addEventListener('focus', function() {
            // This would open a date picker in a real app
            console.log('Date picker would open here');
        });
    });
    
    // Guest selector simulation
    const guestInput = document.querySelector('.search-input[placeholder*="guests"]');
    if (guestInput) {
        guestInput.addEventListener('focus', function() {
            // This would open a guest selector dropdown in a real app
            console.log('Guest selector would open here');
        });
    }
    
    // Scroll effects for header
    let lastScrollY = window.scrollY;
    
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.header');
        const currentScrollY = window.scrollY;
        
        if (currentScrollY > lastScrollY && currentScrollY > 100) {
            // Scrolling down
            header.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollY = currentScrollY;
    });
    
    // Property image error handling
    const images = document.querySelectorAll('.property-img');
    
    images.forEach(img => {
        img.addEventListener('error', function() {
            this.src = 'https://via.placeholder.com/400x300/f7f7f7/999999?text=No+Image';
        });
    });
    
    // Keyboard accessibility
    document.addEventListener('keydown', function(e) {
        // ESC key closes dropdowns
        if (e.key === 'Escape') {
            const dropdown = document.querySelector('.user-dropdown');
            if (dropdown) {
                dropdown.style.display = 'none';
            }
        }
    });
    
    // Performance optimization: Debounce scroll events
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Responsive navigation for mobile
    const handleResize = debounce(() => {
        const navLinks = document.querySelector('.nav-links');
        const searchContainer = document.querySelector('.search-container');
        
        if (window.innerWidth <= 950) {
            navLinks.style.display = 'none';
        } else {
            navLinks.style.display = 'flex';
        }
        
        if (window.innerWidth <= 550) {
            searchContainer.style.display = 'none';
        } else {
            searchContainer.style.display = 'block';
        }
    }, 100);
    
    window.addEventListener('resize', handleResize);
    handleResize(); // Call once on load
    
    // Add loading states
    function showLoading(element) {
        element.classList.add('loading');
        element.style.pointerEvents = 'none';
    }
    
    function hideLoading(element) {
        element.classList.remove('loading');
        element.style.pointerEvents = 'auto';
    }
    
    // Initialize tooltips (if needed)
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            // Tooltip logic would go here
        });
    });
    
    console.log('Airbnb Clone JavaScript loaded successfully!');
});