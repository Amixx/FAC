#!/bin/bash

if [ -z "$1" ] || [ -z "$2" ]; then
  echo "Usage: $0 <site> <type>"
  exit 1
fi

site="$1"

case "$site" in
  content-platform|shopping-platform) ;;
  *) echo "Error: Invalid site. Supported sites are content-platform, shopping-platform." >&2
     exit 1 ;;
esac

if [ "$site" == "content-platform" ]; then
  # Define pages
  pages=(
    ""
    "about-us"
    "news"
    "offers"
    "contacts"
  )
fi
if [ "$site" == "shopping-platform" ]; then
  # Define pages
  pages=(
    ""
    "catalogue"
    "cart"
    "checkout"
  )
fi

mkdir -p "./results-data/$site"

type="$2"

case "$type" in
  t-ssr|spa|m-ssr|ssg|hda|all) ;;
  *) echo "Error: Invalid type. Supported types are t-ssr, spa, m-ssr, ssg, hda, or all." >&2
     exit 1 ;;
esac

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

if [ "$type" == "all" ]; then
  # Run Lighthouse script for all types
  for current_type in "t-ssr" "spa" "m-ssr" "ssg" "hda"; do
    for page in "${pages[@]}"; do
      run_lighthouse "$current_type" "$page"
    done
  done
else
  # Run Lighthouse script for the specified type
  for page in "${pages[@]}"; do
    run_lighthouse "$type" "$page"
  done
fi

# Wait for all background processes to finish
wait

echo "All Lighthouse tests completed."
