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

DROP TYPE IF EXISTS Role CASCADE;


-----------------------------------------
-- Types
-----------------------------------------

CREATE TYPE Role AS ENUM ('Member', 'Coordinator') ;

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
    image_path             TEXT NOT NULL DEFAULT './img/default',
    remember_token         TEXT,
    blocked                BOOLEAN NOT NULL DEFAULT false
);

CREATE TABLE Admin (
    id                     SERIAL PRIMARY KEY,
    email                  TEXT NOT NULL
                           CONSTRAINT admin_email_uk UNIQUE,
    password               TEXT NOT NULL,
    name                   TEXT NOT NULL,
    remember_token         TEXT,
    image_path             TEXT NOT NULL DEFAULT 'img/default'
                           CONSTRAINT a_image_path_uk UNIQUE
);

CREATE TABLE Project (
    id                     SERIAL PRIMARY KEY,
    name                   TEXT NOT NULL,
    description            TEXT,
    color                  TEXT DEFAULT '#595656',
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    archived_at            TIMESTAMP,
    CONSTRAINT project_dates CHECK ((archived_at IS NULL) OR (archived_at > created_at))
);

CREATE TABLE Participation (
    id                     SERIAL PRIMARY KEY,
    favourite              BOOL NOT NULL DEFAULT False,
    role                   Role NOT NULL,
    id_project             INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE,
    id_user                INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT participation_uk UNIQUE (id_user,id_project)
);

CREATE TABLE Task (
    id                     SERIAL PRIMARY KEY,
    name                   TEXT NOT NULL,
    description            TEXT DEFAULT '',
    priority               INTEGER,
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    finished_at            TIMESTAMP,
    task_number            INT NOT NULL,
    due_date               TIMESTAMP,
    id_project             INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE,
    id_user                INTEGER REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT task_dates CHECK ((finished_at IS NULL) OR (finished_at > created_at)),
    CONSTRAINT priority_range CHECK ((priority > 0) AND (priority < 6)),
    CONSTRAINT project_task_number UNIQUE (id_project, task_number),
    CONSTRAINT task_due_date CHECK (due_date > created_at)
);

CREATE TABLE Label (
    id                     SERIAL PRIMARY KEY,
    name                   TEXT NOT NULL,
    id_project             INTEGER REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE TaskLabel (
    id                     SERIAL PRIMARY KEY,
    id_task                INTEGER NOT NULL REFERENCES Task(id) ON DELETE CASCADE ON UPDATE CASCADE,
    id_label               INTEGER NOT NULL REFERENCES Label(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT task_label UNIQUE (id_task, id_label)
);

CREATE TABLE TaskComment (
    id                     SERIAL PRIMARY KEY,
    content                TEXT NOT NULL,
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    id_task                INTEGER NOT NULL REFERENCES Task(id) ON DELETE CASCADE ON UPDATE CASCADE,
    id_user                INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE
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
    id_project             INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT invite_uk UNIQUE (id_user,id_project)
);

CREATE TABLE Notification (
    id                     SERIAL PRIMARY KEY,
    content                TEXT NOT NULL,
    created_at             TIMESTAMP NOT NULL DEFAULT now(),
    id_project             INTEGER NOT NULL REFERENCES Project(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Seen (
    id                     SERIAL PRIMARY KEY,
    seen                   BOOLEAN NOT NULL DEFAULT False,
    id_user                INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    id_notification        INTEGER NOT NULL REFERENCES Notification(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT seen_uk UNIQUE (id_user,id_notification)
);

CREATE TABLE Password_resets (
    email                  TEXT,
    token                  TEXT,
    created_at             TIMESTAMP
);


-----------------------------------------
-- INDEXES
-----------------------------------------

DROP INDEX IF EXISTS user_seen;
DROP INDEX IF EXISTS task_taskComment;
DROP INDEX IF EXISTS project_message;
DROP INDEX IF EXISTS project_task;
DROP INDEX IF EXISTS user_participation;

DROP INDEX IF EXISTS search_name;
DROP INDEX IF EXISTS search_project;
DROP INDEX IF EXISTS search_task;

DROP TRIGGER IF EXISTS user_search_update ON Users;
DROP TRIGGER IF EXISTS project_search_update ON Project;
DROP TRIGGER IF EXISTS task_search_update ON Task;

DROP FUNCTION IF EXISTS user_search_update();
DROP FUNCTION IF EXISTS project_search_update();
DROP FUNCTION IF EXISTS task_search_update();

-- Index 1
CREATE INDEX user_seen ON Seen USING btree (id_user, seen);

-- Index 2
CREATE INDEX task_taskComment ON TaskComment USING hash (id_task);

-- Index 3
CREATE INDEX project_message ON ForumMessage USING hash (id_project);

-- Index 4
CREATE INDEX project_task ON Task USING hash (id_project);

-- Index 5
CREATE INDEX user_participation ON Participation USING hash (id_user);

-- FTS INDEXES

-- Index 6
ALTER TABLE Users
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION user_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.name), 'A')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.name <> OLD.name) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', NEW.name), 'A')
           );
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER user_search_update
BEFORE INSERT OR UPDATE ON Users
FOR EACH ROW
EXECUTE PROCEDURE user_search_update();

CREATE INDEX search_name ON Users USING GIN (tsvectors);

-- Index 7
ALTER TABLE Project
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION project_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.name), 'A') ||
         setweight(to_tsvector('english', NEW.description), 'C')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.name <> OLD.name OR NEW.description <> OLD.description) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', NEW.name), 'A') ||
             setweight(to_tsvector('english', NEW.description), 'C')
           );
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER project_search_update
 BEFORE INSERT OR UPDATE ON Project
 FOR EACH ROW
 EXECUTE PROCEDURE project_search_update();

