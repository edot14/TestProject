<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>
    
    <div class="space-y-4">
        @forelse ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">                
                <div class="font-bold text-blue-500 text-sm"> {{ $job->employer->name }} </div>

                    <div>
                        <strong>{{ $job['title'] }}:</strong> Pays {{ $job['salary'] }} per year.
                    </div>
            </a>
            @empty
            <li>No jobs available.</li>
        @endforelse

        <div> 
            {{ $jobs->links() }}    
        </div>

    </div>
</x-layout>
