<x-layouts.admin>
    <!-- Table Section -->
    <div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-7 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700"
                    >
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700"
                        >
                            <!-- Input -->
                            <div class="sm:col-span-1">
                                <label
                                    for="hs-as-table-product-review-search"
                                    class="sr-only"
                                >Search</label
                                >
                                <div class="relative">
                                    <input
                                        type="text"
                                        id="hs-as-table-product-review-search"
                                        name="hs-as-table-product-review-search"
                                        class="py-2 px-3 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Search"
                                    />
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4"
                                    >
                                        <svg
                                            class="shrink-0 size-4 text-gray-400 dark:text-neutral-500"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <circle cx="11" cy="11" r="8" />
                                            <path d="m21 21-4.3-4.3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- End Input -->

                            <div class="sm:col-span-2 md:grow">
                                <div class="flex justify-end gap-x-2">
                                    <a href="{{route('events.create')}}"

                                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"

                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>

                                        Add New
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table
                            class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700"
                        >
                            <thead class="bg-gray-50 dark:bg-neutral-800">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start"
                                >
                                    <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200"
                                            >
                                                Event Name
                                            </span>
                                    </div>
                                </th>

                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start"
                                >
                                    <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200"
                                            >
                                                Description
                                            </span>
                                    </div>
                                </th>



                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start"
                                >
                                    <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200"
                                            >
                                                Date
                                            </span>
                                    </div>
                                </th>

                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start"
                                >
                                    <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200"
                                            >
                                                Status
                                            </span>
                                    </div>
                                </th>
                            </tr>
                            </thead>

                            <tbody
                                class="divide-y divide-gray-200 dark:divide-neutral-700"
                            >
                            @foreach($events as $event)
                                <tr
                                    class="bg-white hover:bg-gray-50 dark:bg-neutral-900 dark:hover:bg-neutral-800"
                                >
                                    <td
                                        class="size-px whitespace-nowrap align-top"
                                    >
                                        <a class="block p-6" href="#">
                                            <div
                                                class="flex items-center gap-x-4"
                                            >
                                                @if($event->image)
                                                    <img
                                                        class="shrink-0 size-9.5 rounded-lg"
                                                        src="{{asset('storage/'.$event->image)}}"
                                                        alt="Product Image"
                                                    />
                                                @else
                                                    <img
                                                        class="shrink-0 size-9.5 rounded-lg"
                                                        src="https://images.unsplash.com/photo-1572307480813-ceb0e59d8325?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&h=320&q=80"
                                                        alt="Product Image"
                                                    />
                                                @endif

                                                <div>
                                                        <span
                                                            class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"
                                                        >{{$event->title}}</span
                                                        >
                                                </div>
                                            </div>
                                        </a>
                                    </td>

                                    <td class="h-px w-72 min-w-72 align-top">
                                        <a class="block p-6" href="#">



                                            <span
                                                class="block text-sm text-gray-500 dark:text-neutral-500"
                                            >
                                                {{$event->description}}
                                            </span
                                            >
                                        </a>
                                    </td>
                                    <td
                                        class="size-px whitespace-nowrap align-top"
                                    >
                                        <a class="block p-6" href="#">
                                                <span
                                                    class="text-sm text-gray-600 dark:text-neutral-400"
                                                >{{$event->start_date->format('M-d-Y')}} -{{$event->end_date->format('M-d-Y')}} </span
                                                >
                                        </a>
                                    </td>
                                    <td
                                        class="size-px whitespace-nowrap align-top"
                                    >
                                        <a class="block p-6" href="#">
                                                <span
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium {{$event->status =='active' ? 'bg-teal-100 text-teal-800' : 'bg-red-100 text-red-800'}} rounded-full dark:bg-teal-500/10 dark:text-teal-500"
                                                >
                                                    <svg
                                                        class="size-2.5"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                                                        />
                                                    </svg>
                                                    {{ucfirst($event->status)}}
                                                </span>
                                        </a>
                                    </td>
                                    <td  class="size-px whitespace-nowrap align-top">
                                        <!-- More Dropdown -->
                                        <div class="hs-dropdown [--strategy:absolute] mt-5  relative inline-flex">
                                            <button id="hs-pro-ainmd" type="button" class="flex justify-center items-center gap-x-3 size-9 text-sm text-gray-600 hover:bg-gray-100 rounded-lg disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:hover:text-neutral-200 dark:focus:text-neutral-200">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
                                            </button>

                                            <!-- More Dropdown -->
                                            <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-32 transition-[opacity,margin] duration opacity-0 hidden z-11 bg-white border border-gray-200 rounded-xl shadow-lg before:absolute before:-top-4 before:start-0 before:w-full before:h-5 dark:bg-neutral-950 dark:border-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-pro-ainmd">
                                                <div class="p-1 space-y-0.5">

                                                    <a href="{{route('events.edit',$event)}}" class="w-full flex items-center gap-x-3 py-1.5 px-2 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                                        Edit
                                                    </a>
                                                    <a href="{{route('events.show',$event)}}" class="w-full flex items-center gap-x-3 py-1.5 px-2 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>

                                                        Show
                                                    </a>
                                                    <form action="{{route('events.destroy',$event)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-full flex items-center gap-x-3 py-1.5 px-2 rounded-lg text-sm text-red-600 hover:bg-red-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-red-50 dark:text-red-500 dark:hover:bg-red-500/20 dark:focus:bg-red-500/20">
                                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                            <!-- End More Dropdown -->
                                        </div>
                                        <!-- End More Dropdown -->

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div
                            class="px-6 py-4  border-t border-gray-200 dark:border-neutral-700"
                        >
                           {{$events->links()}}
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Table Section -->
</x-layouts.admin>
