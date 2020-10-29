# Patterns
<a name="top"></a>

Intro to patterns goes here..
---
- Database
    - [Migration](#db-migration)
    - [Seeders](#db-seeders)
    - [Factories](#db-factories) 
- API (Dingo)
    - [Transformers](#api-transformers)
    - [Requests (Dingo)](#api-requests)

## Database

### Migrations
<a name="db-migrations"></a>
We use Migrations to CRUD our database tables and their relationships with others tables.

### Seeders
<a name="db-seeders"></a>
We use Seeders to populate sample data. although primarily for testing purposes, we also seed default data such as admin users or roles, permissions and options etc.

### Factories
<a name="db-factories"></a>
We use factories to either CRUD sample data for testing. These may be called directly with test functions or by seeders.

```php
/**
 * @test
 *
 * Test: DELETE /api/posts/$id.
 */
public function it_deletes_a_post()
{
    $user = factory(App\User::class)->create(['password' => bcrypt('password')]);

    $data = Post::create(['title' => 'This is a title', 'author' => $user->name, 'readtime' => 17, 'private' => true]);

    $this->delete('/api/post/' . $data->id, [], $this->headers($user))
         ->assertStatus(204);
}
``` 
## API (Dingo)

### Transformers
<a name="api-transformers"></a>

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
<a name="api-requests"></a>
For the API we use Dingo's own requests and so have created a new requests pattern.
Dingo form request class will check to see if the incoming request is for the API, and, if it is, it will throw a Dingo\Api\Exception\ValidationHttpException if validation fails. This exception will then be rendered correctly by the package and the error response returned.
#### Location: /app/Requests 
