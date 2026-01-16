#!/bin/bash

# Wait for the server to start
sleep 10

while true
do
  URL="${KEEP_ALIVE_URL:-$RENDER_EXTERNAL_URL}"
  if [ ! -z "$URL" ]; then
    echo "Pinging $URL/up to keep instance awake..."
    curl -s "$URL/up" > /dev/null
  else
    echo "Neither KEEP_ALIVE_URL nor RENDER_EXTERNAL_URL is set. Skipping ping."
  fi
  # Sleep for 10 minutes (600 seconds)
  sleep 600
done
