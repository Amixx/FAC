#!/bin/bash

if [ -z "$1" ]; then
  echo "Usage: $0 <type>"
  exit 1
fi

type="$1"

case "$type" in
  t-ssr|spa|m-ssr|ssg|hda) ;;
  *) echo "Error: Invalid type. Supported types are t-ssr, spa, m-ssr, ssg, or hda." >&2
     exit 1 ;;
esac

# Define suffixes
suffixes=(
  ""
  "about-us"
  "news"
  "news"
  "offers"
  "contacts"
)

# Create directory if not exists
mkdir -p "./results-data/$type"

base_url="https://thesis-project.local.io"
if [ "$type" == "spa" ] || [ "$type" == "m-ssr" ] || [ "$type" == "ssg" ]; then
  base_url+=":8000/"
else
  base_url+=":443/"
fi

run_lighthouse() {
  local suffix="$1"
  url="$base_url$suffix"
  echo "Running Lighthouse for URL: $url"
  npx -y lighthouse "$url" \
   --output=json \
   --output-path=./results-data/"$type"/"${suffix:-home}".json \
   --only-categories=performance
#   --throttling.rttMs=80 \
#   --throttling.throughputKbps=4096
}

# Run Lighthouse script for each URL in parallel
for suffix in "${suffixes[@]}"; do
  run_lighthouse "$suffix"
done

# Wait for all background processes to finish
wait

echo "All Lighthouse tests completed."