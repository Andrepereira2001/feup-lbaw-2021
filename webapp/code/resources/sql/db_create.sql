-- Types

CREATE TYPE media AS ENUM ('CD', 'DVD', 'VHS', 'Slides', 'Photos', 'MP3');

-- Tables

CREATE TABLE users (
    id          SERIAL  PRIMARY KEY,
    email       TEXT    NOT NULL CONSTRAINT user_email_uk UNIQUE,
    name        TEXT    NOT NULL,
    obs         TEXT,
    password    TEXT    NOT NULL,
    img         TEXT,
    is_admin    BOOLEAN NOT NULL
);

CREATE TABLE publisher (
    id      SERIAL  PRIMARY KEY,
    name    TEXT    NOT NULL
);

CREATE TABLE location (
    id      SERIAL  PRIMARY KEY,
    name    TEXT    NOT NULL,
    address TEXT    NOT NULL,
    gps     TEXT
);

CREATE TABLE author (
    id      SERIAL  PRIMARY KEY,
    name    TEXT    NOT NULL,
    img     TEXT
);

CREATE TABLE collection (
    id      SERIAL  PRIMARY KEY,
    name    TEXT    NOT NULL
);

CREATE TABLE work (
    id              SERIAL  PRIMARY KEY,
    title           TEXT    NOT NULL,
    obs             TEXT,
    img             TEXT,
    year            INTEGER,
    id_users        INTEGER REFERENCES users      (id) ON UPDATE CASCADE,
    id_collection   INTEGER REFERENCES collection (id) ON UPDATE CASCADE,
    CONSTRAINT year_positive_ck CHECK ((year > 0))
);

CREATE TABLE author_work (
    id_author   INTEGER     NOT NULL REFERENCES author (id) ON UPDATE CASCADE,
    id_work     INTEGER     NOT NULL REFERENCES work   (id) ON UPDATE CASCADE,
    PRIMARY KEY (id_author, id_work)
);

CREATE TABLE book (
    id_work         INTEGER PRIMARY KEY REFERENCES work (id) ON UPDATE CASCADE,
    edition         TEXT,
    isbn            BIGINT  NOT NULL CONSTRAINT book_isbn_uk UNIQUE,
    id_publisher    INTEGER REFERENCES publisher (id) ON UPDATE CASCADE
);

CREATE TABLE nonbook (
    id_work INTEGER PRIMARY KEY REFERENCES work (id) ON UPDATE CASCADE ON DELETE CASCADE,
    TYPE    media   NOT NULL
);

CREATE TABLE item (
    id          SERIAL  PRIMARY KEY,
    id_work     INTEGER NOT NULL REFERENCES work     (id) ON UPDATE CASCADE,
    id_location INTEGER NOT NULL REFERENCES location (id) ON UPDATE CASCADE,
    code        INTEGER NOT NULL,
    date        TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);

CREATE TABLE loan (
    id          SERIAL  PRIMARY KEY,
    id_item     INTEGER NOT NULL REFERENCES item  (id) ON UPDATE CASCADE,
    id_users    INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    start_t     TIMESTAMP WITH TIME ZONE NOT NULL,
    end_t       TIMESTAMP WITH TIME ZONE NOT NULL,
    CONSTRAINT date_ck CHECK (end_t > start_t)
);

CREATE TABLE review (
    id_work     INTEGER NOT NULL REFERENCES work  (id) ON UPDATE CASCADE,
    id_users    INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    comment     TEXT    NOT NULL,
    rating      INTEGER NOT NULL CONSTRAINT rating_ck CHECK (((rating > 0) OR (rating <= 5))),
    PRIMARY KEY (id_work, id_users)
);

CREATE TABLE wish_list (
    id_work     INTEGER NOT NULL REFERENCES work  (id) ON UPDATE CASCADE,
    id_users    INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    PRIMARY KEY (id_work, id_users)
);
