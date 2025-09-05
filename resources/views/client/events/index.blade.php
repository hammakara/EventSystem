@extends('layouts.client')

@section('content')
  <!-- Hero Section with Cute Animations -->
  <section class="relative overflow-hidden rounded-3xl border border-violet-100 bg-white dark:bg-neutral-900 p-6 sm:p-10 shadow-sm scale-cute" 
           x-data="{ showFilters: false, isSearching: false }"
           data-lazy>
    <!-- Animated Background Blobs -->
    <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-gradient-to-br from-indigo-200 to-purple-300 opacity-40 blur-3xl float-cute"></div>
    <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-gradient-to-tr from-pink-200 to-rose-300 opacity-40 blur-3xl float-cute" style="animation-delay: 1.5s"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-gradient-to-r from-fuchsia-100 to-violet-100 opacity-20 blur-3xl float-cute" style="animation-delay: 0.8s"></div>

    <div class="relative z-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
      <div class="max-w-3xl slide-in-cute">
        <!-- Cute Title with Emojis -->
        <div class="flex items-center gap-3 mb-2">
          <span class="text-4xl bounce-cute">🎉</span>
          <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100 bg-gradient-to-r from-fuchsia-600 to-violet-600 bg-clip-text text-transparent">
            Discover Amazing Events
          </h1>
          <span class="text-3xl bounce-cute" style="animation-delay: 0.5s">✨</span>
        </div>
        <p class="mt-2 text-lg text-neutral-600 dark:text-neutral-400">Find the perfect event by type, date, organizer, or venue. Let's make memories! 💫</p>

        <div class="mt-4 inline-flex rounded-full border border-violet-100 dark:border-neutral-800 bg-gray-50 dark:bg-neutral-900 p-1 text-sm">
          @php $s = request('status','all'); @endphp
          <a href="{{ route('client.events.index', array_merge(request()->except('page'), ['status' => 'all'])) }}" class="px-3 py-1.5 rounded-full {{ $s==='all' ? 'bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 shadow-sm' : 'text-neutral-600 dark:text-neutral-300 hover:text-neutral-900' }}">
            All <span class="opacity-60">({{ $counts['all'] ?? $events->total() }})</span>
          </a>
          <a href="{{ route('client.events.index', array_merge(request()->except('page'), ['status' => 'upcoming'])) }}" class="px-3 py-1.5 rounded-full {{ $s==='upcoming' ? 'bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 shadow-sm' : 'text-neutral-600 dark:text-neutral-300 hover:text-neutral-900' }}">
            Upcoming <span class="opacity-60">({{ $counts['upcoming'] ?? '' }})</span>
          </a>
          <a href="{{ route('client.events.index', array_merge(request()->except('page'), ['status' => 'past'])) }}" class="px-3 py-1.5 rounded-full {{ $s==='past' ? 'bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 shadow-sm' : 'text-neutral-600 dark:text-neutral-300 hover:text-neutral-900' }}">
            Past <span class="opacity-60">({{ $counts['past'] ?? '' }})</span>
          </a>
        </div>

        <div class="mt-6 relative max-w-2xl">
          <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-neutral-400">🔎</span>
          <input form="filters" x-model="q" id="q" name="q" type="text" value="{{ request('q') }}" placeholder="Search events by title, organizer, or venue..." class="pl-9 pr-32 py-3 w-full rounded-2xl border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 focus:border-fuchsia-500 focus:ring-fuchsia-500" />
          <button type="button" x-show="q" x-on:click="q=''; $nextTick(()=>{document.getElementById('q').value='';})" class="absolute right-28 top-1.5 inline-flex h-9 w-9 items-center justify-center rounded-full border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-neutral-400 hover:text-neutral-700" aria-label="Clear search">✕</button>
          <button form="filters" type="submit" class="absolute right-1 top-1 inline-flex items-center rounded-xl bg-gradient-to-r from-fuchsia-600 to-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:from-fuchsia-700 hover:to-indigo-700">Search</button>
        </div>

        @if(!empty($popularTypes) && count($popularTypes))
          <div class="mt-3 flex flex-wrap items-center gap-2 text-xs">
            <span class="text-neutral-500">Popular:</span>
            @foreach($popularTypes as $t)
              <a href="{{ route('client.events.index', array_merge(request()->except('page'), ['type' => $t])) }}" class="inline-flex items-center rounded-full border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 px-3 py-1.5 text-neutral-700 dark:text-neutral-300 hover:bg-violet-50 dark:hover:bg-neutral-800">{{ $t }}</a>
            @endforeach
          </div>
        @endif
      </div>
    </div>

    <form id="filters" x-data="{ q: @js(request('q')), venue: @js(request('venue')), organizer: @js(request('organizer')) }" method="GET" action="{{ route('client.events.index') }}" class="relative z-10 mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-12">
      <input type="hidden" name="status" value="{{ request('status','all') }}" />


      <div class="lg:col-span-2">
        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300" for="type">Type</label>
        <div class="mt-1 relative group">
          <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-neutral-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z"/></svg>
          </span>
          <select id="type" name="type" class="appearance-none pl-9 pr-9 py-2.5 w-full rounded-xl border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 focus:border-fuchsia-500 focus:ring-fuchsia-500">
            <option value="">All types</option>
            @foreach($types as $t)
              <option value="{{ $t }}" @selected(request('type') === $t)>{{ $t }}</option>
            @endforeach
          </select>
          <span class="pointer-events-none absolute inset-y-0 right-3 inline-flex items-center text-neutral-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5H7z"/></svg>
          </span>
        </div>
      </div>

      <div class="lg:col-span-2">
        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300" for="start_date">From</label>
        <div class="mt-1 relative">
          <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-neutral-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2a1 1 0 011 1v1h8V3a1 1 0 112 0v1h1a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h1V3a1 1 0 112 0v1zm13 6H4v10h16V8z"/></svg>
          </span>
          <input id="start_date" name="start_date" type="date" value="{{ request('start_date') }}" class="appearance-none pl-9 pr-3 py-2.5 w-full rounded-xl border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 focus:border-fuchsia-500 focus:ring-fuchsia-500" />
        </div>
      </div>
      <div class="lg:col-span-2">
        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300" for="end_date">To</label>
        <div class="mt-1 relative">
          <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-neutral-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2a1 1 0 011 1v1h8V3a1 1 0 112 0v1h1a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h1V3a1 1 0 112 0v1zm13 6H4v10h16V8z"/></svg>
          </span>
          <input id="end_date" name="end_date" type="date" value="{{ request('end_date') }}" class="appearance-none pl-9 pr-3 py-2.5 w-full rounded-xl border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 focus:border-fuchsia-500 focus:ring-fuchsia-500" />
        </div>
      </div>

      <div class="lg:col-span-1">
        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300" for="sort">Sort</label>
        <div class="mt-1 relative">
          <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-neutral-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M6 7h12v2H6V7zm0 4h8v2H6v-2zm0 4h4v2H6v-2z"/></svg>
          </span>
          <select id="sort" name="sort" class="appearance-none pl-9 pr-9 py-2.5 w-full rounded-xl border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 focus:border-fuchsia-500 focus:ring-fuchsia-500">
            <option value="date_asc" @selected(request('sort','date_asc')==='date_asc')>Date ↑</option>
            <option value="date_desc" @selected(request('sort')==='date_desc')>Date ↓</option>
            <option value="title_asc" @selected(request('sort')==='title_asc')>Title A→Z</option>
            <option value="title_desc" @selected(request('sort')==='title_desc')>Title Z→A</option>
          </select>
          <span class="pointer-events-none absolute inset-y-0 right-3 inline-flex items-center text-neutral-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5H7z"/></svg>
          </span>
        </div>
      </div>

      <div class="lg:col-span-12 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-6">
        <div class="lg:col-span-3">
          <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300" for="venue">Venue contains</label>
          <div class="mt-1 relative">
            <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-neutral-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/></svg>
            </span>
            <input x-model="venue" id="venue" name="venue" type="text" value="{{ request('venue') }}" placeholder="Venue name or address" class="appearance-none pl-9 pr-10 py-2.5 w-full rounded-xl border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 focus:border-fuchsia-500 focus:ring-fuchsia-500" />
            <button type="button" x-show="venue" x-on:click="venue=''; $nextTick(()=>{document.getElementById('venue').value='';})" class="absolute right-2 top-1/2 -translate-y-1/2 inline-flex h-8 w-8 items-center justify-center rounded-full border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-neutral-400 hover:text-neutral-700" aria-label="Clear venue">✕</button>
          </div>
        </div>
        <div class="lg:col-span-3">
          <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300" for="organizer">Organizer contains</label>
          <div class="mt-1 relative">
            <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-neutral-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4 0-7 2-7 4.5V21h14v-2.5c0-2.5-3-4.5-7-4.5z"/></svg>
            </span>
            <input x-model="organizer" id="organizer" name="organizer" type="text" value="{{ request('organizer') }}" placeholder="Organizer name" class="appearance-none pl-9 pr-10 py-2.5 w-full rounded-xl border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 focus:border-fuchsia-500 focus:ring-fuchsia-500" />
            <button type="button" x-show="organizer" x-on:click="organizer=''; $nextTick(()=>{document.getElementById('organizer').value='';})" class="absolute right-2 top-1/2 -translate-y-1/2 inline-flex h-8 w-8 items-center justify-center rounded-full border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-neutral-400 hover:text-neutral-700" aria-label="Clear organizer">✕</button>
          </div>
        </div>
      </div>

      <div class="lg:col-span-12 flex flex-wrap items-center gap-3 pt-2">
        <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-fuchsia-600 to-indigo-600 px-5 py-2.5 font-medium text-white shadow-sm hover:from-fuchsia-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-fuchsia-500">Apply filters</button>
        @php $hasFilters = collect(['q','type','start_date','end_date','venue','organizer'])->some(fn($k)=>filled(request($k))); @endphp
        @if($hasFilters)
          <a href="{{ route('client.events.index', ['status'=>request('status','all')]) }}" class="text-sm text-neutral-600 dark:text-neutral-300 hover:text-neutral-900">Reset</a>
        @endif

        <div class="flex flex-wrap gap-2">
          @foreach(['q'=>'Search','type'=>'Type','start_date'=>'From','end_date'=>'To','venue'=>'Venue','organizer'=>'Organizer'] as $k=>$label)
            @if(filled(request($k)))
              <a href="{{ route('client.events.index', array_merge(request()->except($k,'page'), ['status'=>request('status','all')])) }}" class="inline-flex items-center gap-1 rounded-full border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 px-3 py-1.5 text-xs text-neutral-700 dark:text-neutral-300 hover:bg-violet-50 dark:hover:bg-neutral-800">
                <span class="font-medium">{{ $label }}:</span> <span class="line-clamp-1 max-w-[12rem]">{{ request($k) }}</span>
                <span class="text-neutral-400">✕</span>
              </a>
            @endif
          @endforeach
        </div>
      </div>
    </form>
  </section>

  <!-- Events Grid with Cute Animations -->
  <section class="mt-8 slide-up-cute">
    <!-- Results Header with Cute Stats -->
    <div class="mb-6 flex items-center justify-between slide-in-cute">
      <div class="flex items-center gap-3">
        <span class="text-2xl">📊</span>
        <div>
          <p class="text-sm text-neutral-600 dark:text-neutral-400">
            Showing <span class="font-bold text-fuchsia-600 text-lg pulse-cute">{{ $events->total() }}</span> 
            amazing event{{ $events->total() === 1 ? '' : 's' }}
          </p>
          <p class="text-xs text-neutral-500">✨ Ready to explore? Let's go!</p>
        </div>
      </div>
      
      <!-- View Toggle Button -->
      <div class="flex items-center gap-2">
        <button class="p-2 rounded-lg border border-violet-100 dark:border-neutral-800 hover:bg-violet-50 dark:hover:bg-neutral-800 transition-colors wiggle-cute" 
                title="Grid View">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
          </svg>
        </button>
      </div>
    </div>

    @if($events->count())
      <!-- Cute Event Cards Grid -->
      <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 xl:grid-cols-3" 
           x-data="{ hoveredCard: null }">
        @foreach($events as $event)
          @php $isUpcoming = optional($event->scheduled_at)->isFuture(); @endphp
          <article class="group relative overflow-hidden rounded-3xl border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 shadow-lg hover-lift hover-glow transition-all duration-500 ease-out slide-up-cute stagger-{{ ($loop->index % 6) + 1 }}" 
                   x-data="{ isLiked: false }"
                   @mouseenter="hoveredCard = {{ $event->id }}"
                   @mouseleave="hoveredCard = null">
            
            <a href="{{ route('client.events.show', $event) }}" 
               class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-fuchsia-500 focus-visible:ring-offset-2 rounded-3xl">
              
              <!-- Image Container with Overlay Effects -->
              <div class="relative aspect-[16/9] overflow-hidden bg-gradient-to-br from-violet-100 to-fuchsia-100 dark:from-neutral-800 dark:to-neutral-700">
                @php $img = $event->image ? asset('storage/'.$event->image) : 'https://picsum.photos/seed/event-'.$event->id.'/640/360'; @endphp
                <img src="{{ $img }}" 
                     alt="{{ $event->title }}" 
                     class="h-full w-full object-cover transition-all duration-700 ease-out group-hover:scale-110 group-hover:rotate-1" 
                     loading="lazy" />
                     
                <!-- Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-500"></div>
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-500/10 to-violet-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <!-- Floating Tags -->
                <div class="absolute left-3 top-3 flex flex-col gap-2">
                  <span class="inline-flex items-center rounded-full bg-white/95 backdrop-blur px-3 py-1.5 text-xs font-semibold text-fuchsia-700 ring-1 ring-fuchsia-200 shadow-lg pulse-cute">
                    🎯 {{ $event->type }}
                  </span>
                  <span class="inline-flex items-center rounded-full bg-gradient-to-r from-violet-500 to-fuchsia-500 px-3 py-1.5 text-xs font-bold text-white shadow-lg {{ $isUpcoming ? 'glow-cute' : '' }}">
                    {{ $isUpcoming ? '🚀 Upcoming' : '📅 Past' }}
                  </span>
                </div>
                
                <!-- Date Badge -->
                <div class="absolute right-3 top-3">
                  <div class="rounded-2xl bg-white/95 backdrop-blur p-3 shadow-lg ring-1 ring-violet-200 text-center float-cute">
                    <p class="text-xs font-medium text-violet-600">{{ optional($event->scheduled_at)->format('M') }}</p>
                    <p class="text-lg font-bold text-neutral-900">{{ optional($event->scheduled_at)->format('d') }}</p>
                  </div>
                </div>
                
                <!-- Heart Button -->
                <button class="absolute right-3 bottom-3 p-2 rounded-full bg-white/90 backdrop-blur shadow-lg transition-all duration-300 hover:scale-110 hover:bg-white" 
                        @click.prevent="isLiked = !isLiked"
                        :class="isLiked ? 'text-red-500' : 'text-neutral-400'">
                  <svg class="w-5 h-5 transition-all duration-300" :class="isLiked ? 'scale-110' : ''" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                  </svg>
                </button>
              </div>
              
              <!-- Content Area -->
              <div class="p-6 space-y-4">
                <!-- Title and Price -->
                <div class="flex items-start justify-between gap-3">
                  <h3 class="text-lg font-bold text-neutral-900 dark:text-neutral-100 line-clamp-2 group-hover:text-fuchsia-600 transition-colors duration-300">
                    {{ $event->title }}
                  </h3>
                  <div class="text-right shrink-0">
                    <p class="text-xs text-neutral-500">Starting from</p>
                    <p class="text-lg font-bold text-emerald-600">Free</p>
                  </div>
                </div>
                
                <!-- Date and Time -->
                <div class="flex items-center gap-2 text-neutral-700 dark:text-neutral-300">
                  <div class="p-1.5 rounded-lg bg-violet-100 dark:bg-neutral-800">
                    <svg class="w-4 h-4 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <span class="text-sm font-medium">{{ optional($event->scheduled_at)->format('M d, Y • h:i A') }}</span>
                </div>
                
                <!-- Location -->
                <div class="flex items-center gap-2 text-neutral-700 dark:text-neutral-300">
                  <div class="p-1.5 rounded-lg bg-rose-100 dark:bg-neutral-800">
                    <svg class="w-4 h-4 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <span class="line-clamp-1">{{ $event->venue?->name }} {{ $event->venue?->address ? '• ' . $event->venue->address : '' }}</span>
                </div>
                
                <!-- Stats and CTA -->
                <div class="flex items-center justify-between pt-4 border-t border-violet-100 dark:border-neutral-800">
                  <div class="flex items-center gap-4 text-xs text-neutral-500">
                    <span class="flex items-center gap-1">
                      <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                      {{ $event->attendees_count ?? 0 }} attending
                    </span>
                    <span class="text-neutral-400">•</span>
                    <span>ID #{{ $event->id }}</span>
                  </div>
                  
                  <!-- CTA Button -->
                  <div class="flex items-center text-fuchsia-600 font-semibold text-sm group-hover:text-fuchsia-700 transition-colors duration-300">
                    <span class="mr-1">View Details</span>
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                </div>
              </div>
            </a>
          </article>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="mt-12 slide-up-cute">
        {{ $events->links() }}
      </div>
    @else
      <!-- Empty State with Cute Illustration -->
      <div class="rounded-3xl border-2 border-dashed border-violet-200 dark:border-neutral-700 p-12 text-center slide-up-cute">
        <div class="mx-auto w-24 h-24 mb-6">
          <div class="w-full h-full rounded-full bg-gradient-to-br from-violet-100 to-fuchsia-100 dark:from-neutral-800 dark:to-neutral-700 flex items-center justify-center float-cute">
            <span class="text-4xl">🔍</span>
          </div>
        </div>
        <h3 class="text-xl font-bold text-neutral-900 dark:text-neutral-100 mb-2">No events found! 😔</h3>
        <p class="text-neutral-600 dark:text-neutral-400 mb-6">We couldn't find any events matching your criteria.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="{{ route('client.events.index') }}" 
             class="inline-flex items-center px-6 py-3 rounded-xl bg-gradient-to-r from-fuchsia-500 to-violet-500 text-white font-semibold hover:from-fuchsia-600 hover:to-violet-600 transition-all duration-300 hover:scale-105 shadow-lg">
            <span class="mr-2">🏠</span> View All Events
          </a>
          <button onclick="history.back()" 
                  class="inline-flex items-center px-6 py-3 rounded-xl border border-violet-200 dark:border-neutral-700 text-violet-700 dark:text-violet-400 font-semibold hover:bg-violet-50 dark:hover:bg-neutral-800 transition-all duration-300">
            <span class="mr-2">↩️</span> Go Back
          </button>
        </div>
      </div>
    @endif
  </section>
@endsection
