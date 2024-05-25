import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
