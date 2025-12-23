@php
    $user = $comment->user();
@endphp
<div class="p-8 border-b border-zinc-100 transition-colors duration-200 hover:bg-zinc-50 last:border-b-0">
    <div class="flex items-center gap-4 mb-4">
        @if($user && $user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full border-2 border-zinc-200 object-cover">
        @else
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold text-lg">
                {{ $user ? $user->getInitialsAttribute() : 'U' }}
            </div>
        @endif
        
        <div class="flex-1">
            <div class="flex items-center gap-2 mb-1">
                <span class="font-outfit font-semibold text-zinc-950">{{ $user ? $user->name : 'Anonymous User' }}</span>
                @if($user && $user->verified)
                    <span class="text-green-500 text-sm">✓</span>
                @endif
            </div>
            <div class="flex items-center gap-4 text-zinc-500 text-sm font-outfit font-medium">
                <div class="flex items-center gap-2 bg-zinc-100 py-1 px-3 rounded-md border border-zinc-200">
                    <div class="flex items-center gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $comment->rating)
                                <i data-lucide="star" class="w-3.5 h-3.5 text-amber-500 fill-amber-500"></i>
                            @else
                                <i data-lucide="star" class="w-3.5 h-3.5 text-gray-300"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="font-outfit text-sm text-zinc-600 font-semibold">{{ $comment->rating }}/5</span>
                </div>
                <span class="text-zinc-400">{{ $comment->getFormattedDateAttribute() }}</span>
                @if($user)
                    <span>{{ $user->total_reviews }} reviews</span>
                @endif
            </div>
        </div>
    </div>

    <div class="mb-4 font-outfit text-zinc-700 leading-relaxed">
        {{ $comment->comment }}
    </div>

    <div class="flex items-center gap-2 text-zinc-500 text-sm font-outfit font-medium">
        <i data-lucide="thumbs-up" class="w-4 h-4 text-green-500 transition-all duration-200"></i>
        <span>{{ $comment->helpful_votes }} found this helpful</span>
    </div>
</div>