<x-back.master>
    @push('title')
        Limonist
    @endpush



    <div class="row mt-5">
        @foreach ($branches as $branch)
            <div class="col-md-3 menu-style by-3">
                <a href="{{ route('admin.category.list', $branch->id) }}">
                    <div class="text-center mb-3 ">
                        <img alt="Logo" src="{{ asset('src/img/RoundIcons-Free-Set-20.png') }}"
                            class="h-60px logo" />
                    </div>
                    <h3 class="text-center">{{ $branch->name }}</h3>

                </a>
            </div>
        @endforeach






    </div>




</x-back.master>
