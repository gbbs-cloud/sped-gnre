<?php

$directory = __DIR__; // Change to target dir if needed

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($directory)
);

foreach ($files as $file) {
    if (
        $file->isFile() &&
        $file->getExtension() === 'php'
    ) {
        $path = $file->getRealPath();
        $contents = file_get_contents($path);

        // Skip if already has strict_types
        if (preg_match('/declare\s*\(\s*strict_types\s*=\s*1\s*\)\s*;/', $contents)) {
            continue;
        }

        // Match "<?php" and insert strict_types right after
        if (preg_match('/^<\?php\b/', $contents)) {
            $newContents = preg_replace(
                '/^<\?php\b/',
                "<?php\ndeclare(strict_types=1);\n",
                $contents
            );

            if ($newContents !== $contents) {
                file_put_contents($path, $newContents);
                echo "Updated: $path\n";
            }
        }
    }
}
