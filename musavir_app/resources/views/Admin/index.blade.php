<x-admin-layout>
 <!-- Page Heading -->
 @if (isset($header))
 <header class="bg-white shadow">
     <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
         {{ $header }}
     </div>
 </header>
@endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
