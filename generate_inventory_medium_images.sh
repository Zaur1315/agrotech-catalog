#!/usr/bin/env bash

set -euo pipefail

PRODUCTS_DIR="storage/app/public/products"
MEDIUM_WIDTH=1200
MEDIUM_HEIGHT=0
QUALITY=82

if ! command -v cwebp >/dev/null 2>&1; then
    echo "cwebp is not installed."
    echo "Install it with: sudo apt install webp"
    exit 1
fi

if [ ! -d "$PRODUCTS_DIR" ]; then
    echo "Products directory not found: $PRODUCTS_DIR"
    exit 1
fi

find "$PRODUCTS_DIR" -type f -name '*.webp' \
    ! -name 'thumb_*.webp' \
    ! -name 'medium_*.webp' \
    | sort \
    | while read -r IMAGE_PATH; do
        DIR="$(dirname "$IMAGE_PATH")"
        FILE="$(basename "$IMAGE_PATH")"
        OUTPUT_PATH="$DIR/medium_$FILE"

        if [ -f "$OUTPUT_PATH" ]; then
            echo "Skip existing: $OUTPUT_PATH"
            continue
        fi

        echo "Creating medium: $OUTPUT_PATH"

        cwebp -quiet -q "$QUALITY" -resize "$MEDIUM_WIDTH" "$MEDIUM_HEIGHT" "$IMAGE_PATH" -o "$OUTPUT_PATH"
    done

echo "Done."
