#!/bin/bash

set -euo pipefail;

SCRIPT_RUN="sockets-server";
TARGET_DIR="$HOME/src/app/bin";

[[ ! -f "/usr/bin/${SCRIPT_RUN}.sh" ]] && sudo ln -s ${TARGET_DIR}/${SCRIPT_RUN}.sh /usr/bin/${SCRIPT_RUN}.sh;

sudo cp "$HOME/src/app/cfg/${SCRIPT_RUN}.service" "/etc/systemd/system/${SCRIPT_RUN}.service";

sudo systemctl daemon-reload && sudo systemctl enable ${SCRIPT_RUN}.service; 
sudo systemctl start ${SCRIPT_RUN}.service && sudo systemctl status ${SCRIPT_RUN}.service;
