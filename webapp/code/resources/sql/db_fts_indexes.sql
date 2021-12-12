-- Code by Carlos Albuquerque, LBAW 20/21 monitor

-----------------------------------------
-- FTS INDEXES
-----------------------------------------

-- Add column to work to store computed ts_vectors.
ALTER TABLE work
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION work_search_update() RETURNS TRIGGER AS $$
BEGIN
  IF TG_OP = 'INSERT' THEN
    NEW.tsvectors = (
      setweight(to_tsvector('english', NEW.title), 'A') ||
      setweight(to_tsvector('english', NEW.obs), 'B')
    );
  END IF;
  IF TG_OP = 'UPDATE' THEN
      IF (NEW.title <> OLD.title OR NEW.obs <> OLD.obs) THEN
        NEW.tsvectors = (
          setweight(to_tsvector('english', NEW.title), 'A') ||
          setweight(to_tsvector('english', NEW.obs), 'B')
        );
      END IF;
  END IF;
  RETURN NEW;
END $$
LANGUAGE plpgsql;

-- Create a trigger before insert or update on work.
CREATE TRIGGER work_search_update
  BEFORE INSERT OR UPDATE ON work
  FOR EACH ROW
  EXECUTE PROCEDURE work_search_update();


-- Finally, create a GIN index for ts_vectors.
CREATE INDEX search_idx ON work USING GIN (tsvectors);
