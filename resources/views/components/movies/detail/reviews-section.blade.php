<section class="bg-white border border-zinc-200 rounded-xl my-12 overflow-hidden">
    <div class="bg-zinc-50 px-8 py-6 border-b border-zinc-200">
        <div class="flex justify-between items-center">
            <h2 class="flex items-center gap-4 m-0 text-2xl text-zinc-950 font-outfit font-semibold">
                User Reviews
                <span class="bg-red-500 text-white py-1 px-3 rounded-full text-sm font-medium">{{ $comments->count() }}</span>
            </h2>
            <button onclick="toggleReviewForm()" class="px-4 py-2 bg-red-500 text-white font-outfit font-medium text-sm rounded-lg hover:bg-red-600 transition-all duration-200 flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add Review
            </button>
        </div>
    </div>

    @include('components.movies.detail.review-form', ['movie' => $movie])

    @if($comments->isNotEmpty())
        <div class="max-h-96 overflow-y-auto">
            @foreach($comments as $comment)
                @include('components.movies.detail.review-item', ['comment' => $comment])
            @endforeach
        </div>
    @else
        <div class="py-12 text-center text-zinc-500">
            <h4 class="mb-2 text-zinc-950 font-outfit font-semibold">No reviews yet</h4>
            <p class="font-outfit font-normal">Be the first to share your thoughts about this movie!</p>
        </div>
    @endif
</section>