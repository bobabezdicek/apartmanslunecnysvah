<?php

namespace App\Support;

class AdminContent
{
    public static function translationRows(): array
    {
        $translations = [
            'cs' => require base_path('lang/cs/site.php'),
            'en' => require base_path('lang/en/site.php'),
        ];

        $flattened = [
            'cs' => self::flatten($translations['cs']),
            'en' => self::flatten($translations['en']),
        ];

        $keys = array_values(array_unique([
            ...array_keys($flattened['cs']),
            ...array_keys($flattened['en']),
        ]));

        sort($keys);

        return array_map(fn (string $key) => [
            'key' => $key,
            'cs' => $flattened['cs'][$key] ?? '',
            'en' => $flattened['en'][$key] ?? '',
        ], $keys);
    }

    public static function mediaRows(): array
    {
        $galleryOrder = array_keys(config('site_media.gallery_order'));

        return collect(config('site_media.photos'))
            ->map(fn (array $photo, string $key) => [
                'key' => $key,
                'label' => $photo['label'],
                'path' => $photo['path'],
                'url' => asset($photo['path']),
                'used_in' => $photo['used_in'],
                'gallery_position' => array_search($key, $galleryOrder, true),
            ])
            ->sortBy(fn (array $photo) => $photo['gallery_position'] === false ? 999 : $photo['gallery_position'])
            ->values()
            ->all();
    }

    private static function flatten(array $items, string $prefix = ''): array
    {
        $flat = [];

        foreach ($items as $key => $value) {
            $path = $prefix === '' ? (string) $key : $prefix.'.'.$key;

            if (is_array($value)) {
                $flat += self::flatten($value, $path);

                continue;
            }

            if (is_scalar($value) || $value === null) {
                $flat[$path] = (string) $value;
            }
        }

        return $flat;
    }
}