CREATE INDEX search_project ON Project USING GIN (tsvectors);

-- Index 8
ALTER TABLE Task
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION task_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.name), 'A') ||
         setweight(to_tsvector('english', NEW.description), 'C')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.name <> OLD.name OR NEW.description <> OLD.description) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', NEW.name), 'A') ||
             setweight(to_tsvector('english', NEW.description), 'C')
           );
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER task_search_update
 BEFORE INSERT OR UPDATE ON Task
 FOR EACH ROW
 EXECUTE PROCEDURE task_search_update();

CREATE INDEX search_task ON Task USING GIN (tsvectors);


-----------------------------------------
-- TRIGGERS and UDFs
-----------------------------------------

DROP FUNCTION IF EXISTS task_number();
DROP FUNCTION IF EXISTS user_anonymous();
DROP FUNCTION IF EXISTS remove_task();
DROP FUNCTION IF EXISTS block_user();
DROP FUNCTION IF EXISTS finished_task();
DROP FUNCTION IF EXISTS assign_task();
DROP FUNCTION IF EXISTS accept_invite();
DROP FUNCTION IF EXISTS notify_invitation();
DROP FUNCTION IF EXISTS coordinator_change();
DROP FUNCTION IF EXISTS no_delete_coordinator();
DROP FUNCTION IF EXISTS no_invite_participant();
DROP FUNCTION IF EXISTS task_if_participating();
DROP FUNCTION IF EXISTS comment_if_participating();
DROP FUNCTION IF EXISTS message_if_participating();

DROP TRIGGER IF EXISTS task_number ON Task;
DROP TRIGGER IF EXISTS user_anonymous ON Users;
DROP TRIGGER IF EXISTS remove_task ON Participation;
DROP TRIGGER IF EXISTS block_user ON Users;
DROP TRIGGER IF EXISTS notification_finished_task ON Task;
DROP TRIGGER IF EXISTS assign_task ON Task;
DROP TRIGGER IF EXISTS notification_accept_invite ON Participation;
DROP TRIGGER IF EXISTS invite_notification ON Invite;
DROP TRIGGER IF EXISTS coordinator_change ON Participation;
DROP TRIGGER IF EXISTS no_delete_coordinator ON Participation;
DROP TRIGGER IF EXISTS no_invite_participant ON Invite;
DROP TRIGGER IF EXISTS task_if_participating ON Task;
DROP TRIGGER IF EXISTS comment_if_participating ON TaskComment;
DROP TRIGGER IF EXISTS message_if_participating ON ForumMessage;

-- Trigger 1

CREATE FUNCTION task_number() RETURNS TRIGGER AS
$BODY$
BEGIN
        NEW.task_number := (SELECT count(*)
                               FROM Task
                               WHERE Task.id_project = NEW.id_project);
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER task_number
        BEFORE INSERT ON Task
        FOR EACH ROW
        EXECUTE PROCEDURE task_number();


