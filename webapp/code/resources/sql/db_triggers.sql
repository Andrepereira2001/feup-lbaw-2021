-- TRIGGERS

-- TRIGGER01
-- An item can only be loaned to one user at a given moment. 

CREATE FUNCTION loan_item() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM loan WHERE NEW.id_item = id_item AND end_t > NEW.start_t) THEN
        RAISE EXCEPTION 'An item can only be loaned to one user in every moment.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER loan_item
    BEFORE INSERT OR UPDATE ON loan
    FOR EACH ROW
    EXECUTE PROCEDURE loan_item();

-- TRIGGER02
-- An item cannot be loaned to its owner. 

CREATE FUNCTION item_owner() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM item
        INNER JOIN work ON work.id = item.id_work
        WHERE NEW.id_item = item.id AND NEW.id_users = work.id_users ) THEN
    RAISE EXCEPTION 'An item cannot be loaned to its owner.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER item_owner
    BEFORE INSERT OR UPDATE ON loan
    FOR EACH ROW
    EXECUTE PROCEDURE item_owner();

-- TRIGGER03
-- A users' item cannot be in his wishlist.

CREATE FUNCTION work_wish_list() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM work WHERE NEW.id_work = id AND NEW.id_users = id_users) THEN
        RAISE EXCEPTION 'An user item cannot be in his wishlist.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER work_wish_list
    BEFORE INSERT OR UPDATE ON wish_list
    FOR EACH ROW
    EXECUTE PROCEDURE work_wish_list();
