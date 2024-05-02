#!/bin/bash
if [ -f .env ]; then
    export $(cat .env | xargs)
fi

export NITRO_SSL_CERT="$(cat $NITRO_SSL_CERT_PATH)"
export NITRO_SSL_KEY="$(cat $NITRO_SSL_KEY_PATH)"

cd "$APP_DIR" && npm i --omit=dev && npm run generate