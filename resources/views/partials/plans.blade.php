
@foreach($plans as $plan)
    <input type="radio" id="{{ $plan->name }}-plan" name="plan" @if(auth()->user()->plan->name == $plan->name) checked @endif value="{{ $plan->name }}" class="radio-plan hidden">
    <label for="{{ $plan->name }}-plan" class="border-2 border-gray-300 w-full px-4 py-2 mr-1 pl-2 rounded-lg block coursor-pointer mb-3 cursor-pointer mb-3 relative">
        <div class="flex">
            <img src="/img/plans/{{ $plan->name }}.png" alt="{{ $plan->name }}" class="w-16 h-16 mr-3"/>
            <div>
                <span>{{ ucfirst($plan->name) }}</span>
                <span class="text-xs text-gray-700 block">{{ $plan->description }}</span>
                <span class="absolute right-0 bottom-0 bg-indigo-600 text-white font-bold rounded-br rounded-tl-lg text-xs px-2 py-1">
                    @if($plan->name == 'basic')
                        $7.00/mo.
                    @elseif($plan->name == 'plus')
                        $15.00/mo.
                    @elseif($plan->name == 'pro')
                        $20.00/mo.
                    @endif
                </span>
            </div>
        </div>
    </label> 
@endforeach