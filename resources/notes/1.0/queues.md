# Servers

---
- [Redis](#redis)
- [Twitter Listener](#addcurio)

<a name="redis"></a>
## Redis
The Redis facade is now aliased as RedisL for compatability purposes.

<a name="twitter listener"></a>
## Twitter Listener (addcurio)
The Twitter-Listener queues each tweet startign with `@addcurio` to be processed by the `app/Jobs/ProcessTweet` job.
Firstly, this job will check that the tweet came from an 'active' member. Then check the tweet doesnt exists (by id). if it passes then the job will extract the various elements from the content, create a new post with related links, tags and media. 
If the tweet has a 'link' the task will then try to get the 'opengraph' metadata using the `shweshi/opengraph` package.