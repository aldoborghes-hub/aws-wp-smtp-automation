#!/bin/bash
# ---------------------------------------------------------------------
# Script: setup_wp_smtp.sh
# Author: Aldo Borghes
# Author URI: https://www.linkedin.com/in/aldo-borghes/
# Description: Automatiza la configuración SMTP en Bitnami WordPress
# ---------------------------------------------------------------------

set -e

if [ "$(id -u)" -ne 0 ]; then
  echo "Error: Este script debe ejecutarse como root." >&2
  exit 1
fi

if [ "$#" -lt 1 ]; then
  echo "Uso: $0 dominio_nuevo [from_email]" >&2
  exit 1
fi

NEW_DOMAIN="$1"
FROM_EMAIL="${2:-info@$1}"
DEST_ROOT="/opt/bitnami/sites/$NEW_DOMAIN/htdocs"
NEW_ENV="/etc/wp-smtp-${NEW_DOMAIN%%.*}.env"

echo "Configurando SMTP para $NEW_DOMAIN (Autor: Aldo Borghes)..."

# Lógica de copiado y permisos (similar a la que probamos hoy)
# ... [Aquí iría la lógica de tu script original con las mejoras de permisos]