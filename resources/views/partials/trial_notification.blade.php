<div class="bg-teal-500 px-6 py-4 rounded-lg">
    <div class="flex">
        <svg class="fill-current text-white mr-4" xmlns="http://www.w3.org/2000/svg" width="40.083" height="39.929"><path data-name="Path 1" d="M16.495 6.321a.675.675 0 00-.925 0L11.712 9.93a1.7 1.7 0 00-1.539.4 1.873 1.873 0 000 2.467 1.515 1.515 0 00.279.18l.338 3.828c0 .308.154.617.771.617a.844.844 0 00.771-.617l.233-3.967c.025-.017.052-.023.076-.042a2 2 0 00.406-1.608l3.449-3.942a.7.7 0 00-.001-.925z"/><path data-name="Path 2" d="M30.833 10.791a1.457 1.457 0 001.542-1.542V4.625a1.542 1.542 0 00-3.083 0V9.25a1.457 1.457 0 001.541 1.541z"/><path data-name="Path 3" d="M0 11.562a11.647 11.647 0 0011.562 11.563 11.647 11.647 0 0011.563-11.563A11.647 11.647 0 0011.562 0 12.266 12.266 0 005.7 1.542a1.954 1.954 0 011.387.617 3.1 3.1 0 01.617 1.233 8.358 8.358 0 013.854-.925 9.1 9.1 0 11-9.094 9.125c.056-.015.1-.012.153-.029 0-2.775 1.233-3.854 1.233-3.854l1.237 1.078a.566.566 0 00.462.154.332.332 0 00.308-.308 23.247 23.247 0 00.308-5.087.538.538 0 00-.154-.308c-.154-.154-.154-.154-.308-.154a25.136 25.136 0 00-5.242.308.332.332 0 00-.307.308c0 .154 0 .462.154.462L1.7 5.4a8.988 8.988 0 00-.82 1.793A10.84 10.84 0 000 11.562z"/><path data-name="Rectangle 1" d="M17 31h3v3h-3z"/><path data-name="Rectangle 2" d="M11 25h3v3h-3z"/><path data-name="Rectangle 3" d="M11 31h3v3h-3z"/><path data-name="Rectangle 4" d="M23 25h3v3h-3z"/><path data-name="Rectangle 5" d="M23 31h3v3h-3z"/><path data-name="Rectangle 6" d="M23 18h3v4h-3z"/><path data-name="Path 4" d="M35.458 6.167h-1.542V9.25a3.083 3.083 0 11-6.167 0V6.167h-4.316a13.143 13.143 0 011.233 5.4 10.644 10.644 0 01-.617 3.854h12.95v20.037A1.457 1.457 0 0135.457 37H7.708a1.457 1.457 0 01-1.542-1.542V23.433a13.223 13.223 0 01-3.083-2v13.871a4.542 4.542 0 004.625 4.625h27.75a4.542 4.542 0 004.625-4.625V10.792a4.542 4.542 0 00-4.625-4.625z"/><path data-name="Rectangle 7" d="M17 25h3v3h-3z"/><path data-name="Rectangle 8" d="M29 18h3v4h-3z"/><path data-name="Rectangle 9" d="M29 31h3v3h-3z"/><path data-name="Rectangle 10" d="M29 25h3v3h-3z"/></svg>
        <div>
            <div class="text-sm font-medium text-white">You are on Trial Period for the basic plan</div>
            <div class="text-xs text-gray-200">You have {{ auth()->user()->trial_ends_at->diffInDays(now()) }} days left on your trial</div>
        </div>
        @if(isset($action_btn))
            <a href="{{ route('billing') }}" class="text-white px-4 py-2 rounded border border-gray-300 self-end ml-auto">
                Upgrad Plan
            </a>
        @endif
    </div>
</div>