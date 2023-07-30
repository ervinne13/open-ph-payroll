<div>
    <input wire:model="search_term" class="input input-bordered mb-2" placeholder="Filter employee ..." />

    <ul>
        @foreach ($employees as $emp)
            <li wire:click="setSelectedEmployee({{ $emp['id'] }})">
                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <div class="avatar online">
                            <div class="w-16 rounded-full">
                                <img src="{{ $emp['image_url'] }}" />
                            </div>
                        </div>
                    </div>
                    <div class="stat-title">
                        {{ $emp['display_name'] }}
                    </div>
                    <div class="stat-desc text-accent">
                        {{ $emp['position'] }}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    {{ $search_term }}
</div>
