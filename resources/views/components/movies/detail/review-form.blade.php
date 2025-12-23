<div id="reviewForm" class="hidden bg-zinc-50 border-b border-zinc-200 p-8">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 font-outfit">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 font-outfit">
            {{ session('error') }}
        </div>
    @endif
    
    <form action="{{ route('movies.comment', $movie->id) }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="user_name" class="block font-outfit font-medium text-sm text-zinc-700 mb-2">Your Name</label>
                <input type="text" id="user_name" name="user_name" required 
                       class="w-full px-4 py-3 border border-zinc-300 rounded-lg font-outfit text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all"
                       value="{{ old('user_name') }}">
                @error('user_name')
                    <p class="mt-1 text-sm text-red-600 font-outfit">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="rating" class="block font-outfit font-medium text-sm text-zinc-700 mb-2">Rating</label>
                <select id="rating" name="rating" required 
                        class="w-full px-4 py-3 border border-zinc-300 rounded-lg font-outfit text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all">
                    <option value="">Select Rating</option>
                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ Excellent</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ Good</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ Average</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ Poor</option>
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ Terrible</option>
                </select>
                @error('rating')
                    <p class="mt-1 text-sm text-red-600 font-outfit">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
            <label for="comment" class="block font-outfit font-medium text-sm text-zinc-700 mb-2">Your Review</label>
            <textarea id="comment" name="comment" rows="4" required
                      placeholder="Share your thoughts about this movie..."
                      class="w-full px-4 py-3 border border-zinc-300 rounded-lg font-outfit text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all resize-none">{{ old('comment') }}</textarea>
            @error('comment')
                <p class="mt-1 text-sm text-red-600 font-outfit">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-red-500 text-white font-outfit font-medium text-sm rounded-lg hover:bg-red-600 transition-all duration-200">
                Submit Review
            </button>
            <button type="button" onclick="toggleReviewForm()" class="px-6 py-3 bg-zinc-100 text-zinc-600 font-outfit font-medium text-sm rounded-lg hover:bg-zinc-200 transition-all duration-200">
                Cancel
            </button>
        </div>
    </form>
</div>