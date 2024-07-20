import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig(({ mode }) => {
	const env = loadEnv(mode, process.cwd(), "");
	return {
		plugins: [
			laravel({
				input: ["resources/css/app.css", "resources/js/app.js"],
				refresh: true,
			}),
		],
		server: {
			hmr: {
				host: "localhost",
			},
			host: env.VITE_SERVER_HOST,
			port: env.VITE_SERVER_PORT,
		},
	};
});
