import { resolve } from "path";
import tailwindcss from "@tailwindcss/vite";

export default {
  plugins: [tailwindcss()],
  build: {
    outDir: resolve(__dirname, "dist"),
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname, "src/main.js"),
      },
    },
  },
  server: {
    origin: "http://localhost:5173",
    strictPort: true,
    port: 5173,
    // ** ADD THIS HEADERS OBJECT **
    headers: {
      "Access-Control-Allow-Origin": "*",
    },
  },
};
