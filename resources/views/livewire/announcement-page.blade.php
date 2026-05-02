<div class="py-10 my-10 flex flex-1 flex-col overflow-hidden">

    <div class="py-6 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight dark:text-white">
                Announcements
            </h2>
        </div>
    </div>

    @if ($announcements->isEmpty())
        <p class="text-sm text-gray-500 dark:text-gray-400">No announcements at this time.</p>
    @else
        <ul role="list" class="divide-y divide-gray-100 dark:divide-white/5">
            @foreach ($announcements as $announcement)
                <li wire:key="announcement-{{ $announcement->id }}" class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 py-5 sm:flex-nowrap">
                    <div>
                        <p class="text-sm/6 font-semibold text-gray-900 dark:text-white">
                            {{ $announcement->title }}
                        </p>
                        <div class="mt-2 text-sm text-gray-700 dark:text-gray-300 prose prose-sm dark:prose-invert max-w-none">
                            {!! $announcement->body !!}
                        </div>
                        <div class="mt-2 flex items-center gap-x-2 text-xs/5 text-gray-500 dark:text-gray-400">
                            <p>
                                <time datetime="{{ $announcement->created_at->toIso8601String() }}">
                                    {{ $announcement->created_at->diffForHumans() }}
                                </time>
                            </p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
