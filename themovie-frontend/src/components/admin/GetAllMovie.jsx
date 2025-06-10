"use client";
import React, { useEffect, useState } from "react";
import Link from "next/link";
import Image from "next/image";

export const CreateMovie = () => {
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

    return (
        <div className="min-h-screen bg-gray-900 text-white">
            <nav className="p-4 bg-gray-800 flex justify-between">
                <h1 className="text-2xl font-bold">The Movie</h1>
                <div>
                    <Link href="/movies">
                        <span className="mr-4 cursor-pointer hover:text-gray-300">
                            Movies
                        </span>
                    </Link>
                    <Link href="/login">
                        <span className="cursor-pointer hover:text-gray-300">
                            Login
                        </span>
                    </Link>
                </div>
            </nav>

            <header className="text-center py-20 bg-gray-700">
                <h2 className="text-4xl font-bold">Discover the Best Movies</h2>
                <p className="mt-2 text-gray-300">
                    Buy & Review the latest movies
                </p>
                <Link href="/movies">
                    <button className="mt-4 px-6 py-2 bg-blue-500 hover:bg-blue-600 rounded">
                        Explore Now
                    </button>
                </Link>
            </header>

            <section className="p-6">
                <h3 className="text-2xl font-bold mb-4">Popular Movies</h3>
                <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                    {movies && movies.length > 0 ? (
                        movies.map((movie) => (
                            <div
                                key={movie.id}
                                className="bg-gray-800 p-3 rounded"
                            >
                                <div className="w-full relative overflow-hidden">
                                <Image
                                    src={`${process.env.NEXT_PUBLIC_IMAGE_URL}/storage/${movie.poster}`}
                                    alt={movie.title}
                                    width='0'
                                    height='0'
                                    layout="responsive"
                                    className="w-full h-auto object-contain rounded"

                                />
                                </div>
                                <h4 className="mt-2 font-bold">
                                    {movie.title}
                                </h4>
                                <p className="text-sm text-gray-400">
                                    {movie.genre}
                                </p>
                                <p className="text-sm text-yellow-400">
                                    ⭐ {movie.review_rating}
                                </p>
                                <Link href={`/movies/${movie.id}`}>
                                    <button className="mt-2 w-full py-1 bg-blue-500 hover:bg-blue-600 rounded">
                                        View Details
                                    </button>
                                </Link>
                            </div>
                        ))
                    ) : (
                        <p>No movies available.</p>
                    )}
                </div>
            </section>

            <footer className="text-center p-4 bg-gray-800">
                <p>&copy; 2025 The Movie. All rights reserved.</p>
            </footer>
        </div>
    );
};
