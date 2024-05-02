#!/bin/bash

if [ -z "$1" ] || [ -z "$2" ]; then
  echo "Usage: $0 <site> <types>"
  exit 1
fi

site="$1"

case "$site" in
  content-platform|shopping-platform) ;;
  *) echo "Error: Invalid site. Supported sites are content-platform, shopping-platform." >&2
     exit 1 ;;
esac

# Define pages based on the site
if [ "$site" == "content-platform" ]; then
  pages=(
    ""
    "about-us"
    "news"
    "offers"
    "contacts"
  )
elif [ "$site" == "shopping-platform" ]; then
  pages=(
    ""
    "catalogue"
    "cart"
    "checkout"
  )
fi

mkdir -p "./results-data/$site"

# Split the types passed as a comma-separated string
IFS=',' read -ra types <<< "$2"

# Validate each type
for type in "${types[@]}"; do
  case "$type" in
    t-ssr|spa|m-ssr|ssg|hda) ;;
    *) echo "Error: Invalid type $type. Supported types are t-ssr, hda, spa, m-ssr and ssg." >&2
       exit 1 ;;
  esac
done

base_url="https://thesis-project.local.io"

run_lighthouse() {
  local type="$1"
  local page="$2"

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

  results_dir="./results-data/$site/$type"
  mkdir -p "$results_dir"

  url="$url$page"
  echo "Running Lighthouse for URL: $url"
  npx -y lighthouse "$url" \
   --output=json \
   --output-path="$results_dir"/"${page:-home}".json \
   --only-categories=performance
#   --throttling.rttMs=80 \
#   --throttling.throughputKbps=4096
}

# Run Lighthouse script for each specified type
for type in "${types[@]}"; do
  for page in "${pages[@]}"; do
    run_lighthouse "$type" "$page"
  done
done

echo "All Lighthouse tests completed."
