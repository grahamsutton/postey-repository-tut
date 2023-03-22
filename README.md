# Postey (Repository Pattern Tutorial)

This is an actual working version of how I implement a simple repository pattern based on my blog article [Implement the Repository Pattern in PHP](https://grahamsutton.dev/implement-the-repository-pattern-in-php/).

## Try It Yourself

The `postey` file is a little playground script where you can play with the `PostgresPostsRepository` implementation of the `PostsRepository` interface.

To get started, start the docker containers. On first startup of the containers, the `init.sql` script will be run which creates a table called `posts` in the Postgres database with a few post records:

```sh
$ docker-compose up
```

Then open a shell into the `php` docker container:

```sh
$ docker exec -it postey-php-1 /bin/bash
```

Once inside the `php` docker container, install the Composer dependencies

```sh
$ composer install
```

And then finally, you can run the `php postey` command to try out all of the repository commands:

```sh
$ php postey
```

Play around and make modifications as you like. Try it out!

## Testing

Additionally, there's a few unit tests you can run if you wish:

```sh
$ vendor/bin/phpunit tests --testdox --colors
```

I didn't test everything. I was just a bit lazy to be honest. I added some of these unit tests just to show how I go about testing the `PostgresPostsRepository` implementation. My point was just to demonstrate how to keep things testable.

