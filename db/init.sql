CREATE TABLE user (
    `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL
);

CREATE TABLE machine (
    `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    `hostname` TEXT NOT NULL UNIQUE,
    `owner` INTEGER NOT NULL
);

CREATE TABLE service (
    `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    `machine` INTEGER NOT NULL,
    `name` TEXT NOT NULL,
    `state` TEXT NOT NULL
);

CREATE TABLE event (
    `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    `service` INTEGER NOT NULL,
    `description` TEXT NOT NULL
);

INSERT INTO user ( id, name, email ) VALUES
    ( 1, "Alice", "alice@somewhere.net" ),
    ( 2, "Bob", "bob@mail.somewhere.net" ),
    ( 3, "Charlie", "ch@somewhere.net" );

INSERT INTO machine ( id, hostname, owner ) VALUES
    ( 1, "www.somewhere.net", 2 ),
    ( 2, "testing.somewhere.net", 3 );

INSERT INTO service ( id, machine, name, state ) VALUES
    ( 1, 1, "Main web server", "up" ),
    ( 2, 2, "Front-end for testing services", "up" ),
    ( 3, 2, "Main CI server", "down" );

INSERT INTO event ( service, description ) VALUES
    ( 1, "2016-02-02T07:30 service is down" ),
    ( 1, "2016-02-02T07:35 service is up" );
