# Patterns DB

---
- [Database](#database)

## Database
### Factories
<a name="database"></a>
We use factories to CRUD sample data for testing.
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