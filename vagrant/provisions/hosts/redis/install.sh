#!/bin/bash

set -euo pipefail;

# Envs
export DEBIAN_FRONTEND=noninteractive; 
# Locales
locale-gen pl_PL pl_PL.UTF-8 en_US en_US.UTF-8 && dpkg-reconfigure locales;
# Packages
apt-get update && apt-get -y install net-tools acl iptables-persistent software-properties-common redis-server redis-tools;

