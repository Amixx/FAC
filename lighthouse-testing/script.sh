#!/bin/bash

if [ -z "$1" ]; then
  echo "Usage: $0 <type>"
  exit 1
fi

type="$1"

case "$type" in
  t-ssr|spa|m-ssr|ssg|hda|all) ;;
  *) echo "Error: Invalid type. Supported types are t-ssr, spa, m-ssr, ssg, hda, or all." >&2
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

base_url="https://thesis-project.local.io"

run_lighthouse() {
  local type="$1"
  local suffix="$2"

  url="$base_url"
  if [ "$type" == "spa" ]; then
    url+=":8000/"
  elif [ "$type" == "m-ssr" ]; then
    url+=":8001/"
  elif [ "$type" == "ssg" ]; then
    url+=":8002/"
  else
    url+=":443/"
  fi

  mkdir -p "./results-data/$type"

  url="$url$suffix"
  echo "Running Lighthouse for URL: $url"
  npx -y lighthouse "$url" \
   --output=json \
   --output-path=./results-data/"$type"/"${suffix:-home}".json \
   --only-categories=performance
#   --throttling.rttMs=80 \
#   --throttling.throughputKbps=4096
}

if [ "$type" == "all" ]; then
  # Run Lighthouse script for all types
  for current_type in "t-ssr" "spa" "m-ssr" "ssg" "hda"; do
    for suffix in "${suffixes[@]}"; do
      run_lighthouse "$current_type" "$suffix"
    done
  done
else
  # Run Lighthouse script for the specified type
  for suffix in "${suffixes[@]}"; do
    run_lighthouse "$type" "$suffix"
  done
fi

# Wait for all background processes to finish
wait

echo "All Lighthouse tests completed."
