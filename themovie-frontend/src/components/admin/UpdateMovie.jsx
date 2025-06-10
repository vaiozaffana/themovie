"use client";

import { useState, useEffect, useRef } from "react";
import { motion, useScroll, useTransform } from "framer-motion";
import { gsap } from "gsap";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card, CardContent } from "@/components/ui/card";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import {
    ChevronDown,
    Search,
    Instagram,
    Twitter,
    Facebook,
    Mail,
    Phone,
} from "lucide-react";
import Image from "next/image";
import Link from "next/link";
import { useRouter } from "next/navigation";

export default function UpdateMovie() {
    const router = useRouter();
    const [movies, setMovies] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch(
                    "http://localhost:8000/api/movies"
                );
                const data = await response.json();
                setMovies(data.movies.data);
            } catch (error) {
                console.error("Error:", error);
            }
        };
        fetchData();
    }, []);

    const [isLoading, setIsLoading] = useState(true);
    const particlesRef = useRef(null);
    const headerRef = useRef(null);
    const featuresRef = useRef(null);
    const filmsRef = useRef(null);
    const { scrollY } = useScroll();
    const headerY = useTransform(scrollY, [0, 500], [0, 150]);
    const particlesY = useTransform(scrollY, [0, 500], [0, 250]);
    const featureCardsY = useTransform(scrollY, [300, 800], [100, 0]);
    const filmCardsScale = useTransform(scrollY, [800, 1300], [0.95, 1]);

    useEffect(() => {
        if (particlesRef.current) {
            const particles = particlesRef.current.children;

            gsap.to(particles, {
                y: "random(-100, 100)",
                x: "random(-100, 100)",
                opacity: "random(0.3, 0.7)",
                duration: "random(3, 7)",
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                stagger: 0.1,
            });
        }

        const timer = setTimeout(() => {
            setIsLoading(false);
        }, 1500);

        return () => {
            clearTimeout(timer);
        };
    }, []);

    return (
        <div className="min-h-screen bg-black text-white overflow-hidden">
            <nav className="fixed top-0 w-full z-50 backdrop-blur-md bg-black/70 border-b border-purple-500/30">
                <div className="container mx-auto px-4 py-4 flex justify-between items-center">
                    <motion.div
                        initial={{ opacity: 0, x: -20 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ duration: 0.5 }}
                        className="text-2xl font-bold"
                    >
                        <span className="bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-purple-600 drop-shadow-[0_0_5px_rgba(139,92,246,0.5)]">
                            CyberFlix
                        </span>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, x: 20 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ duration: 0.5, delay: 0.2 }}
                        className="flex gap-4"
                    >
                        <Button
                            variant="outline"
                            onClick={() => router.push("/Login")}
                            className="border-cyan-500 text-cyan-400 hover:bg-cyan-500/20 hover:text-cyan-300"
                        >
                            Login
                        </Button>
                        <Button className="bg-gradient-to-r from-purple-600 to-cyan-500 text-white shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 transition-all duration-300 border-0">
                            Register
                        </Button>
                    </motion.div>
                </div>
            </nav>

            <section
                ref={headerRef}
                className="relative h-screen flex items-center justify-center overflow-hidden pt-16"
            >
                <motion.div
                    style={{ y: headerY }}
                    className="absolute inset-0 bg-gradient-to-b from-black via-purple-900/20 to-black z-10"
                ></motion.div>

                <motion.div
                    ref={particlesRef}
                    style={{ y: particlesY }}
                    className="absolute inset-0 z-0"
                >
                    {[...Array(50)].map((_, i) => (
                        <motion.div
                            key={i}
                            className="absolute rounded-full"
                            style={{
                                width: Math.random() * 6 + 2 + "px",
                                height: Math.random() * 6 + 2 + "px",
                                left: Math.random() * 100 + "%",
                                top: Math.random() * 100 + "%",
                                backgroundColor: `rgba(${
                                    Math.random() * 100 + 155
                                }, ${Math.random() * 100}, ${
                                    Math.random() * 255
                                }, ${Math.random() * 0.5 + 0.2})`,
                                boxShadow: `0 0 ${
                                    Math.random() * 10 + 5
                                }px rgba(${Math.random() * 100 + 155}, ${
                                    Math.random() * 100
                                }, ${Math.random() * 255}, ${
                                    Math.random() * 0.5 + 0.3
                                })`,
                            }}
                        />
                    ))}
                </motion.div>

                <div className="container mx-auto px-4 z-20">
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.8, delay: 0.5 }}
                        className="text-center max-w-3xl mx-auto"
                    >
                        <h1 className="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                            <span className="block bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 via-purple-500 to-pink-500 drop-shadow-[0_0_10px_rgba(139,92,246,0.7)]">
                                Welcome to the Future of Cinema
                            </span>
                        </h1>
                        <p className="text-lg md:text-xl text-gray-300 mb-8">
                            Discover, stream, and own the most groundbreaking
                            films in stunning 4K quality
                        </p>
                        <motion.div
                            whileHover={{ scale: 1.05 }}
                            whileTap={{ scale: 0.95 }}
                        >
                            <Button
                                size="lg"
                                className="bg-gradient-to-r from-cyan-500 to-purple-600 text-white text-lg py-6 px-8 shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 transition-all duration-300 border-0"
                            >
                                Explore Now
                            </Button>
                        </motion.div>
                    </motion.div>
                </div>
            </section>

            <section
                ref={featuresRef}
                className="py-20 bg-gradient-to-b from-black via-purple-950/10 to-black"
            >
                <div className="container mx-auto px-4">
                    <motion.h2
                        initial={{ opacity: 0 }}
                        whileInView={{ opacity: 1 }}
                        transition={{ duration: 0.5 }}
                        viewport={{ once: true }}
                        className="text-3xl md:text-4xl font-bold text-center mb-16 bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-purple-500"
                    >
                        The Ultimate Film Experience
                    </motion.h2>

                    <motion.div
                        style={{ y: featureCardsY }}
                        className="grid grid-cols-1 md:grid-cols-3 gap-8"
                    >
                        {[
                            {
                                title: "4K Streaming",
                                icon: "🎬",
                                description:
                                    "Ultra-high definition streaming with no buffering",
                            },
                            {
                                title: "Exclusive Content",
                                icon: "🔒",
                                description:
                                    "Access films you won't find anywhere else",
                            },
                            {
                                title: "Affordable Prices",
                                icon: "💰",
                                description:
                                    "Premium content without the premium price tag",
                            },
                        ].map((feature, index) => (
                            <motion.div
                                key={index}
                                initial={{ opacity: 0, y: 20 }}
                                whileInView={{ opacity: 1, y: 0 }}
                                transition={{
                                    duration: 0.5,
                                    delay: index * 0.1,
                                }}
                                viewport={{ once: true }}
                                whileHover={{
                                    y: -10,
                                    transition: { duration: 0.2 },
                                }}
                            >
                                <Card className="bg-gradient-to-br from-gray-900 to-black border border-purple-500/30 shadow-xl shadow-purple-500/10 h-full">
                                    <CardContent className="text-center p-6 pt-6">
                                        <div className="text-4xl mb-4">
                                            {feature.icon}
                                        </div>
                                        <h3 className="text-xl font-bold mb-2 text-cyan-400">
                                            {feature.title}
                                        </h3>
                                        <p className="text-gray-400">
                                            {feature.description}
                                        </p>
                                    </CardContent>
                                </Card>
                            </motion.div>
                        ))}
                    </motion.div>
                </div>
            </section>

            <section ref={filmsRef} className="py-20 bg-black">
                <div className="container mx-auto px-4">
                    <motion.h2
                        initial={{ opacity: 0 }}
                        whileInView={{ opacity: 1 }}
                        transition={{ duration: 0.5 }}
                        viewport={{ once: true }}
                        className="text-3xl md:text-4xl font-bold text-center mb-16 bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-purple-500"
                    >
                        Discover Amazing Films
                    </motion.h2>

                    <div className="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                        <motion.div
                            initial={{ opacity: 0, x: -20 }}
                            whileInView={{ opacity: 1, x: 0 }}
                            transition={{ duration: 0.5 }}
                            viewport={{ once: true }}
                            className="w-full md:w-1/2 relative"
                        >
                            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-purple-400" />
                            <Input
                                className="h-12 pl-10 bg-black/50 border border-purple-500/50 hover:border-cyan-400/70 text-white"
                                placeholder="Search for films..."
                            />
                        </motion.div>

                        <motion.div
                            initial={{ opacity: 0, x: 20 }}
                            whileInView={{ opacity: 1, x: 0 }}
                            transition={{ duration: 0.5 }}
                            viewport={{ once: true }}
                            className="flex gap-4"
                        >
                            <DropdownMenu>
                                <DropdownMenuTrigger asChild>
                                    <Button
                                        variant="outline"
                                        className="bg-black/50 border border-purple-500/50 text-white"
                                    >
                                        Sort By{" "}
                                        <ChevronDown className="ml-2 h-4 w-4" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent className="bg-gray-900/90 backdrop-blur-md border border-purple-500/30">
                                    <DropdownMenuItem className="text-white hover:bg-purple-500/20">
                                        Newest
                                    </DropdownMenuItem>
                                    <DropdownMenuItem className="text-white hover:bg-purple-500/20">
                                        Most Popular
                                    </DropdownMenuItem>
                                    <DropdownMenuItem className="text-white hover:bg-purple-500/20">
                                        Highest Rated
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>

                            <DropdownMenu>
                                <DropdownMenuTrigger asChild>
                                    <Button
                                        variant="outline"
                                        className="bg-black/50 border border-purple-500/50 text-white"
                                    >
                                        Filter{" "}
                                        <ChevronDown className="ml-2 h-4 w-4" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent className="bg-gray-900/90 backdrop-blur-md border border-purple-500/30">
                                    <DropdownMenuItem className="text-white hover:bg-purple-500/20">
                                        Action
                                    </DropdownMenuItem>
                                    <DropdownMenuItem className="text-white hover:bg-purple-500/20">
                                        Sci-Fi
                                    </DropdownMenuItem>
                                    <DropdownMenuItem className="text-white hover:bg-purple-500/20">
                                        Thriller
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </motion.div>
                    </div>

                    <motion.div
                        style={{ scale: filmCardsScale }}
                        className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
                    >
                        {isLoading ? (
                            [...Array(6)].map((_, index) => (
                                <div
                                    key={index}
                                    className="rounded-lg overflow-hidden bg-gray-900/50 animate-pulse"
                                >
                                    <div className="w-full h-[400px] bg-gray-800/50"></div>
                                    <div className="p-4">
                                        <div className="h-5 bg-gray-800/50 rounded w-3/4 mb-2"></div>
                                        <div className="h-4 bg-gray-800/50 rounded w-1/2"></div>
                                    </div>
                                </div>
                            ))
                        ) : movies.length > 0 ? (
                            movies.map((movie, index) => (
                                <motion.div
                                    key={movie.id}
                                    initial={{ opacity: 0, scale: 0.9 }}
                                    whileInView={{ opacity: 1, scale: 1 }}
                                    transition={{
                                        duration: 0.5,
                                        delay: index * 0.1,
                                    }}
                                    viewport={{ once: true }}
                                    whileHover={{
                                        scale: 1.05,
                                        boxShadow:
                                            "0 0 20px rgba(139, 92, 246, 0.5)",
                                        transition: { duration: 0.2 },
                                    }}
                                    className="rounded-lg overflow-hidden bg-gray-900/50 border border-purple-500/20 transition-all duration-300"
                                >
                                    <div className="relative w-full h-[400px]">
                                        <Image
                                            src={`${process.env.NEXT_PUBLIC_IMAGE_URL}/storage/${movie.poster}`}
                                            alt={movie.title}
                                            fill
                                            className="object-cover"
                                        />
                                        <div className="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end">
                                            <div className="p-4 w-full">
                                                <Button className="w-full bg-gradient-to-r from-cyan-500 to-purple-600 text-white border-0">
                                                    Watch Now
                                                </Button>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="p-4">
                                        <h3 className="font-bold text-lg text-white">
                                            {movie.title}
                                        </h3>
                                        <p className="text-gray-400">
                                            {movie.year}
                                        </p>
                                    </div>
                                </motion.div>
                            ))
                        ) : (
                            <div className="text-white text-center w-full col-span-3 md:col-span-4 lg:col-span-6">
                                Tidak ada film yang tersedia atau gagal
                                mengambil data.
                            </div>
                        )}
                    </motion.div>

                    <div className="text-center mt-12">
                        <Button
                            variant="outline"
                            className="border-cyan-500 text-cyan-400 hover:bg-cyan-500/20 hover:text-cyan-300"
                            size="lg"
                        >
                            Load More
                        </Button>
                    </div>
                </div>
            </section>

            {/* Footer */}
            <footer className="py-12 bg-gradient-to-t from-black via-purple-950/10 to-black border-t border-purple-500/30">
                <div className="container mx-auto px-4">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 className="text-2xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-purple-600 drop-shadow-[0_0_5px_rgba(139,92,246,0.5)]">
                                CyberFlix
                            </h3>
                            <p className="text-gray-400 mb-4">
                                The future of cinema at your fingertips
                            </p>
                            <div className="flex space-x-4">
                                <motion.a
                                    href="#"
                                    whileHover={{ y: -5, color: "#E1306C" }}
                                    className="text-gray-400 hover:text-white transition-colors duration-300"
                                >
                                    <Instagram size={20} />
                                </motion.a>
                                <motion.a
                                    href="#"
                                    whileHover={{ y: -5, color: "#1DA1F2" }}
                                    className="text-gray-400 hover:text-white transition-colors duration-300"
                                >
                                    <Twitter size={20} />
                                </motion.a>
                                <motion.a
                                    href="#"
                                    whileHover={{ y: -5, color: "#4267B2" }}
                                    className="text-gray-400 hover:text-white transition-colors duration-300"
                                >
                                    <Facebook size={20} />
                                </motion.a>
                            </div>
                        </div>

                        <div>
                            <h4 className="text-lg font-bold mb-4 text-cyan-400">
                                Quick Links
                            </h4>
                            <ul className="space-y-2">
                                <li>
                                    <a
                                        href="#"
                                        className="text-gray-400 hover:text-cyan-400 transition-colors duration-300"
                                    >
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        className="text-gray-400 hover:text-cyan-400 transition-colors duration-300"
                                    >
                                        Browse Films
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        className="text-gray-400 hover:text-cyan-400 transition-colors duration-300"
                                    >
                                        Pricing
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        className="text-gray-400 hover:text-cyan-400 transition-colors duration-300"
                                    >
                                        About Us
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h4 className="text-lg font-bold mb-4 text-cyan-400">
                                Contact Us
                            </h4>
                            <div className="space-y-4">
                                <div className="flex items-center space-x-3">
                                    <Mail
                                        className="text-purple-500"
                                        size={18}
                                    />
                                    <span className="text-gray-400 hover:text-cyan-400 transition-colors duration-300">
                                        contact@cyberflix.com
                                    </span>
                                </div>
                                <div className="flex items-center space-x-3">
                                    <Phone
                                        className="text-purple-500"
                                        size={18}
                                    />
                                    <span className="text-gray-400 hover:text-cyan-400 transition-colors duration-300">
                                        +1 (888) 123-4567
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="border-t border-purple-500/30 mt-10 pt-6 text-center">
                        <p className="text-gray-500 text-sm">
                            © {new Date().getFullYear()} CyberFlix. All rights
                            reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    );
}