-- Trigger 2

CREATE FUNCTION user_anonymous() RETURNS TRIGGER AS
$BODY$
BEGIN
        UPDATE Users
        SET name = 'Anonymous', email = 'anonymous' || OLD.id || '@anonymous.pt'
        WHERE OLD.id = Users.id;

        RETURN NULL; -- check if this really dont delete user
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER user_anonymous
        BEFORE DELETE ON Users
        FOR EACH ROW
        EXECUTE PROCEDURE user_anonymous();


-- Trigger 3

CREATE FUNCTION remove_task() RETURNS TRIGGER AS
$BODY$
BEGIN

        UPDATE task
        SET id_user = NULL
        WHERE OLD.id_user = task.id_user AND task.finished_at = NULL;

        RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_task
        AFTER DELETE ON participation
        FOR EACH ROW
        EXECUTE PROCEDURE remove_task();


-- Trigger 4

CREATE FUNCTION block_user() RETURNS TRIGGER AS
$BODY$
BEGIN
        DELETE FROM Participation
        WHERE Participation.id_user = OLD.id;

        RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER block_user
        AFTER UPDATE OF blocked
        ON Users
        FOR EACH ROW
        WHEN (OLD.blocked = FALSE)
        EXECUTE PROCEDURE block_user();


-- Trigger 5

CREATE FUNCTION finished_task() RETURNS TRIGGER AS
$BODY$
BEGIN

        INSERT INTO Notification (content, id_project)
        VALUES ('Task ' || OLD.task_number || ' completed!', OLD.id_project)
        RETURNING id AS notification_id;

        IF (OLD.id_user IS NOT NULL) THEN
            INSERT INTO Seen (seen, id_user, id_notification)
            Select False, OLD.id_user, notification_id.id
            FROM notification_id;
        END IF;

        INSERT INTO Seen (seen, id_user, id_notification)
		SELECT (False, id_user, notificationid_notification)
		FROM Participation
		WHERE Participation.id_project = OLD.id_project AND Participation.role = 'Coordinator';

        RETURN NULL;

END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER notification_finished_task
        AFTER UPDATE OF finished_at
        ON Task
        FOR EACH ROW
        WHEN (OLD.finished_at = NULL)
        EXECUTE PROCEDURE finished_task();

-- Trigger 6

CREATE FUNCTION assign_task() RETURNS TRIGGER AS
$BODY$
BEGIN
        WITH notification_id AS (INSERT INTO Notification (content, id_project)
        VALUES ('New task ' || NEW.task_number || ' assigned to you!', NEW.id_project)
        RETURNING id)

        INSERT INTO Seen (seen, id_user, id_notification)
        SELECT False, NEW.id_user, notification_id.id
        FROM notification_id;


        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER assign_task
        AFTER UPDATE
        ON Task
        FOR EACH ROW
        EXECUTE PROCEDURE assign_task();

-- Trigger 7

CREATE FUNCTION accept_invite() RETURNS TRIGGER AS
$BODY$
BEGIN

        WITH notification_id AS (INSERT INTO Notification (content, id_project)
        VALUES ('New ' || NEW.role || ' in your project!', NEW.id_project)
        RETURNING id)

        INSERT INTO Seen (seen, id_user, id_notification)
		SELECT False, Participation.id_user, notification_id.id
		FROM Participation, notification_id
		WHERE Participation.id_project = NEW.id_project AND Participation.role = 'Coordinator';

        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER notification_accept_invite
        AFTER INSERT
        ON Participation
        FOR EACH ROW
        EXECUTE PROCEDURE accept_invite();

-- Trigger 8

CREATE FUNCTION notify_invitation() RETURNS TRIGGER AS
$BODY$
BEGIN
        WITH notification_id AS (INSERT INTO Notification (content, id_project)
        VALUES ('Invite to a new project!', NEW.id_project)
        RETURNING id)

        INSERT INTO Seen (seen, id_user, id_notification)
        SELECT False, NEW.id_user, notification_id.id
        FROM notification_id;

        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER invite_notification
        AFTER INSERT
        ON Invite
        FOR EACH ROW
        EXECUTE PROCEDURE notify_invitation();

