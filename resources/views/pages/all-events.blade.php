<x-layouts.app>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Grid -->
        <div class="grid lg:grid-cols-2 lg:gap-y-16 gap-10">
          @foreach($allEvents as $event)
              <x-events-card :event="$event"/>
          @endforeach
        </div>
        <!-- End Grid -->
        <div class="mt-5" >
            {{$allEvents->links()}}
        </div>
    </div>
    <!-- End Card Blog -->
</x-layouts.app>
