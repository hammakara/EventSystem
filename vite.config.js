import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    build: {
        // Enable CSS code splitting
        cssCodeSplit: true,
        // Rollup optimization options
        rollupOptions: {
            output: {
                // Manual chunks for better caching
                manualChunks: {
                    // Vendor chunks
                    alpine: ['alpinejs'],
                    animate: ['animate.css'],
                },
                // Asset file naming for better caching
                assetFileNames: (assetInfo) => {
                    const info = assetInfo.name.split('.');
                    const extType = info[info.length - 1];
                    if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)) {
                        return `images/[name]-[hash][extname]`;
                    }
                    if (/woff2?|eot|ttf|otf/i.test(extType)) {
                        return `fonts/[name]-[hash][extname]`;
                    }
                    return `assets/[name]-[hash][extname]`;
                },
                chunkFileNames: 'js/[name]-[hash].js',
                entryFileNames: 'js/[name]-[hash].js',
            },
        },
        // Minification options
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
            },
        },
        // Source maps for debugging (disable in production)
        sourcemap: process.env.NODE_ENV !== 'production',
        // Target modern browsers
        target: ['es2020', 'chrome80', 'firefox78', 'safari14'],
    },
    // Optimization options
    optimizeDeps: {
        include: ['alpinejs', 'animate.css'],
    },
    // CSS optimization
    css: {
        devSourcemap: process.env.NODE_ENV !== 'production',
    },
});
