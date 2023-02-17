<x-layout>
        @include ('_posts-header')

        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            @if($posts->count())
                <x-post-grid :posts="$posts"/>
            @else
                <p class="text-center">No posts yet. Please check back later.</p>
            @endif

            <div class="lg:grid lg:grid-cols-2">
                <x-post-card />
                <x-post-card />
            </div>

<<<<<<< HEAD
            <div class="lg:grid lg:grid-cols-6">
                <x-post-card />
                <x-post-card />
                <x-post-card />
            </div>
        </main>
=======
            <p>
                <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
            </p>

            <p> {!! $post->excerpt !!} </p>
            
        </article>
    @endforeach
>>>>>>> parent of 23e8ccd... eager loading relationship

</x-layout>
