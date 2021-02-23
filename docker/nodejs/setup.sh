#!/bin/bash

cd /backend/realtime_server && yarn
cd /frontend/chat_client && yarn

cd /backend/realtime_server && yarn start:dev >&2 &
cd /frontend/chat_client && npx quasar dev >&2 &

echo "realtime server is ready" >&2