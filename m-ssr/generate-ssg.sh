#!/bin/bash
if [ -f .env ]; then
    export $(cat .env | xargs)
fi

export NITRO_SSL_CERT="$(cat $NITRO_SSL_CERT_PATH)"
export NITRO_SSL_KEY="$(cat $NITRO_SSL_KEY_PATH)"

if [ "$APP_DIR" != "content-platform" ] && [ "$APP_DIR" != "entertainment-platform" ]; then
    echo "Only content platforms and entertainment platforms can be statically generated!"
    exit 1
fi

cd "$APP_DIR" && npm i --omit=dev && npm run generate