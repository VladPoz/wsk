<x-layout>
    <div class="container">
        <div class="row my-3 g-3">
            <div class="col-md-6">
                <p class="fs-4 text-center mb-3">{{$user->name}}</p>
            </div>
            <div class="col-md-6">
                <div class="card p-3 bg-dark text-light h-100">
                    <p class="fs-4 text-center mb-3">Топ новостей</p>
                    <ol>
                        @foreach($topNews as $topNew)
                            <li class="fs-5">{{$topNew->title}}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">

                </div>
            </div>
        </div>
    </div>
</x-layout>
