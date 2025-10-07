<x-layouts.admin>
    <form action="{{route('logout')}}" method="post">
        <button type="submit" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            Logout
        </button>
    </form>

</x-layouts.admin>
