DROP TABLE IF EXISTS Participation CASCADE;
DROP TABLE IF EXISTS TaskLabel CASCADE;
DROP TABLE IF EXISTS Label CASCADE;
DROP TABLE IF EXISTS TaskComment CASCADE;
DROP TABLE IF EXISTS ForumMessage CASCADE;
DROP TABLE IF EXISTS Invite CASCADE;
DROP TABLE IF EXISTS Notification CASCADE;
DROP TABLE IF EXISTS Seen CASCADE;
DROP TABLE IF EXISTS Task CASCADE;
DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Admin CASCADE;
DROP TABLE IF EXISTS Project CASCADE;

DROP TYPE IF EXISTS role CASCADE;


-----------------------------------------
-- Types
-----------------------------------------

CREATE TYPE role AS ENUM ('Member', 'Coordinator') ;

-----------------------------------------
-- Tables
-----------------------------------------


-- Note that a plural 'users' name was adopted because user is a reserved word in PostgreSQL.

CREATE TABLE Users (
    id                     SERIAL PRIMARY KEY,
    email                  TEXT NOT NULL
                           CONSTRAINT user_email_uk UNIQUE,
    password               TEXT NOT NULL,
    name                   TEXT NOT NULL,
    image_path              TEXT NOT NULL DEFAULT './img/default' 
                           CONSTRAINT u_image_path_uk UNIQUE,
    blocked                BOOLEAN NOT NULL
                           CONSTRAINT blocked_uk UNIQUE
);

CREATE TABLE Admin (
    id                     SERIAL PRIMARY KEY,
    email                  TEXT NOT NULL
                           CONSTRAINT admin_email_uk UNIQUE,
    password               TEXT NOT NULL,
    name                   TEXT NOT NULL,
    image_path              TEXT NOT NULL DEFAULT 'img/default' 
                           CONSTRAINT a_image_path_uk UNIQUE
);

CREATE TABLE Project (
    id                     SERIAL PRIMARY KEY,
    name                   TEXT NOT NULL,
    description            TEXT,
    color                  TEXT,
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    archived_at            TIMESTAMP,
    CONSTRAINT project_dates CHECK ((archived_at IS NULL) OR (archived_at > created_at))
);

CREATE TABLE Participation (
    id                     SERIAL PRIMARY KEY,
    favourite BOOL         NOT NULL,
    id_project             INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE, 
    id_user                INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE 
);

CREATE TABLE Task (
    id                     SERIAL PRIMARY KEY,
    name                   TEXT NOT NULL,
    description            TEXT,
    priority               INTEGER, 
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    finished_at            TIMESTAMP,
    id_project             INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE, 
    id_user                INTEGER REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE, 
    CONSTRAINT task_dates CHECK ((finished_at IS NULL) OR (finished_at > created_at)),
    CONSTRAINT priority_range CHECK ((priority > 0) AND (priority < 6))
);

CREATE TABLE Label (
    id                     SERIAL PRIMARY KEY,
    name                   TEXT NOT NULL CONSTRAINT label_name_uk UNIQUE 
);

CREATE TABLE TaskLabel (
    id                     SERIAL PRIMARY KEY,
    id_task                INTEGER NOT NULL REFERENCES Task(id) ON DELETE CASCADE ON UPDATE CASCADE,
    id_label               INTEGER NOT NULL REFERENCES Label(id) ON DELETE CASCADE ON UPDATE CASCADE 
);

CREATE TABLE TaskComment (
    id                     SERIAL PRIMARY KEY,
    content                TEXT NOT NULL,
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    id_task                INTEGER NOT NULL REFERENCES Task(id) ON DELETE CASCADE ON UPDATE CASCADE, 
    id_user                INTEGER REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE 
);

CREATE TABLE ForumMessage (
    id                     SERIAL PRIMARY KEY,
    content                TEXT NOT NULL,
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    id_project             INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE, 
    id_user                INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE   
);

CREATE TABLE Invite (
    id                     SERIAL PRIMARY KEY,
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    id_user                INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    id_project             INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Notification (
    id                     SERIAL PRIMARY KEY,
    content                TEXT NOT NULL,
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    id_project             INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Seen (
    id                     SERIAL PRIMARY KEY,
    seen                   BOOLEAN DEFAULT False,
    id_user                INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    id_notification        INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE
);
