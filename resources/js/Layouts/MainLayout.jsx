import React, { useState, useEffect } from 'react';
import { Link, usePage } from '@inertiajs/react';
import { ShoppingCart, User, Menu, X, Search, LogOut, ChevronDown, Package, Clock, CreditCard } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export default function MainLayout({ children }) {
    const { auth, flash, cartCount = 0 } = usePage().props;
    const [isMenuOpen, setIsMenuOpen] = useState(false);
    const [isScrolled, setIsScrolled] = useState(false);
    const [isProfileOpen, setIsProfileOpen] = useState(false);

    useEffect(() => {
        const handleScroll = () => setIsScrolled(window.scrollY > 20);
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    return (
        <div className="min-h-screen bg-slate-50 font-sans selection:bg-indigo-100 selection:text-indigo-900">
            {/* Navigation */}
            <nav className={cn(
                "fixed top-0 w-full z-50 transition-all duration-500",
                isScrolled ? "bg-white/80 backdrop-blur-xl shadow-sm h-16" : "bg-transparent h-24"
            )}>
                <div className="container mx-auto px-6 h-full flex items-center justify-between">
                    {/* Logo */}
                    <Link href="/" className="flex items-center space-x-2 group">
                        <div className="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center rotate-3 group-hover:rotate-12 transition-transform duration-300 shadow-indigo-200 shadow-lg">
                            <Package className="text-white w-6 h-6 -rotate-3 group-hover:-rotate-12 transition-transform duration-300" />
                        </div>
                        <span className="text-2xl font-black tracking-tight text-slate-900 uppercase italic">
                            Ecommerce<span className="text-indigo-600">Pro</span>
                        </span>
                    </Link>

                    {/* Desktop Menu */}
                    <div className="hidden md:flex items-center space-x-8">
                        {['Home', 'Products', 'Orders'].map((item) => (
                            <Link
                                key={item}
                                href={item === 'Home' ? '/' : `/${item.toLowerCase()}`}
                                className="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors uppercase tracking-widest relative group"
                            >
                                {item}
                                <span className="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300" />
                            </Link>
                        ))}
                    </div>

                    {/* Actions */}
                    <div className="flex items-center space-x-4">
                        <button className="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-all">
                            <Search className="w-5 h-5" />
                        </button>

                        <Link href="/show_cart" className="relative p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-all group">
                            <ShoppingCart className="w-5 h-5" />
                            {cartCount > 0 && (
                                <span className="absolute -top-1 -right-1 bg-rose-500 text-white text-[10px] font-black w-4 h-4 rounded-full flex items-center justify-center border-2 border-white animate-bounce-slow">
                                    {cartCount}
                                </span>
                            )}
                        </Link>

                        {auth.user ? (
                            <div className="relative">
                                <button
                                    onClick={() => setIsProfileOpen(!isProfileOpen)}
                                    className="flex items-center space-x-2 p-1 pl-3 bg-white border border-slate-100 rounded-full shadow-sm hover:shadow-md transition-all active:scale-95"
                                >
                                    <span className="text-xs font-black text-slate-700 uppercase tracking-tighter truncate max-w-[80px]">
                                        {auth.user.name}
                                    </span>
                                    <div className="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-xs">
                                        {auth.user.name[0]}
                                    </div>
                                </button>

                                <AnimatePresence>
                                    {isProfileOpen && (
                                        <motion.div
                                            initial={{ opacity: 0, scale: 0.95, y: 10 }}
                                            animate={{ opacity: 1, scale: 1, y: 0 }}
                                            exit={{ opacity: 0, scale: 0.95, y: 10 }}
                                            className="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl shadow-indigo-100 border border-slate-50 overflow-hidden"
                                        >
                                            <div className="p-4 bg-slate-50 border-b border-slate-100">
                                                <p className="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Signed in as</p>
                                                <p className="text-sm font-bold text-slate-900 truncate">{auth.user.email}</p>
                                            </div>
                                            <div className="p-2">
                                                <Link href="/profile" className="flex items-center space-x-3 px-3 py-2 text-sm font-bold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                                                    <User className="w-4 h-4" /> <span>Profile Settings</span>
                                                </Link>
                                                <Link href="/show_order" className="flex items-center space-x-3 px-3 py-2 text-sm font-bold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                                                    <Clock className="w-4 h-4" /> <span>My Orders</span>
                                                </Link>
                                            </div>
                                            <div className="p-2 bg-slate-50">
                                                <Link href="/logout" method="post" as="button" className="w-full flex items-center space-x-3 px-3 py-2 text-sm font-bold text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                                    <LogOut className="w-4 h-4" /> <span>Sign Out</span>
                                                </Link>
                                            </div>
                                        </motion.div>
                                    )}
                                </AnimatePresence>
                            </div>
                        ) : (
                            <div className="hidden md:flex items-center space-x-4">
                                <Link href="/login" className="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors uppercase tracking-widest">Login</Link>
                                <Link href="/register" className="px-6 py-2.5 bg-indigo-600 text-white text-sm font-black rounded-full shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95 transition-all uppercase tracking-widest">Join</Link>
                            </div>
                        )}

                        <button
                            className="md:hidden p-2 text-slate-500"
                            onClick={() => setIsMenuOpen(!isMenuOpen)}
                        >
                            {isMenuOpen ? <X /> : <Menu />}
                        </button>
                    </div>
                </div>
            </nav>

            {/* Main Content */}
            <motion.main
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5 }}
                className="pt-24 min-h-screen"
            >
                {children}
            </motion.main>

            {/* Footer */}
            <footer className="bg-slate-900 pt-24 pb-12 overflow-hidden">
                <div className="container mx-auto px-6">
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
                        <div className="col-span-1 md:col-span-2 space-y-8">
                            <Link href="/" className="flex items-center space-x-2 group">
                                <div className="w-12 h-12 bg-white rounded-xl flex items-center justify-center rotate-3 group-hover:rotate-12 transition-transform duration-300">
                                    <Package className="text-slate-900 w-7 h-7 -rotate-3 group-hover:-rotate-12 transition-transform duration-300" />
                                </div>
                                <span className="text-3xl font-black tracking-tight text-white uppercase italic">
                                    Ecommerce<span className="text-indigo-400">Pro</span>
                                </span>
                            </Link>
                            <p className="text-slate-400 text-lg leading-relaxed max-w-sm">
                                Elevating everyday style with premium quality fashion. Discovered by trendsetters, delivered to your door.
                            </p>
                        </div>
                        <div>
                            <h4 className="text-white font-black uppercase tracking-widest mb-8 italic">Quick Links</h4>
                            <ul className="space-y-4 text-slate-400 font-bold">
                                {['Home', 'Products', 'Collections', 'About Us', 'Contact'].map(link => (
                                    <li key={link}><a href="#" className="hover:text-indigo-400 transition-colors uppercase tracking-tighter text-sm">{link}</a></li>
                                ))}
                            </ul>
                        </div>
                        <div>
                            <h4 className="text-white font-black uppercase tracking-widest mb-8 italic">Newsletter</h4>
                            <div className="space-y-4">
                                <p className="text-sm text-slate-400 font-bold uppercase tracking-tighter">Get exclusive early access to drops.</p>
                                <div className="flex bg-slate-800 rounded-full p-1.5 border border-slate-700 focus-within:border-indigo-500 transition-all">
                                    <input type="email" placeholder="Your Email" className="bg-transparent border-none focus:ring-0 text-white text-sm flex-1 px-4" />
                                    <button className="bg-indigo-600 text-white px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest hover:bg-indigo-500 transition-colors">Join</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 text-xs font-black text-slate-500 uppercase tracking-widest">
                        <p>© {new Date().getFullYear()} EcommercePro. Built with passion by Abdullah Al Noman khan.</p>
                        <div className="flex space-x-8">
                            <a href="#" className="hover:text-white transition-colors">Privacy</a>
                            <a href="#" className="hover:text-white transition-colors">Terms</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    );
}
