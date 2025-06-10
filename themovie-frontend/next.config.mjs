/** @type {import('next').NextConfig} */
export const nextConfig = {
    reactStrictMode: true,
    images: {
        remotePatterns: [
            {
                protocol: "http",
                hostname: "localhost",
                port: "8000",
                pathname: "/storage/posters/**",
            },
        ],
    },
};

export default nextConfig;
