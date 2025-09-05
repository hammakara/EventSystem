import "./bootstrap";

import Alpine from "alpinejs";

// Performance optimization: defer Alpine initialization until DOM is ready
window.Alpine = Alpine;

// Add global Alpine stores for shared state
Alpine.store("events", {
    filters: {
        status: "",
        search: "",
    },
    setFilter(type, value) {
        this.filters[type] = value;
    },
    clearFilters() {
        this.filters = { status: "", search: "" };
    },
});

Alpine.store("dashboard", {
    refreshing: false,
    async refreshData() {
        this.refreshing = true;
        try {
            // Trigger a refresh of dashboard data
            window.location.reload();
        } finally {
            this.refreshing = false;
        }
    },
});

// Add auth-specific store for shared auth state
Alpine.store("auth", {
    formErrors: {},
    isSubmitting: false,
    showNotification: false,
    notification: {
        type: 'success',
        message: '',
        icon: '✨'
    },
    
    setFormErrors(errors) {
        this.formErrors = errors;
        // Auto-clear errors after 5 seconds
        setTimeout(() => {
            this.formErrors = {};
        }, 5000);
    },
    
    showSuccess(message, icon = '🎉') {
        this.notification = { type: 'success', message, icon };
        this.showNotification = true;
        setTimeout(() => {
            this.showNotification = false;
        }, 4000);
    },
    
    showError(message, icon = '😕') {
        this.notification = { type: 'error', message, icon };
        this.showNotification = true;
        setTimeout(() => {
            this.showNotification = false;
        }, 5000);
    }
});

// Add performance utilities
Alpine.magic("debounce", () => {
    return (func, delay = 300) => {
        let timeoutId;
        return (...args) => {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(this, args), delay);
        };
    };
});

Alpine.magic("throttle", () => {
    return (func, delay = 100) => {
        let lastCall = 0;
        return (...args) => {
            const now = Date.now();
            if (now - lastCall >= delay) {
                lastCall = now;
                return func.apply(this, args);
            }
        };
    };
});

// Add auth-specific magic helpers
Alpine.magic("validateEmail", () => {
    return (email) => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    };
});

Alpine.magic("passwordStrength", () => {
    return (password) => {
        let strength = 0;
        let feedback = [];
        
        if (password.length >= 8) {
            strength += 25;
        } else {
            feedback.push('At least 8 characters');
        }
        
        if (/[A-Z]/.test(password)) {
            strength += 25;
        } else {
            feedback.push('One uppercase letter');
        }
        
        if (/[0-9]/.test(password)) {
            strength += 25;
        } else {
            feedback.push('One number');
        }
        
        if (/[^A-Za-z0-9]/.test(password)) {
            strength += 25;
        } else {
            feedback.push('One special character');
        }
        
        return {
            score: strength,
            level: strength < 50 ? 'weak' : strength < 75 ? 'medium' : 'strong',
            feedback: feedback
        };
    };
});

// Add cute animation helpers
Alpine.magic("cuteAnimate", () => {
    return {
        wiggle(element) {
            element.classList.add('wiggle-cute');
            setTimeout(() => {
                element.classList.remove('wiggle-cute');
            }, 500);
        },
        bounce(element) {
            element.classList.add('animate__animated', 'animate__bounce');
            setTimeout(() => {
                element.classList.remove('animate__animated', 'animate__bounce');
            }, 1000);
        },
        pulse(element) {
            element.classList.add('pulse-cute');
            setTimeout(() => {
                element.classList.remove('pulse-cute');
            }, 2000);
        },
        shake(element) {
            element.classList.add('animate__animated', 'animate__shakeX');
            setTimeout(() => {
                element.classList.remove('animate__animated', 'animate__shakeX');
            }, 1000);
        },
        celebrate(element) {
            // Create confetti effect
            const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3'];
            const confetti = document.createElement('div');
            confetti.style.position = 'fixed';
            confetti.style.top = '0';
            confetti.style.left = '0';
            confetti.style.width = '100%';
            confetti.style.height = '100%';
            confetti.style.pointerEvents = 'none';
            confetti.style.zIndex = '9999';
            
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.width = '10px';
                particle.style.height = '10px';
                particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.appendChild(particle);
            }
            
            document.body.appendChild(confetti);
            
            setTimeout(() => {
                document.body.removeChild(confetti);
            }, 5000);
        }
    };
});

// Add form validation directive
Alpine.directive('validate', (el, { expression }, { evaluate }) => {
    const rules = evaluate(expression);
    
    el.addEventListener('blur', () => {
        const value = el.value;
        let isValid = true;
        let errorMessage = '';
        
        // Check required
        if (rules.required && !value.trim()) {
            isValid = false;
            errorMessage = 'This field is required';
        }
        
        // Check email
        if (rules.email && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address';
        }
        
        // Check min length
        if (rules.minLength && value.length < rules.minLength) {
            isValid = false;
            errorMessage = `Minimum ${rules.minLength} characters required`;
        }
        
        // Update UI based on validation
        const container = el.closest('.relative') || el.parentElement;
        const existingError = container.querySelector('.validation-error');
        
        if (existingError) {
            existingError.remove();
        }
        
        if (!isValid) {
            el.classList.add('border-red-500', 'animate__animated', 'animate__shakeX');
            const errorEl = document.createElement('p');
            errorEl.className = 'validation-error text-red-500 text-xs mt-1 animate__animated animate__fadeIn';
            errorEl.textContent = errorMessage;
            container.appendChild(errorEl);
            
            setTimeout(() => {
                el.classList.remove('animate__animated', 'animate__shakeX');
            }, 1000);
        } else {
            el.classList.remove('border-red-500');
            el.classList.add('border-green-500');
            setTimeout(() => {
                el.classList.remove('border-green-500');
            }, 2000);
        }
    });
});

// Start Alpine with optimizations
document.addEventListener("DOMContentLoaded", () => {
    // Only start Alpine after DOM is ready
    Alpine.start();

    // Add intersection observer for lazy loading
    if ("IntersectionObserver" in window) {
        const lazyElements = document.querySelectorAll("[data-lazy]");
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    element.classList.add(
                        "animate__animated",
                        "animate__fadeInUp"
                    );
                    observer.unobserve(element);
                }
            });
        });

        lazyElements.forEach((element) => observer.observe(element));
    }
});