-- Trigger 9

CREATE FUNCTION coordinator_change() RETURNS TRIGGER AS
$BODY$
BEGIN
        WITH notification_id AS (INSERT INTO Notification (content, id_project)
        VALUES ('Your project has a new Coordinator!', NEW.id_project)
        RETURNING id)

        INSERT INTO Seen (seen, id_user, id_notification)
		SELECT False, id_user, notification_id.id
		FROM Participation, notification_id
		WHERE Participation.id_project = NEW.id_project;

        RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER coordinator_change
        AFTER UPDATE
        ON Participation
        FOR EACH ROW
        WHEN (NEW.role = 'Coordinator' AND OLD.role = 'Member')
        EXECUTE PROCEDURE coordinator_change();

-- Trigger 10

-- CREATE FUNCTION no_delete_coordinator() RETURNS TRIGGER AS
-- $BODY$
-- BEGIN
--         IF EXISTS(SELECT *
--                    FROM participation
--                    WHERE participation.role = 'Coordinator'
-- 				  		 AND participation.id_project = OLD.id_project
-- 				 		 AND participation.id_user <> OLD.id_user)
-- 		THEN RAISE EXCEPTION 'You can not have a project(%) without a coordinator(%)',OLD.id_project,OLD.id_user;
--         END IF;
--         RETURN OLD;

-- END
-- $BODY$
-- LANGUAGE plpgsql;

-- CREATE TRIGGER no_delete_coordinator
--         BEFORE DELETE
--         ON Participation
--         FOR EACH ROW
--         WHEN (OLD.role = 'Coordinator')
--         EXECUTE PROCEDURE no_delete_coordinator();


-- Trigger 11

CREATE FUNCTION no_invite_participant() RETURNS TRIGGER AS
$BODY$
BEGIN
        IF EXISTS(SELECT *
                   FROM Participation
                   WHERE Participation.id_project = NEW.id_project
			 AND Participation.id_user = NEW.id_user)
		THEN RAISE EXCEPTION 'You can not invite a participant(%) of the project(%)',NEW.id_user, NEW.id_project ;
        END IF;
        RETURN NEW;

END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER no_invite_participant
        BEFORE INSERT
        ON invite
        FOR EACH ROW
        EXECUTE PROCEDURE no_invite_participant();


-- Trigger 12

CREATE FUNCTION task_if_participating() RETURNS TRIGGER AS
$BODY$
BEGIN
        IF NEW.id_user IS NULL
        THEN RETURN NEW;
        END IF;

        IF NOT EXISTS(SELECT *
                   FROM participation
                   WHERE participation.id_project = NEW.id_project
			 AND participation.id_user = NEW.id_user)
		THEN RAISE EXCEPTION 'User(%) not in the project(%)',NEW.id_user, NEW.id_project ;
        END IF;
        RETURN NEW;

END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER task_if_participating
        BEFORE INSERT
        ON task
        FOR EACH ROW
        EXECUTE PROCEDURE task_if_participating();

-- Trigger 13

CREATE FUNCTION comment_if_participating() RETURNS TRIGGER AS
$BODY$
BEGIN
        IF NOT EXISTS ( SELECT *
                        FROM participation, Task
                        WHERE participation.id_project = task.id_project
			      AND participation.id_user = NEW.id_user
                              AND task.id = NEW.id_task)
		THEN RAISE EXCEPTION 'User(%) can not comment in the task(%)',NEW.id_user, NEW.id_task ;
        END IF;
        RETURN NEW;

END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER comment_if_participating
        BEFORE INSERT
        ON taskcomment
        FOR EACH ROW
        EXECUTE PROCEDURE comment_if_participating();


-- Trigger 14

CREATE FUNCTION message_if_participating() RETURNS TRIGGER AS
$BODY$
BEGIN
        IF NOT EXISTS ( SELECT *
                        FROM participation
                        WHERE participation.id_project = NEW.id_project
			      AND participation.id_user = NEW.id_user)
		THEN RAISE EXCEPTION 'User(%) can not send message in project(%)',NEW.id_user, NEW.id_project;
        END IF;
        RETURN NEW;

END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER message_if_participating
        BEFORE INSERT
        ON ForumMessage
        FOR EACH ROW
        EXECUTE PROCEDURE message_if_participating();
