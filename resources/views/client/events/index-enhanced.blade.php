@extends('layouts.client-enhanced')

@section('content')
  <!-- Hero Section with Dynamic Theme Animations -->
  <section :class="`relative overflow-hidden rounded-3xl border p-6 sm:p-10 shadow-2xl theme-transition ${
    theme === 'aurora' 
      ? 'border-indigo-200 bg-white/80 backdrop-blur-xl' 
      : 'border-purple-500/30 bg-gray-900/80 backdrop-blur-xl'
  }`" 
           x-data="{ showFilters: false, isSearching: false }"
           data-lazy>
    
    <!-- Dynamic Animated Background Blobs -->
    <template x-if="theme === 'aurora'">
        <div>
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-gradient-to-br from-indigo-300 to-purple-400 opacity-30 blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-gradient-to-tr from-pink-300 to-rose-400 opacity-30 blur-3xl animate-pulse" style="animation-delay: 1.5s"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-gradient-to-r from-purple-200 to-indigo-200 opacity-20 blur-3xl animate-pulse" style="animation-delay: 0.8s"></div>
        </div>
    </template>
    
    <template x-if="theme === 'cosmic'">
        <div>
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-gradient-to-br from-cyan-400/30 to-purple-500/30 opacity-50 blur-3xl animate-ping"></div>
            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-gradient-to-tr from-pink-400/30 to-green-400/30 opacity-50 blur-3xl animate-ping" style="animation-delay: 1.5s"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-gradient-to-r from-blue-400/20 to-violet-400/20 opacity-40 blur-3xl animate-ping" style="animation-delay: 0.8s"></div>
        </div>
    </template>

    <div class="relative z-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
      <div class="max-w-3xl animate-fade-in">
        <!-- Dynamic Title with Theme-specific Styling -->
        <div class="flex items-center gap-3 mb-2">
          <span class="text-4xl animate-bounce">🎉</span>
          <h1 :class="`text-3xl sm:text-4xl font-bold tracking-tight bg-clip-text text-transparent theme-transition ${
            theme === 'aurora' 
              ? 'bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600' 
              : 'bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400'
          }`">
            Discover Amazing Events
          </h1>
          <span class="text-3xl animate-bounce" style="animation-delay: 0.5s">✨</span>
        </div>
        <p :class="`mt-2 text-lg theme-transition ${
          theme === 'aurora' ? 'text-gray-600' : 'text-gray-300'
        }`">
          Find the perfect event by type, date, organizer, or venue. Let's make memories! 
          <span x-show="theme === 'aurora'">💫</span>
          <span x-show="theme === 'cosmic'">🌟</span>
        </p>

        <!-- Status Filter Pills -->
        <div :class="`mt-4 inline-flex rounded-full border p-1 text-sm theme-transition ${
          theme === 'aurora' 
            ? 'border-indigo-200 bg-indigo-50/80' 
            : 'border-purple-500/30 bg-gray-800/50'
        }`">
          @php $s = request('status','all'); @endphp
          <a href="{{ route('client.events.index', array_merge(request()->except('page'), ['status' => 'all'])) }}" 
             :class="`px-3 py-1.5 rounded-full transition-all duration-300 ${
               '{{ $s }}' === 'all' 
                 ? (theme === 'aurora' 
                   ? 'bg-white text-gray-900 shadow-sm' 
                   : 'bg-gray-700 text-white shadow-sm') 
                 : (theme === 'aurora' 
                   ? 'text-gray-600 hover:text-gray-900 hover:bg-white/50' 
                   : 'text-gray-300 hover:text-white hover:bg-gray-700/50')
             }`">
            All <span class="opacity-60">({{ $counts['all'] ?? $events->total() }})</span>
          </a>
          <a href="{{ route('client.events.index', array_merge(request()->except('page'), ['status' => 'upcoming'])) }}" 
             :class="`px-3 py-1.5 rounded-full transition-all duration-300 ${
               '{{ $s }}' === 'upcoming' 
                 ? (theme === 'aurora' 
                   ? 'bg-white text-gray-900 shadow-sm' 
                   : 'bg-gray-700 text-white shadow-sm') 
                 : (theme === 'aurora' 
                   ? 'text-gray-600 hover:text-gray-900 hover:bg-white/50' 
                   : 'text-gray-300 hover:text-white hover:bg-gray-700/50')
             }`">
            Upcoming <span class="opacity-60">({{ $counts['upcoming'] ?? '' }})</span>
          </a>
          <a href="{{ route('client.events.index', array_merge(request()->except('page'), ['status' => 'past'])) }}" 
             :class="`px-3 py-1.5 rounded-full transition-all duration-300 ${
               '{{ $s }}' === 'past' 
                 ? (theme === 'aurora' 
                   ? 'bg-white text-gray-900 shadow-sm' 
                   : 'bg-gray-700 text-white shadow-sm') 
                 : (theme === 'aurora' 
                   ? 'text-gray-600 hover:text-gray-900 hover:bg-white/50' 
                   : 'text-gray-300 hover:text-white hover:bg-gray-700/50')
             }`">
            Past <span class="opacity-60">({{ $counts['past'] ?? '' }})</span>
          </a>
        </div>

        <!-- Enhanced Search Bar -->
        <div class="mt-6 relative max-w-2xl">
          <span :class="`pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-xl ${
            theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'
          }`">🔎</span>
          <input form="filters" 
                 x-model="q" 
                 id="q" 
                 name="q" 
                 type="text" 
                 value="{{ request('q') }}" 
                 placeholder="Search events by title, organizer, or venue..." 
                 :class="`pl-12 pr-32 py-4 w-full rounded-2xl border-2 focus:ring-4 focus:ring-opacity-20 transition-all duration-300 ${
                   theme === 'aurora' 
                     ? 'border-indigo-200 bg-white focus:border-indigo-500 focus:ring-indigo-500 text-gray-900 placeholder-gray-500' 
                     : 'border-purple-500/30 bg-gray-800/50 focus:border-purple-400 focus:ring-purple-400 text-white placeholder-gray-400'
                 }`" />
          <button type="button" 
                  x-show="q" 
                  x-on:click="q=''; $nextTick(()=>{document.getElementById('q').value='';})" 
                  :class="`absolute right-32 top-1/2 -translate-y-1/2 inline-flex h-8 w-8 items-center justify-center rounded-full border transition-all duration-300 hover:scale-110 ${
                    theme === 'aurora' 
                      ? 'border-gray-300 bg-white text-gray-400 hover:text-gray-700 hover:bg-gray-50' 
                      : 'border-gray-600 bg-gray-700 text-gray-400 hover:text-gray-200 hover:bg-gray-600'
                  }`" 
                  aria-label="Clear search">✕</button>
          <button form="filters" 
                  type="submit" 
                  :class="`absolute right-2 top-1/2 -translate-y-1/2 inline-flex items-center rounded-xl px-6 py-3 text-sm font-bold text-white shadow-lg transition-all duration-300 hover:scale-105 ${
                    theme === 'aurora' 
                      ? 'bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700' 
                      : 'bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-600 hover:to-purple-700'
                  }`">
            Search
          </button>
        </div>

        <!-- Popular Tags -->
        @if(!empty($popularTypes) && count($popularTypes))
          <div class="mt-3 flex flex-wrap items-center gap-2 text-xs">
            <span :class="`${theme === 'aurora' ? 'text-gray-500' : 'text-gray-400'}`">Popular:</span>
            @foreach($popularTypes as $t)
              <a href="{{ route('client.events.index', array_merge(request()->except('page'), ['type' => $t])) }}" 
                 :class="`inline-flex items-center rounded-full border px-3 py-1.5 transition-all duration-300 hover:scale-105 ${
                   theme === 'aurora' 
                     ? 'border-indigo-200 bg-white text-gray-700 hover:bg-indigo-50 hover:border-indigo-300' 
                     : 'border-purple-500/30 bg-gray-800 text-gray-300 hover:bg-gray-700 hover:border-purple-400'
                 }`">{{ $t }}</a>
            @endforeach
          </div>
        @endif
      </div>
    </div>

    <!-- Enhanced Filter Form -->
    <form id="filters" 
          x-data="{ q: @js(request('q')), venue: @js(request('venue')), organizer: @js(request('organizer')) }" 
          method="GET" 
          action="{{ route('client.events.index') }}" 
          class="relative z-10 mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-12">
      <input type="hidden" name="status" value="{{ request('status','all') }}" />

      <!-- Type Filter -->
      <div class="lg:col-span-2">
        <label :class="`block text-sm font-semibold mb-2 ${
          theme === 'aurora' ? 'text-gray-700' : 'text-gray-300'
        }`" for="type">Type</label>
        <div class="relative group">
          <span :class="`pointer-events-none absolute inset-y-0 left-3 inline-flex items-center ${
            theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'
          }`">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z"/>
            </svg>
          </span>
          <select id="type" 
                  name="type" 
                  :class="`appearance-none pl-10 pr-10 py-3 w-full rounded-xl border-2 focus:ring-4 focus:ring-opacity-20 transition-all duration-300 ${
                    theme === 'aurora' 
                      ? 'border-indigo-200 bg-white focus:border-indigo-500 focus:ring-indigo-500 text-gray-900' 
                      : 'border-purple-500/30 bg-gray-800 focus:border-purple-400 focus:ring-purple-400 text-white'
                  }`">
            <option value="">All types</option>
            @foreach($types as $t)
              <option value="{{ $t }}" @selected(request('type') === $t)>{{ $t }}</option>
            @endforeach
          </select>
          <span :class="`pointer-events-none absolute inset-y-0 right-3 inline-flex items-center ${
            theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'
          }`">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 10l5 5 5-5H7z"/>
            </svg>
          </span>
        </div>
      </div>

      <!-- Date Filters -->
      <div class="lg:col-span-2">
        <label :class="`block text-sm font-semibold mb-2 ${
          theme === 'aurora' ? 'text-gray-700' : 'text-gray-300'
        }`" for="start_date">From</label>
        <div class="relative">
          <span :class="`pointer-events-none absolute inset-y-0 left-3 inline-flex items-center ${
            theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'
          }`">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 2a1 1 0 011 1v1h8V3a1 1 0 112 0v1h1a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h1V3a1 1 0 112 0v1zm13 6H4v10h16V8z"/>
            </svg>
          </span>
          <input id="start_date" 
                 name="start_date" 
                 type="date" 
                 value="{{ request('start_date') }}" 
                 :class="`appearance-none pl-10 pr-3 py-3 w-full rounded-xl border-2 focus:ring-4 focus:ring-opacity-20 transition-all duration-300 ${
                   theme === 'aurora' 
                     ? 'border-indigo-200 bg-white focus:border-indigo-500 focus:ring-indigo-500 text-gray-900' 
                     : 'border-purple-500/30 bg-gray-800 focus:border-purple-400 focus:ring-purple-400 text-white'
                 }`" />
        </div>
      </div>

      <div class="lg:col-span-2">
        <label :class="`block text-sm font-semibold mb-2 ${
          theme === 'aurora' ? 'text-gray-700' : 'text-gray-300'
        }`" for="end_date">To</label>
        <div class="relative">
          <span :class="`pointer-events-none absolute inset-y-0 left-3 inline-flex items-center ${
            theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'
          }`">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 2a1 1 0 011 1v1h8V3a1 1 0 112 0v1h1a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h1V3a1 1 0 112 0v1zm13 6H4v10h16V8z"/>
            </svg>
          </span>
          <input id="end_date" 
                 name="end_date" 
                 type="date" 
                 value="{{ request('end_date') }}" 
                 :class="`appearance-none pl-10 pr-3 py-3 w-full rounded-xl border-2 focus:ring-4 focus:ring-opacity-20 transition-all duration-300 ${
                   theme === 'aurora' 
                     ? 'border-indigo-200 bg-white focus:border-indigo-500 focus:ring-indigo-500 text-gray-900' 
                     : 'border-purple-500/30 bg-gray-800 focus:border-purple-400 focus:ring-purple-400 text-white'
                 }`" />
        </div>
      </div>

      <!-- Sort Filter -->
      <div class="lg:col-span-1">
        <label :class="`block text-sm font-semibold mb-2 ${
          theme === 'aurora' ? 'text-gray-700' : 'text-gray-300'
        }`" for="sort">Sort</label>
        <div class="relative">
          <span :class="`pointer-events-none absolute inset-y-0 left-3 inline-flex items-center ${
            theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'
          }`">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M6 7h12v2H6V7zm0 4h8v2H6v-2zm0 4h4v2H6v-2z"/>
            </svg>
          </span>
          <select id="sort" 
                  name="sort" 
                  :class="`appearance-none pl-10 pr-10 py-3 w-full rounded-xl border-2 focus:ring-4 focus:ring-opacity-20 transition-all duration-300 ${
                    theme === 'aurora' 
                      ? 'border-indigo-200 bg-white focus:border-indigo-500 focus:ring-indigo-500 text-gray-900' 
                      : 'border-purple-500/30 bg-gray-800 focus:border-purple-400 focus:ring-purple-400 text-white'
                  }`">
            <option value="date_asc" @selected(request('sort','date_asc')==='date_asc')>Date ↑</option>
            <option value="date_desc" @selected(request('sort')==='date_desc')>Date ↓</option>
            <option value="title_asc" @selected(request('sort')==='title_asc')>Title A→Z</option>
            <option value="title_desc" @selected(request('sort')==='title_desc')>Title Z→A</option>
          </select>
          <span :class="`pointer-events-none absolute inset-y-0 right-3 inline-flex items-center ${
            theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'
          }`">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 10l5 5 5-5H7z"/>
            </svg>
          </span>
        </div>
      </div>

      <!-- Venue and Organizer Filters -->
      <div class="lg:col-span-12 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-6">
        <div class="lg:col-span-3">
          <label :class="`block text-sm font-semibold mb-2 ${
            theme === 'aurora' ? 'text-gray-700' : 'text-gray-300'
          }`" for="venue">Venue contains</label>
          <div class="relative">
            <span :class="`pointer-events-none absolute inset-y-0 left-3 inline-flex items-center ${
              theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'
            }`">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/>
              </svg>
            </span>
            <input x-model="venue" 
                   id="venue" 
                   name="venue" 
                   type="text" 
                   value="{{ request('venue') }}" 
                   placeholder="Venue name or address" 
                   :class="`appearance-none pl-10 pr-12 py-3 w-full rounded-xl border-2 focus:ring-4 focus:ring-opacity-20 transition-all duration-300 ${
                     theme === 'aurora' 
                       ? 'border-indigo-200 bg-white focus:border-indigo-500 focus:ring-indigo-500 text-gray-900 placeholder-gray-500' 
                       : 'border-purple-500/30 bg-gray-800 focus:border-purple-400 focus:ring-purple-400 text-white placeholder-gray-400'
                   }`" />
            <button type="button" 
                    x-show="venue" 
                    x-on:click="venue=''; $nextTick(()=>{document.getElementById('venue').value='';})" 
                    :class="`absolute right-3 top-1/2 -translate-y-1/2 inline-flex h-8 w-8 items-center justify-center rounded-full border transition-all duration-300 hover:scale-110 ${
                      theme === 'aurora' 
                        ? 'border-gray-300 bg-white text-gray-400 hover:text-gray-700 hover:bg-gray-50' 
                        : 'border-gray-600 bg-gray-700 text-gray-400 hover:text-gray-200 hover:bg-gray-600'
                    }`" 
                    aria-label="Clear venue">✕</button>
          </div>
        </div>

        <div class="lg:col-span-3">
          <label :class="`block text-sm font-semibold mb-2 ${
            theme === 'aurora' ? 'text-gray-700' : 'text-gray-300'
          }`" for="organizer">Organizer contains</label>
          <div class="relative">
            <span :class="`pointer-events-none absolute inset-y-0 left-3 inline-flex items-center ${
              theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'
            }`">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4 0-7 2-7 4.5V21h14v-2.5c0-2.5-3-4.5-7-4.5z"/>
              </svg>
            </span>
            <input x-model="organizer" 
                   id="organizer" 
                   name="organizer" 
                   type="text" 
                   value="{{ request('organizer') }}" 
                   placeholder="Organizer name" 
                   :class="`appearance-none pl-10 pr-12 py-3 w-full rounded-xl border-2 focus:ring-4 focus:ring-opacity-20 transition-all duration-300 ${
                     theme === 'aurora' 
                       ? 'border-indigo-200 bg-white focus:border-indigo-500 focus:ring-indigo-500 text-gray-900 placeholder-gray-500' 
                       : 'border-purple-500/30 bg-gray-800 focus:border-purple-400 focus:ring-purple-400 text-white placeholder-gray-400'
                   }`" />
            <button type="button" 
                    x-show="organizer" 
                    x-on:click="organizer=''; $nextTick(()=>{document.getElementById('organizer').value='';})" 
                    :class="`absolute right-3 top-1/2 -translate-y-1/2 inline-flex h-8 w-8 items-center justify-center rounded-full border transition-all duration-300 hover:scale-110 ${
                      theme === 'aurora' 
                        ? 'border-gray-300 bg-white text-gray-400 hover:text-gray-700 hover:bg-gray-50' 
                        : 'border-gray-600 bg-gray-700 text-gray-400 hover:text-gray-200 hover:bg-gray-600'
                    }`" 
                    aria-label="Clear organizer">✕</button>
          </div>
        </div>
      </div>

      <!-- Filter Actions -->
      <div class="lg:col-span-12 flex flex-wrap items-center gap-4 pt-4">
        <button type="submit" 
                :class="`inline-flex items-center rounded-xl px-8 py-3 font-bold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl ${
                  theme === 'aurora' 
                    ? 'bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700' 
                    : 'bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-600 hover:to-purple-700'
                }`">
          Apply filters
        </button>
        @php $hasFilters = collect(['q','type','start_date','end_date','venue','organizer'])->some(fn($k)=>filled(request($k))); @endphp
        @if($hasFilters)
          <a href="{{ route('client.events.index', ['status'=>request('status','all')]) }}" 
             :class="`text-sm font-medium transition-colors ${
               theme === 'aurora' ? 'text-gray-600 hover:text-gray-900' : 'text-gray-400 hover:text-white'
             }`">
            Reset
          </a>
        @endif

        <!-- Active Filters Display -->
        <div class="flex flex-wrap gap-2">
          @foreach(['q'=>'Search','type'=>'Type','start_date'=>'From','end_date'=>'To','venue'=>'Venue','organizer'=>'Organizer'] as $k=>$label)
            @if(filled(request($k)))
              <a href="{{ route('client.events.index', array_merge(request()->except($k,'page'), ['status'=>request('status','all')])) }}" 
                 :class="`inline-flex items-center gap-2 rounded-full border px-4 py-2 text-sm transition-all duration-300 hover:scale-105 ${
                   theme === 'aurora' 
                     ? 'border-indigo-200 bg-white text-gray-700 hover:bg-indigo-50 hover:border-indigo-300' 
                     : 'border-purple-500/30 bg-gray-800 text-gray-300 hover:bg-gray-700 hover:border-purple-400'
                 }`">
                <span class="font-medium">{{ $label }}:</span> 
                <span class="line-clamp-1 max-w-[12rem]">{{ request($k) }}</span>
                <span :class="theme === 'aurora' ? 'text-gray-400' : 'text-gray-500'">✕</span>
              </a>
            @endif
          @endforeach
        </div>
      </div>
    </form>
  </section>

  <!-- Events Grid with Theme-Adaptive Cards -->
  <section class="mt-12 animate-fade-in-up">
    <!-- Results Header -->
    <div class="mb-8 flex items-center justify-between animate-slide-in">
      <div class="flex items-center gap-4">
        <span class="text-3xl animate-bounce">📊</span>
        <div>
          <p :class="`text-sm ${theme === 'aurora' ? 'text-gray-600' : 'text-gray-400'}`">
            Showing <span :class="`font-bold text-lg animate-pulse ${
              theme === 'aurora' ? 'text-indigo-600' : 'text-cyan-400'
            }`">{{ $events->total() }}</span> 
            amazing event{{ $events->total() === 1 ? '' : 's' }}
          </p>
          <p :class="`text-xs ${theme === 'aurora' ? 'text-gray-500' : 'text-gray-500'}`">
            <span x-show="theme === 'aurora'">✨ Ready to explore? Let's go!</span>
            <span x-show="theme === 'cosmic'">🚀 Blast off to amazing events!</span>
          </p>
        </div>
      </div>
      
      <!-- View Toggle Button -->
      <div class="flex items-center gap-2">
        <button :class="`p-3 rounded-xl border transition-all duration-300 hover:scale-110 ${
          theme === 'aurora' 
            ? 'border-indigo-200 hover:bg-indigo-50 text-gray-600' 
            : 'border-purple-500/30 hover:bg-gray-800 text-gray-400'
        }`" 
                title="Grid View">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
          </svg>
        </button>
      </div>
    </div>

    @if($events->count())
      <!-- Dynamic Event Cards Grid -->
      <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 xl:grid-cols-3" 
           x-data="{ hoveredCard: null }">
        @foreach($events as $event)
          @php $isUpcoming = optional($event->scheduled_at)->isFuture(); @endphp
          <article :class="`group relative overflow-hidden rounded-3xl border shadow-2xl transition-all duration-500 ease-out hover:scale-105 hover:-translate-y-2 animate-fade-in-up ${
                     theme === 'aurora' 
                       ? 'border-indigo-200 bg-white hover:shadow-indigo-200/50' 
                       : 'border-purple-500/30 bg-gray-900/90 hover:shadow-purple-500/20'
                   }`" 
                   x-data="{ isLiked: false }"
                   @mouseenter="hoveredCard = {{ $event->id }}"
                   @mouseleave="hoveredCard = null"
                   style="animation-delay: {{ ($loop->index % 6) * 100 }}ms">
            
            <a href="{{ route('client.events.show', $event) }}" 
               class="block focus:outline-none focus-visible:ring-4 focus-visible:ring-opacity-50 focus-visible:ring-offset-2 rounded-3xl"
               :class="theme === 'aurora' ? 'focus-visible:ring-indigo-500' : 'focus-visible:ring-purple-500'">
              
              <!-- Enhanced Image Container -->
              <div :class="`relative aspect-[16/9] overflow-hidden ${
                theme === 'aurora' 
                  ? 'bg-gradient-to-br from-indigo-100 to-purple-100' 
                  : 'bg-gradient-to-br from-gray-800 to-purple-900'
              }`">
                @php $img = $event->image ? asset('storage/'.$event->image) : 'https://picsum.photos/seed/event-'.$event->id.'/640/360'; @endphp
                <img src="{{ $img }}" 
                     alt="{{ $event->title }}" 
                     class="h-full w-full object-cover transition-all duration-700 ease-out group-hover:scale-110 group-hover:rotate-1" 
                     loading="lazy" />
                     
                <!-- Dynamic Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-500"></div>
                <div :class="`absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ${
                  theme === 'aurora' 
                    ? 'bg-gradient-to-br from-indigo-500/10 to-purple-500/10' 
                    : 'bg-gradient-to-br from-cyan-500/10 to-pink-500/10'
                }`"></div>
                
                <!-- Floating Tags -->
                <div class="absolute left-4 top-4 flex flex-col gap-2">
                  <span :class="`inline-flex items-center rounded-full px-3 py-1.5 text-xs font-bold shadow-lg animate-pulse backdrop-blur ${
                    theme === 'aurora' 
                      ? 'bg-white/95 text-indigo-700 ring-1 ring-indigo-200' 
                      : 'bg-gray-900/95 text-cyan-400 ring-1 ring-cyan-400/30'
                  }`">
                    🎯 {{ $event->type }}
                  </span>
                  <span :class="`inline-flex items-center rounded-full px-3 py-1.5 text-xs font-bold text-white shadow-lg ${
                    $isUpcoming 
                      ? (theme === 'aurora' 
                        ? 'bg-gradient-to-r from-green-500 to-emerald-500 animate-pulse' 
                        : 'bg-gradient-to-r from-cyan-500 to-blue-500 animate-pulse')
                      : 'bg-gradient-to-r from-gray-500 to-gray-600'
                  }`">
                    {{ $isUpcoming ? '🚀 Upcoming' : '📅 Past' }}
                  </span>
                </div>
                
                <!-- Enhanced Date Badge -->
                <div class="absolute right-4 top-4">
                  <div :class="`rounded-2xl p-3 shadow-lg text-center animate-float backdrop-blur ${
                    theme === 'aurora' 
                      ? 'bg-white/95 ring-1 ring-indigo-200' 
                      : 'bg-gray-900/95 ring-1 ring-purple-400/30'
                  }`">
                    <p :class="`text-xs font-semibold ${
                      theme === 'aurora' ? 'text-indigo-600' : 'text-purple-400'
                    }`">{{ optional($event->scheduled_at)->format('M') }}</p>
                    <p :class="`text-lg font-bold ${
                      theme === 'aurora' ? 'text-gray-900' : 'text-white'
                    }`">{{ optional($event->scheduled_at)->format('d') }}</p>
                  </div>
                </div>
                
                <!-- Enhanced Heart Button -->
                <button :class="`absolute right-4 bottom-4 p-3 rounded-full shadow-lg backdrop-blur transition-all duration-300 hover:scale-125 ${
                  isLiked 
                    ? 'bg-red-500 text-white' 
                    : (theme === 'aurora' 
                      ? 'bg-white/90 text-gray-400 hover:text-red-500' 
                      : 'bg-gray-800/90 text-gray-400 hover:text-red-400')
                }`" 
                        @click.prevent="isLiked = !isLiked">
                  <svg class="w-5 h-5 transition-all duration-300" :class="isLiked ? 'scale-125' : ''" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                  </svg>
                </button>
              </div>
              
              <!-- Enhanced Content Area -->
              <div class="p-6 space-y-4">
                <!-- Title and Price -->
                <div class="flex items-start justify-between gap-3">
                  <h3 :class="`text-lg font-bold line-clamp-2 transition-colors duration-300 ${
                    theme === 'aurora' 
                      ? 'text-gray-900 group-hover:text-indigo-600' 
                      : 'text-white group-hover:text-cyan-400'
                  }`">
                    {{ $event->title }}
                  </h3>
                  <div class="text-right shrink-0">
                    <p :class="`text-xs ${theme === 'aurora' ? 'text-gray-500' : 'text-gray-400'}`">Starting from</p>
                    <p :class="`text-lg font-bold ${theme === 'aurora' ? 'text-emerald-600' : 'text-emerald-400'}`">Free</p>
                  </div>
                </div>
                
                <!-- Date and Time -->
                <div class="flex items-center gap-3">
                  <div :class="`p-2 rounded-lg ${
                    theme === 'aurora' ? 'bg-indigo-100' : 'bg-gray-800'
                  }`">
                    <svg :class="`w-4 h-4 ${
                      theme === 'aurora' ? 'text-indigo-600' : 'text-purple-400'
                    }`" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <span :class="`text-sm font-medium ${
                    theme === 'aurora' ? 'text-gray-700' : 'text-gray-300'
                  }`">{{ optional($event->scheduled_at)->format('M d, Y • h:i A') }}</span>
                </div>
                
                <!-- Location -->
                <div class="flex items-center gap-3">
                  <div :class="`p-2 rounded-lg ${
                    theme === 'aurora' ? 'bg-rose-100' : 'bg-gray-800'
                  }`">
                    <svg :class="`w-4 h-4 ${
                      theme === 'aurora' ? 'text-rose-600' : 'text-pink-400'
                    }`" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <span :class="`line-clamp-1 text-sm ${
                    theme === 'aurora' ? 'text-gray-700' : 'text-gray-300'
                  }`">{{ $event->venue?->name }} {{ $event->venue?->address ? '• ' . $event->venue->address : '' }}</span>
                </div>
                
                <!-- Stats and CTA -->
                <div :class="`flex items-center justify-between pt-4 border-t ${
                  theme === 'aurora' ? 'border-indigo-100' : 'border-gray-700'
                }`">
                  <div :class="`flex items-center gap-4 text-xs ${
                    theme === 'aurora' ? 'text-gray-500' : 'text-gray-400'
                  }`">
                    <span class="flex items-center gap-1">
                      <span :class="`w-2 h-2 rounded-full animate-pulse ${
                        theme === 'aurora' ? 'bg-emerald-400' : 'bg-cyan-400'
                      }`"></span>
                      {{ $event->attendees_count ?? 0 }} attending
                    </span>
                    <span :class="theme === 'aurora' ? 'text-gray-400' : 'text-gray-600'">•</span>
                    <span>ID #{{ $event->id }}</span>
                  </div>
                  
                  <!-- CTA Button -->
                  <div :class="`flex items-center font-bold text-sm transition-colors duration-300 ${
                    theme === 'aurora' 
                      ? 'text-indigo-600 group-hover:text-indigo-700' 
                      : 'text-cyan-400 group-hover:text-cyan-300'
                  }`">
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
      <div class="mt-16 animate-fade-in-up">
        {{ $events->links() }}
      </div>
    @else
      <!-- Enhanced Empty State -->
      <div :class="`rounded-3xl border-2 border-dashed p-16 text-center animate-fade-in-up ${
        theme === 'aurora' 
          ? 'border-indigo-300 bg-indigo-50/50' 
          : 'border-purple-500/30 bg-gray-800/30'
      }`">
        <div class="mx-auto w-32 h-32 mb-8">
          <div :class="`w-full h-full rounded-full flex items-center justify-center animate-bounce ${
            theme === 'aurora' 
              ? 'bg-gradient-to-br from-indigo-100 to-purple-100' 
              : 'bg-gradient-to-br from-gray-800 to-purple-900'
          }`">
            <span class="text-6xl">🔍</span>
          </div>
        </div>
        <h3 :class="`text-2xl font-bold mb-4 ${
          theme === 'aurora' ? 'text-gray-900' : 'text-white'
        }`">No events found!</h3>
        <p :class="`mb-8 ${
          theme === 'aurora' ? 'text-gray-600' : 'text-gray-400'
        }`">We couldn't find any events matching your criteria.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="{{ route('client.events.index') }}" 
             :class="`inline-flex items-center px-8 py-4 rounded-xl font-bold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl ${
               theme === 'aurora' 
                 ? 'bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600' 
                 : 'bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-600 hover:to-purple-700'
             }`">
            <span class="mr-2 text-xl">🏠</span> View All Events
          </a>
          <button onclick="history.back()" 
                  :class="`inline-flex items-center px-8 py-4 rounded-xl border font-bold transition-all duration-300 hover:scale-105 ${
                    theme === 'aurora' 
                      ? 'border-indigo-200 text-indigo-700 hover:bg-indigo-50' 
                      : 'border-purple-500/30 text-purple-400 hover:bg-gray-800'
                  }`">
            <span class="mr-2 text-xl">↩️</span> Go Back
          </button>
        </div>
      </div>
    @endif
  </section>
@endsection
