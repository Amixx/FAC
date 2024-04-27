#!/bin/bash
npm run build
export NITRO_SSL_CERT="`cat ./certs/thesis-project.local.io.pem`"
export NITRO_SSL_KEY="`cat ./certs/thesis-project.local.io-key.pem`"
export PORT=8000
exec node .output/server/index.mjs