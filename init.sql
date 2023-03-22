CREATE TABLE posts (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255),
    body TEXT
);

INSERT INTO posts (
    title,
    body
) VALUES (
    'My First Post',
    'This is the first post I''ve ever written'
);

INSERT INTO posts (
    title,
    body
) VALUES (
    'My Second Post',
    'This is my second post. This second post always comes after the first post.'
);