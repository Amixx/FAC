#!/bin/bash

if [ -z "$1" ]; then
  echo "Usage: $0 <type>"
  exit 1
fi

type="$1"

# Define suffixes
suffixes=(
  ""
  "about-us"
  "news"
  "news"
  "offers"
  "contacts"
)

base_url="https://thesis-project.local.io"
if [ "$type" == "spa" ] || [ "$type" == "m-ssr" ]; then
  base_url+=":8000/"
else
  base_url+=":443/"
fi

run_lighthouse() {
  local suffix="$1"
  url="$base_url$suffix"
  echo "Running Lighthouse for URL: $url"
  npx -y lighthouse "$url" --preset=desktop --output-path=./data/"$type"/lighthouse-results-"$suffix".html --only-categories=performance
}

# Run Lighthouse script for each URL in parallel
for suffix in "${suffixes[@]}"; do
  run_lighthouse "$suffix"
done

# Wait for all background processes to finish
wait

echo "All Lighthouse tests completed."