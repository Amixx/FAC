#!/bin/bash
export NITRO_SSL_CERT="`cat ./certs/thesis-project.local.io.pem`"
export NITRO_SSL_KEY="`cat ./certs/thesis-project.local.io-key.pem`"
export PORT=8001
export VITE_API_BASE_URL="https://thesis-project.local.io/api/json"
export NODE_TLS_REJECT_UNAUTHORIZED=0

npm run build
exec node .output/server/index.mjs