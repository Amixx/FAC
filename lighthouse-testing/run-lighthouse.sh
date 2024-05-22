#!/bin/bash

if [ -z "$1" ] || [ -z "$2" ]; then
  echo "Usage: $0 <site> <types>"
  exit 1
fi

site="$1"

case "$site" in
  content-platform|shopping-platform|productivity-tool|entertainment-platform|social-network) ;;
  *) echo "Error: Invalid site. Supported sites are content-platform, shopping-platform, entertainment-platform and productivity-tool." >&2
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
elif [ "$site" == "productivity-tool" ]; then
  pages=(
    "authenticate"
    "todos"
    "todo-categories"
    "spent-times"
  )
elif [ "$site" == "entertainment-platform" ]; then
  pages=(
    "authenticate"
    ""
    "video/1"
  )
elif [ "$site" == "social-network" ]; then
  pages=(
    "authenticate"
    "posts"
    "posts/new"
    "user/21"
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
  local encoded_page=$(echo "$page" | jq -sRr @uri)

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
   # Run the test 5 times to get a more accurate result
  for run in {1..5}; do
    npx -y lighthouse "$url" \
     --output=json \
     --output-path="$results_dir"/"${encoded_page:-home}"_"$run".json \
     --only-categories=performance \
     --chrome-flags="--headless"
  done
}

# Run Lighthouse script for each specified type
for type in "${types[@]}"; do
  for page in "${pages[@]}"; do
    run_lighthouse "$type" "$page"
  done
done

echo "All Lighthouse tests completed."
