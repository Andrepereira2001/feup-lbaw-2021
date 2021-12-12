-- INDEXES

CREATE INDEX email_user ON users USING hash (email);

-- Table is very large; query SELECT03, used to search the items of an user, 
-- has to be fast because it's executed many times; doesn't need range query
-- support; cardinality is medium so it's a good candidate for clustering. 
CREATE INDEX user_work ON work USING btree (id_users);

-- Query SELECT04, used to search the loans of an user, has to be fast because
-- it's executed several times; doesn't need range query support; cardinality
-- is medium so it's a good candidate for clustering. From the three candidate
-- indexes for clustering on table loan, this has the most adequate cardinality
-- (about 10 loans per user).
CREATE INDEX user_loan ON loan USING hash (id_users);

-- To allow searching items by start date range faster; It's clustered to allow
-- for quick range queries; cardinality is medium. 
CREATE INDEX start_loan ON loan USING btree (start_t);

-- To allow searching items by end date range faster. It's clustered to allow
-- for quick range queries; cardinality is medium. 
CREATE INDEX end_loan ON loan USING btree (end_t);

CREATE INDEX id_location ON location USING hash (id);
