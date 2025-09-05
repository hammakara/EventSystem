@extends('layouts.client')

@section('content')
  <!-- Hero Section with Animated Background -->
  <article class="scale-cute" x-data="{ isLiked: false, isRegistered: false, showShareModal: false }">
    <div class="overflow-hidden rounded-3xl border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 shadow-lg hover:shadow-2xl transition-shadow duration-500">
      
      <!-- Event Image with Overlays -->
      <div class="relative aspect-[21/9] w-full bg-gradient-to-br from-violet-100 to-fuchsia-100 dark:from-neutral-800 dark:to-neutral-700">
        @php $img = $event->image ? asset('storage/'.$event->image) : 'https://picsum.photos/seed/event-'.$event->id.'/1200/500'; @endphp
        <img src="{{ $img }}" 
             alt="{{ $event->title }}" 
             class="h-full w-full object-cover transition-transform duration-700 hover:scale-105" />
             
        <!-- Gradient Overlays -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-500/20 to-violet-500/20"></div>
        
        <!-- Floating Action Buttons -->
        <div class="absolute top-6 right-6 flex flex-col gap-3">
          <!-- Like Button -->
          <button @click="isLiked = !isLiked" 
                  class="p-3 rounded-full bg-white/90 backdrop-blur shadow-lg transition-all duration-300 hover:scale-110" 
                  :class="isLiked ? 'text-red-500' : 'text-neutral-600'">
            <svg class="w-6 h-6 transition-all duration-300" :class="isLiked ? 'scale-110' : ''" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
            </svg>
          </button>
          
          <!-- Share Button -->
          <button @click="showShareModal = true" 
                  class="p-3 rounded-full bg-white/90 backdrop-blur shadow-lg transition-all duration-300 hover:scale-110 text-neutral-600 hover:text-fuchsia-600">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
              <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
            </svg>
          </button>
        </div>
        
        <!-- Event Info Overlay -->
        <div class="absolute bottom-6 left-6 right-6 slide-up-cute">
          <!-- Event Type Badge -->
          <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center rounded-full bg-white/95 backdrop-blur px-4 py-2 text-sm font-bold text-fuchsia-700 ring-2 ring-fuchsia-200 shadow-lg pulse-cute">
              🎯 {{ $event->type }}
            </span>
            <span class="inline-flex items-center rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2 text-sm font-bold text-white shadow-lg glow-cute">
              {{ optional($event->scheduled_at)->isFuture() ? '🚀 Upcoming Event' : '📅 Past Event' }}
            </span>
          </div>
          
          <!-- Title and Date -->
          <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-3 leading-tight">
            {{ $event->title }}
          </h1>
          
          <div class="flex flex-wrap items-center gap-4 text-white/90">
            <!-- Date -->
            <div class="flex items-center gap-2 bg-black/30 rounded-full px-4 py-2 backdrop-blur">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
              </svg>
              <span class="font-semibold">{{ optional($event->scheduled_at)->format('l, M d, Y · h:i A') }}</span>
            </div>
            
            <!-- Organizer -->
            <div class="flex items-center gap-2 bg-black/30 rounded-full px-4 py-2 backdrop-blur">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
              </svg>
              <span class="font-semibold">by {{ $event->organizer?->name }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content Area -->
      <div class="grid gap-8 p-6 sm:p-10 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-8">
          
          <!-- About Section -->
          <div class="slide-in-cute">
            <div class="flex items-center gap-3 mb-6">
              <span class="text-2xl">📝</span>
              <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">About this Event</h2>
            </div>
            
            <div class="bg-gradient-to-br from-violet-50 to-fuchsia-50 dark:from-neutral-800 dark:to-neutral-700 rounded-2xl p-6 space-y-4">
              <p class="text-lg text-neutral-700 dark:text-neutral-300 leading-relaxed">
                This amazing event is organized by <span class="font-bold text-fuchsia-600">{{ $event->organizer?->name }}</span> 
                and will be hosted at the beautiful <span class="font-bold text-violet-600">{{ $event->venue?->name }}</span>. 
                Get ready for an unforgettable experience! 🎉
              </p>
              
              <!-- Location Info -->
              <div class="flex items-start gap-3 p-4 bg-white/60 dark:bg-neutral-900/60 rounded-xl">
                <div class="p-2 bg-rose-100 dark:bg-rose-900/30 rounded-lg">
                  <svg class="w-5 h-5 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-neutral-900 dark:text-neutral-100">📍 Location</h4>
                  <p class="text-neutral-600 dark:text-neutral-400">{{ $event->venue?->address ?? $event->venue?->name }}</p>
                  @if($event->venue?->contact)
                    <p class="text-sm text-neutral-500 mt-1">📞 Contact: {{ $event->venue->contact }}</p>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <!-- Vendors Section -->
          @if($event->vendors->count())
            <div class="slide-up-cute stagger-2">
              <div class="flex items-center gap-3 mb-6">
                <span class="text-2xl">🏪</span>
                <h3 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">Amazing Vendors</h3>
                <span class="bg-fuchsia-100 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-300 px-3 py-1 rounded-full text-sm font-semibold">
                  {{ $event->vendors->count() }} vendor{{ $event->vendors->count() === 1 ? '' : 's' }}
                </span>
              </div>
              
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($event->vendors as $vendor)
                  <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 border border-violet-100 dark:border-neutral-700 hover-lift transition-all duration-300 group">
                    <div class="flex items-start justify-between mb-3">
                      <div class="flex items-center gap-3">
                        <div class="p-2 bg-gradient-to-br from-violet-100 to-fuchsia-100 dark:from-violet-900 dark:to-fuchsia-900 rounded-lg">
                          <span class="text-lg">🎯</span>
                        </div>
                        <div>
                          <h4 class="font-bold text-neutral-900 dark:text-neutral-100 group-hover:text-fuchsia-600 transition-colors">
                            {{ $vendor->name }}
                          </h4>
                          @if($vendor->contact)
                            <p class="text-sm text-neutral-500">{{ $vendor->contact }}</p>
                          @endif
                        </div>
                      </div>
                      
                      @if($vendor->pivot?->fee)
                        <div class="text-right">
                          <p class="text-xs text-neutral-500">Service Fee</p>
                          <p class="font-bold text-emerald-600">${{ number_format($vendor->pivot->fee, 0) }}</p>
                        </div>
                      @endif
                    </div>
                    
                    @if($vendor->pivot?->service_details)
                      <p class="text-sm text-neutral-600 dark:text-neutral-400 bg-neutral-50 dark:bg-neutral-900 rounded-lg p-3">
                        📝 {{ $vendor->pivot->service_details }}
                      </p>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          @endif
          
          <!-- Attendees Preview -->
          @if($event->attendees->count())
            <div class="slide-up-cute stagger-3">
              <div class="flex items-center gap-3 mb-6">
                <span class="text-2xl">👥</span>
                <h3 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">Who's Going?</h3>
              </div>
              
              <div class="bg-gradient-to-r from-violet-50 to-fuchsia-50 dark:from-neutral-800 dark:to-neutral-700 rounded-2xl p-6">
                <div class="flex items-center gap-4 mb-4">
                  <div class="flex -space-x-3">
                    @foreach($event->attendees->take(5) as $attendee)
                      <div class="w-10 h-10 rounded-full bg-gradient-to-br from-fuchsia-400 to-violet-400 flex items-center justify-center text-white font-bold border-2 border-white dark:border-neutral-800">
                        {{ strtoupper(substr($attendee->name, 0, 1)) }}
                      </div>
                    @endforeach
                    @if($event->attendees->count() > 5)
                      <div class="w-10 h-10 rounded-full bg-neutral-400 dark:bg-neutral-600 flex items-center justify-center text-white text-xs font-bold border-2 border-white dark:border-neutral-800">
                        +{{ $event->attendees->count() - 5 }}
                      </div>
                    @endif
                  </div>
                  <div>
                    <p class="font-bold text-neutral-900 dark:text-neutral-100">
                      {{ $event->attendees->count() }} {{ $event->attendees->count() === 1 ? 'person is' : 'people are' }} attending
                    </p>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Join this amazing community! 🎆</p>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>

        <!-- Cute Sidebar -->
        <aside class="space-y-6 slide-up-cute stagger-4">
          <!-- Event Details Card -->
          <div class="rounded-2xl border border-violet-100 dark:border-neutral-800 bg-gradient-to-br from-white to-violet-50 dark:from-neutral-900 dark:to-neutral-800 p-6 hover-lift">
            <div class="flex items-center gap-2 mb-4">
              <span class="text-xl">📅</span>
              <h3 class="font-bold text-neutral-900 dark:text-neutral-100">Event Details</h3>
            </div>
            
            <dl class="space-y-4 text-sm">
              <!-- Date & Time -->
              <div class="flex items-center gap-3 p-3 bg-white/60 dark:bg-neutral-900/60 rounded-xl">
                <div class="p-2 bg-violet-100 dark:bg-violet-900/30 rounded-lg">
                  <svg class="w-4 h-4 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <dt class="text-xs text-neutral-500 uppercase tracking-wide font-semibold">Date & Time</dt>
                  <dd class="font-semibold text-neutral-900 dark:text-neutral-100">{{ optional($event->scheduled_at)->format('M d, Y') }}</dd>
                  <dd class="text-xs text-neutral-600 dark:text-neutral-400">{{ optional($event->scheduled_at)->format('h:i A') }}</dd>
                </div>
              </div>
              
              <!-- Event Type -->
              <div class="flex items-center gap-3 p-3 bg-white/60 dark:bg-neutral-900/60 rounded-xl">
                <div class="p-2 bg-fuchsia-100 dark:bg-fuchsia-900/30 rounded-lg">
                  <span class="text-lg">🎯</span>
                </div>
                <div>
                  <dt class="text-xs text-neutral-500 uppercase tracking-wide font-semibold">Category</dt>
                  <dd class="font-semibold text-neutral-900 dark:text-neutral-100">{{ $event->type }}</dd>
                </div>
              </div>
              
              <!-- Organizer -->
              <div class="flex items-center gap-3 p-3 bg-white/60 dark:bg-neutral-900/60 rounded-xl">
                <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg">
                  <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                  </svg>
                </div>
                <div>
                  <dt class="text-xs text-neutral-500 uppercase tracking-wide font-semibold">Organizer</dt>
                  <dd class="font-semibold text-neutral-900 dark:text-neutral-100">{{ $event->organizer?->name }}</dd>
                </div>
              </div>
              
              <!-- Venue -->
              <div class="flex items-center gap-3 p-3 bg-white/60 dark:bg-neutral-900/60 rounded-xl">
                <div class="p-2 bg-rose-100 dark:bg-rose-900/30 rounded-lg">
                  <svg class="w-4 h-4 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div class="min-w-0 flex-1">
                  <dt class="text-xs text-neutral-500 uppercase tracking-wide font-semibold">Venue</dt>
                  <dd class="font-semibold text-neutral-900 dark:text-neutral-100 truncate">{{ $event->venue?->name }}</dd>
                  @if($event->venue?->address)
                    <dd class="text-xs text-neutral-600 dark:text-neutral-400 truncate">{{ $event->venue->address }}</dd>
                  @endif
                </div>
              </div>
            </dl>
          </div>
          
          <!-- Stats Cards -->
          <div class="grid grid-cols-2 gap-4">
            <!-- Attendees Card -->
            <div class="bg-gradient-to-br from-violet-100 to-fuchsia-100 dark:from-violet-900/20 dark:to-fuchsia-900/20 rounded-2xl p-4 text-center hover-bounce group">
              <div class="w-12 h-12 bg-violet-500 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                </svg>
              </div>
              <p class="text-2xl font-bold text-violet-700 dark:text-violet-300 pulse-cute">{{ $event->attendees->count() }}</p>
              <p class="text-xs text-neutral-600 dark:text-neutral-400 font-medium">Attendees</p>
            </div>
            
            <!-- Vendors Card -->
            <div class="bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-2xl p-4 text-center hover-bounce group">
              <div class="w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zM3 15a1 1 0 011-1h1a1 1 0 011 1v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-1zm7-13a1 1 0 011 1v9a1 1 0 01-2 0V3a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0V3a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
              </div>
              <p class="text-2xl font-bold text-emerald-700 dark:text-emerald-300 pulse-cute" style="animation-delay: 0.2s">{{ $event->vendors->count() }}</p>
              <p class="text-xs text-neutral-600 dark:text-neutral-400 font-medium">Vendors</p>
            </div>
          </div>
          
          <!-- CTA Buttons -->
          <div class="space-y-3">
            <button @click="isRegistered = !isRegistered" 
                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl px-6 py-4 font-bold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-fuchsia-500/50"
                    :class="isRegistered ? 'bg-gradient-to-r from-emerald-500 to-teal-500' : 'bg-gradient-to-r from-fuchsia-600 to-indigo-600 hover:from-fuchsia-700 hover:to-indigo-700'">
              <span x-show="!isRegistered" class="text-xl">🎉</span>
              <span x-show="isRegistered" class="text-xl">✓</span>
              <span x-text="isRegistered ? 'Registered!' : 'Register Interest'"></span>
            </button>
            
            <button @click="showShareModal = true" 
                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-white dark:bg-neutral-800 border-2 border-violet-200 dark:border-neutral-700 px-6 py-3 font-semibold text-violet-700 dark:text-violet-300 transition-all duration-300 hover:bg-violet-50 dark:hover:bg-neutral-700 hover:border-violet-300">
              <span class="text-lg">📤</span>
              <span>Share Event</span>
            </button>
          </div>
          
          <!-- Back Link -->
          <div class="pt-4 border-t border-violet-100 dark:border-neutral-800">
            <a href="{{ route('client.events.index') }}" 
               class="inline-flex items-center gap-2 text-sm text-fuchsia-700 dark:text-fuchsia-400 hover:text-fuchsia-900 dark:hover:text-fuchsia-300 font-semibold transition-colors duration-300 group">
              <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
              </svg>
              <span>Back to all events</span>
            </a>
          </div>
        </aside>
      </div>
    </div>
  </article>
@endsection
