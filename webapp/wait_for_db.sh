echo "Wait until PostgreSQL is up and ready."
export PGPASSWORD='pg!lol!2021'
until pg_isready -h postgres -d postgres -U postgres --quiet; do
  echo "PostgreSQL is unavailable, sleep 1s."
  sleep 1
done
echo "PostgreSQL is ready."
