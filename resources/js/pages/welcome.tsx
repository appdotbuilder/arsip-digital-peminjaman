import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

export default function Welcome() {
    return (
        <>
            <Head title="Sistem Peminjaman Arsip Digital" />
            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
                {/* Header */}
                <header className="bg-white shadow-sm">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center py-6">
                            <div className="flex items-center space-x-3">
                                <div className="bg-blue-600 text-white w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg">
                                    📁
                                </div>
                                <h1 className="text-2xl font-bold text-gray-900">
                                    Sistem Arsip Digital
                                </h1>
                            </div>
                            <div className="space-x-4">
                                <Button asChild variant="outline">
                                    <Link href="/login">Masuk</Link>
                                </Button>
                                <Button asChild>
                                    <Link href="/register">Daftar</Link>
                                </Button>
                            </div>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    <div className="text-center mb-16">
                        <h2 className="text-5xl font-bold text-gray-900 mb-6">
                            📂 Sistem Peminjaman <br />
                            <span className="text-blue-600">Arsip Digital</span>
                        </h2>
                        <p className="text-xl text-gray-600 max-w-3xl mx-auto mb-8">
                            Platform komprehensif untuk mengelola peminjaman arsip digital dengan tiga peran pengguna: 
                            Admin, Pegawai, dan Petugas. Kelola arsip tanah, surat ukur, dan dokumen penting lainnya dengan mudah.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Button size="lg" asChild>
                                <Link href="/login" className="text-lg px-8 py-3">
                                    🚀 Mulai Sekarang
                                </Link>
                            </Button>
                            <Button size="lg" variant="outline" asChild>
                                <Link href="#features" className="text-lg px-8 py-3">
                                    📋 Lihat Fitur
                                </Link>
                            </Button>
                        </div>
                    </div>

                    {/* Features Section */}
                    <section id="features" className="mb-16">
                        <h3 className="text-3xl font-bold text-center text-gray-900 mb-12">
                            ✨ Fitur Utama
                        </h3>
                        <div className="grid md:grid-cols-3 gap-8">
                            {/* Admin Features */}
                            <div className="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                                <div className="bg-red-100 w-16 h-16 rounded-lg flex items-center justify-center mb-6 mx-auto">
                                    <span className="text-3xl">👑</span>
                                </div>
                                <h4 className="text-xl font-bold text-gray-900 mb-4 text-center">
                                    Peran Admin
                                </h4>
                                <ul className="space-y-3 text-gray-600">
                                    <li className="flex items-center">
                                        <span className="mr-3">👥</span>
                                        Manajemen semua akun pengguna
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">🗂️</span>
                                        Kelola kategori & data arsip
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">📊</span>
                                        Laporan harian, mingguan, bulanan
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">📈</span>
                                        Pemantauan aktivitas sistem
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">✅</span>
                                        Otorisasi khusus & persetujuan
                                    </li>
                                </ul>
                            </div>

                            {/* Officer Features */}
                            <div className="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                                <div className="bg-blue-100 w-16 h-16 rounded-lg flex items-center justify-center mb-6 mx-auto">
                                    <span className="text-3xl">🛡️</span>
                                </div>
                                <h4 className="text-xl font-bold text-gray-900 mb-4 text-center">
                                    Peran Petugas
                                </h4>
                                <ul className="space-y-3 text-gray-600">
                                    <li className="flex items-center">
                                        <span className="mr-3">📋</span>
                                        Validasi form peminjaman
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">🔄</span>
                                        Proses pengembalian arsip
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">📁</span>
                                        Kelola arsip & kategori
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">📑</span>
                                        Import data dari Excel
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">🔔</span>
                                        Notifikasi & peringatan
                                    </li>
                                </ul>
                            </div>

                            {/* Employee Features */}
                            <div className="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                                <div className="bg-green-100 w-16 h-16 rounded-lg flex items-center justify-center mb-6 mx-auto">
                                    <span className="text-3xl">👤</span>
                                </div>
                                <h4 className="text-xl font-bold text-gray-900 mb-4 text-center">
                                    Peran Pegawai
                                </h4>
                                <ul className="space-y-3 text-gray-600">
                                    <li className="flex items-center">
                                        <span className="mr-3">🛒</span>
                                        Keranjang arsip sementara
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">📝</span>
                                        Form peminjaman lengkap
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">📸</span>
                                        Upload foto peminjam
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">🖨️</span>
                                        Cetak bukti peminjaman
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-3">📜</span>
                                        Riwayat peminjaman pribadi
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    {/* Archive Types */}
                    <section className="mb-16">
                        <h3 className="text-3xl font-bold text-center text-gray-900 mb-12">
                            📋 Jenis Arsip
                        </h3>
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div className="bg-white rounded-lg shadow-md p-6 text-center">
                                <div className="bg-yellow-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4 mx-auto">
                                    <span className="text-2xl">📖</span>
                                </div>
                                <h4 className="font-semibold text-gray-900 mb-2">Buku Tanah</h4>
                                <p className="text-sm text-gray-600">
                                    HM, HGB, HGU, HP, HPL, HW, HMSRS, HT
                                </p>
                            </div>
                            <div className="bg-white rounded-lg shadow-md p-6 text-center">
                                <div className="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4 mx-auto">
                                    <span className="text-2xl">📏</span>
                                </div>
                                <h4 className="font-semibold text-gray-900 mb-2">Surat Ukur</h4>
                                <p className="text-sm text-gray-600">
                                    Dokumen pengukuran tanah
                                </p>
                            </div>
                            <div className="bg-white rounded-lg shadow-md p-6 text-center">
                                <div className="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4 mx-auto">
                                    <span className="text-2xl">🗺️</span>
                                </div>
                                <h4 className="font-semibold text-gray-900 mb-2">Gambar Ukur</h4>
                                <p className="text-sm text-gray-600">
                                    Peta dan sketsa tanah
                                </p>
                            </div>
                            <div className="bg-white rounded-lg shadow-md p-6 text-center">
                                <div className="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4 mx-auto">
                                    <span className="text-2xl">📄</span>
                                </div>
                                <h4 className="font-semibold text-gray-900 mb-2">Warkah</h4>
                                <p className="text-sm text-gray-600">
                                    Dokumen pendukung lainnya
                                </p>
                            </div>
                        </div>
                    </section>

                    {/* Coverage Area */}
                    <section className="mb-16">
                        <h3 className="text-3xl font-bold text-center text-gray-900 mb-8">
                            🗺️ Area Cakupan
                        </h3>
                        <div className="bg-white rounded-xl shadow-lg p-8">
                            <p className="text-center text-gray-600 mb-6">
                                Melayani seluruh wilayah Kabupaten Grobogan dengan 19 kecamatan:
                            </p>
                            <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 text-center">
                                {[
                                    'Brati', 'Gabus', 'Geyer', 'Godong', 'Grobogan',
                                    'Gubug', 'Karangrayung', 'Kedungjati', 'Klambu', 'Kradenan',
                                    'Ngaringan', 'Penawangan', 'Pulokulon', 'Purwodadi', 'Tanggungharjo',
                                    'Tawangharjo', 'Tegowanu', 'Toroh', 'Wirosari'
                                ].map((district) => (
                                    <div key={district} className="bg-gray-50 rounded-lg p-3">
                                        <span className="text-sm font-medium text-gray-700">
                                            {district}
                                        </span>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </section>

                    {/* CTA Section */}
                    <section className="text-center bg-blue-600 rounded-2xl p-12 text-white">
                        <h3 className="text-3xl font-bold mb-4">
                            🎯 Siap Mengelola Arsip Digital?
                        </h3>
                        <p className="text-xl mb-8 opacity-90">
                            Bergabunglah dengan sistem peminjaman arsip digital yang modern dan efisien
                        </p>
                        <div className="space-x-4">
                            <Button size="lg" variant="secondary" asChild>
                                <Link href="/login" className="text-lg px-8 py-3">
                                    🔑 Masuk Sekarang
                                </Link>
                            </Button>
                            <Button size="lg" variant="outline" asChild className="border-white text-white hover:bg-white hover:text-blue-600">
                                <Link href="/register" className="text-lg px-8 py-3">
                                    📝 Daftar Akun
                                </Link>
                            </Button>
                        </div>
                    </section>
                </main>

                {/* Footer */}
                <footer className="bg-gray-800 text-white py-12">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <div className="flex items-center justify-center space-x-3 mb-4">
                            <div className="bg-blue-600 text-white w-8 h-8 rounded-lg flex items-center justify-center font-bold">
                                📁
                            </div>
                            <span className="text-xl font-bold">Sistem Arsip Digital</span>
                        </div>
                        <p className="text-gray-400">
                            Platform peminjaman arsip digital yang komprehensif dan mudah digunakan
                        </p>
                        <div className="mt-6 pt-6 border-t border-gray-700">
                            <p className="text-gray-500">
                                © 2024 Sistem Peminjaman Arsip Digital. Semua hak dilindungi.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}