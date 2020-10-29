# Patterns API

---
- [API (Dingo)](#api-dingo)


## API (Dingo)
<a name="api-dingo"></a>

### Transformers
We use transformers in our API to cover us when we refactor the database and when we need to hide, re-cast or alter values in anyway.

#### Location: /app/transformers 
```php
    namespace App\Transformers;
    use App\post;
    use League\Fractal\TransformerAbstract;
    
    class postsTransformer extends TransformerAbstract
    {
        public function transform(post $post)
        {
            return [
                'id'        => (int) $post->id,
                'title'      => ucfirst($post->title),
                'author'     => ucfirst($post->author),
                'readtime'    => $post->readtime . ' mins',
                'private' => (bool) $post->private,
            ];
        }
    }
```
#### Usage:
```php
    use Dingo\Api\Routing\Helpers;
    use App\Transformers\PostsTransformer;
    class PostsController extends Controller
    {
        use Helpers;
        
        public function index()
        {
            $data = Post::all();
            return $this->collection($data, new PostsTransformer);
        }
    }

```

### Requests (Dingo FormRequests)
Dingo form request class will check to see if the incoming request is for the API, and, if it is, it will throw a Dingo\Api\Exception\ValidationHttpException if validation fails. This exception will then be rendered correctly by the package and the error response returned.
#### Location: /app/Requests 


### Presentation & Transformarion (Fractal)
Fractal provides a presentation and transformation layer for complex data output, the like found in RESTful APIs, and works really well with JSON. Think of this as a view layer for your JSON/YAML/etc.

When building an API it is common for people to just grab stuff from the database and pass it to json_encode(). This might be passable for “trivial” APIs but if they are in use by the public, or used by mobile applications then this will quickly lead to inconsistent output.#### Location: /app/Requests 
[Docs](https://fractal.thephpleague.com/)
