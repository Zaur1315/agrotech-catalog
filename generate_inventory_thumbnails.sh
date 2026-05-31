#!/usr/bin/env bash

set -euo pipefail

PRODUCTS_DIR="storage/app/public/products"
THUMB_WIDTH=420
THUMB_HEIGHT=0
QUALITY=78

find "$PRODUCTS_DIR" -mindepth 2 -maxdepth 2 -type f -name '*.webp' \
    ! -name 'thumb_*' \
    | sort -V \
    | while read -r IMAGE_PATH; do
        DIR="$(dirname "$IMAGE_PATH")"
        FILE="$(basename "$IMAGE_PATH")"
        OUTPUT_PATH="$DIR/thumb_$FILE"

        if [ -f "$OUTPUT_PATH" ]; then
            echo "SKIP: $OUTPUT_PATH"
            continue
        fi

        echo "THUMB: $IMAGE_PATH -> $OUTPUT_PATH"

        cwebp -quiet -q "$QUALITY" -resize "$THUMB_WIDTH" "$THUMB_HEIGHT" "$IMAGE_PATH" -o "$OUTPUT_PATH"
    done

echo "Done."
