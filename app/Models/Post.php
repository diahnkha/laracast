<?php
    namespace App\Models;
    use Illuminate\Support\Facades\File;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Spatie\YamlFrontMatter\YamlFrontMatter;


    class Post
    { 
        // public static function all()
        // {
        //     return File::files(resource_path("posts/"));
        // }

        public $title;
        public $excerpt;
        public $date;
        public $body;
        public $slug;

        public function __construct($title, $excerpt, $date, $body, $slug)
        {
            $this->title = $title;
            $this->excerpt = $excerpt;
            $this->date = $date;
            $this->body = $body;
            $this->slug = $slug;
        }

        public static function all(){
            // $files = File::files(resource_path("posts/"));

            // return array_map(fn($file) => $file->getcontents(), $files);
            return cache()->rememberForever('posts.all', function (){

                return collect(File::files(resource_path("posts")))
                ->map(fn($file) => YamlFrontMatter::parsefile($file))
                ->map(fn($document) => new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                ))->sortByDesc('date');
            });
        }

        public static function find($slug)
        {
            // base_path();
            // if(!file_exists($path = resource_path("posts/{$slug}.html"))){
            //     // return redirect('/');
            //     throw new ModelNotFoundException();
            // }

            // $post = cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));

            // return view('post',['post' => $post]);

            return static::all()->firstwhere('slug', $slug);
        }
    }
?>