import React from 'react';
import AppLayout from '@/components/app-layout';

import { Head } from '@inertiajs/react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface DashboardProps {
    user: {
        id: number;
        name: string;
        email: string;
        role: 'admin' | 'officer' | 'employee';
        [key: string]: unknown;
    };
    stats: Record<string, number>;
}



export default function Dashboard({ user, stats }: DashboardProps) {
    const getRoleGreeting = () => {
        switch (user.role) {
            case 'admin':
                return { greeting: '👑 Selamat datang, Administrator!', description: 'Kelola seluruh sistem arsip digital' };
            case 'officer':
                return { greeting: '🛡️ Selamat datang, Petugas!', description: 'Kelola peminjaman dan pengembalian arsip' };
            case 'employee':
                return { greeting: '👤 Selamat datang, Pegawai!', description: 'Ajukan peminjaman arsip yang dibutuhkan' };
            default:
                return { greeting: 'Selamat datang!', description: 'Sistem Peminjaman Arsip Digital' };
        }
    };

    const { greeting, description } = getRoleGreeting();

    const getStatsCards = () => {
        switch (user.role) {
            case 'admin':
                return [
                    { title: '👥 Total Pengguna', value: stats.total_users, color: 'bg-blue-500' },
                    { title: '📁 Total Arsip', value: stats.total_archives, color: 'bg-green-500' },
                    { title: '📋 Total Peminjaman', value: stats.total_borrowings, color: 'bg-purple-500' },
                    { title: '⏳ Menunggu Persetujuan', value: stats.pending_borrowings, color: 'bg-yellow-500' },
                    { title: '⚠️ Terlambat', value: stats.overdue_borrowings, color: 'bg-red-500' },
                    { title: '✅ Arsip Tersedia', value: stats.available_archives, color: 'bg-emerald-500' },
                    { title: '📤 Arsip Dipinjam', value: stats.borrowed_archives, color: 'bg-orange-500' },
                ];
            case 'officer':
                return [
                    { title: '📁 Total Arsip', value: stats.total_archives, color: 'bg-green-500' },
                    { title: '📋 Total Peminjaman', value: stats.total_borrowings, color: 'bg-purple-500' },
                    { title: '⏳ Menunggu Persetujuan', value: stats.pending_borrowings, color: 'bg-yellow-500' },
                    { title: '⚠️ Terlambat', value: stats.overdue_borrowings, color: 'bg-red-500' },
                    { title: '✅ Arsip Tersedia', value: stats.available_archives, color: 'bg-emerald-500' },
                    { title: '📤 Arsip Dipinjam', value: stats.borrowed_archives, color: 'bg-orange-500' },
                ];
            case 'employee':
                return [
                    { title: '📋 Peminjaman Saya', value: stats.my_borrowings, color: 'bg-blue-500' },
                    { title: '⏳ Menunggu Persetujuan', value: stats.pending_borrowings, color: 'bg-yellow-500' },
                    { title: '📤 Sedang Dipinjam', value: stats.active_borrowings, color: 'bg-purple-500' },
                    { title: '⚠️ Terlambat', value: stats.overdue_borrowings, color: 'bg-red-500' },
                    { title: '📁 Arsip Tersedia', value: stats.total_archives, color: 'bg-green-500' },
                ];
            default:
                return [];
        }
    };

    const statsCards = getStatsCards();

    return (
        <AppLayout>
            <Head title="Dashboard" />
            
            <div className="flex h-full flex-1 flex-col gap-6 p-6">
                {/* Welcome Section */}
                <div className="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl p-8 text-white">
                    <h1 className="text-3xl font-bold mb-2">{greeting}</h1>
                    <p className="text-lg opacity-90">{description}</p>
                    <div className="mt-4 flex items-center space-x-4 text-sm">
                        <span className="bg-white/20 px-3 py-1 rounded-full">
                            {user.name}
                        </span>
                        <span className="bg-white/20 px-3 py-1 rounded-full capitalize">
                            {user.role}
                        </span>
                    </div>
                </div>

                {/* Statistics Cards */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    {statsCards.map((card, index) => (
                        <Card key={index} className="hover:shadow-lg transition-shadow">
                            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                <CardTitle className="text-sm font-medium text-gray-600">
                                    {card.title}
                                </CardTitle>
                                <div className={`w-4 h-4 rounded ${card.color}`} />
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold">{card.value}</div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Quick Actions */}
                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    {user.role === 'admin' && (
                        <>
                            <Card className="hover:shadow-lg transition-shadow cursor-pointer" 
                                  onClick={() => window.location.href = '/archive-categories'}>
                                <CardHeader>
                                    <CardTitle className="flex items-center space-x-2">
                                        <span>🗂️</span>
                                        <span>Kelola Kategori Arsip</span>
                                    </CardTitle>
                                    <CardDescription>
                                        Tambah, edit, atau hapus kategori arsip
                                    </CardDescription>
                                </CardHeader>
                            </Card>
                            
                            <Card className="hover:shadow-lg transition-shadow cursor-pointer"
                                  onClick={() => window.location.href = '/archives'}>
                                <CardHeader>
                                    <CardTitle className="flex items-center space-x-2">
                                        <span>📁</span>
                                        <span>Kelola Arsip</span>
                                    </CardTitle>
                                    <CardDescription>
                                        Tambah, edit, atau hapus data arsip
                                    </CardDescription>
                                </CardHeader>
                            </Card>

                            <Card className="hover:shadow-lg transition-shadow cursor-pointer"
                                  onClick={() => window.location.href = '/borrowings'}>
                                <CardHeader>
                                    <CardTitle className="flex items-center space-x-2">
                                        <span>📋</span>
                                        <span>Kelola Peminjaman</span>
                                    </CardTitle>
                                    <CardDescription>
                                        Monitor dan kelola semua peminjaman
                                    </CardDescription>
                                </CardHeader>
                            </Card>
                        </>
                    )}

                    {user.role === 'officer' && (
                        <>
                            <Card className="hover:shadow-lg transition-shadow cursor-pointer"
                                  onClick={() => window.location.href = '/borrowings'}>
                                <CardHeader>
                                    <CardTitle className="flex items-center space-x-2">
                                        <span>📋</span>
                                        <span>Kelola Peminjaman</span>
                                    </CardTitle>
                                    <CardDescription>
                                        Setujui dan proses peminjaman arsip
                                    </CardDescription>
                                </CardHeader>
                            </Card>

                            <Card className="hover:shadow-lg transition-shadow cursor-pointer"
                                  onClick={() => window.location.href = '/archives'}>
                                <CardHeader>
                                    <CardTitle className="flex items-center space-x-2">
                                        <span>📁</span>
                                        <span>Kelola Arsip</span>
                                    </CardTitle>
                                    <CardDescription>
                                        Tambah dan edit data arsip
                                    </CardDescription>
                                </CardHeader>
                            </Card>

                            <Card className="hover:shadow-lg transition-shadow cursor-pointer"
                                  onClick={() => window.location.href = '/archive-categories'}>
                                <CardHeader>
                                    <CardTitle className="flex items-center space-x-2">
                                        <span>🗂️</span>
                                        <span>Kelola Kategori</span>
                                    </CardTitle>
                                    <CardDescription>
                                        Atur kategori arsip
                                    </CardDescription>
                                </CardHeader>
                            </Card>
                        </>
                    )}

                    {user.role === 'employee' && (
                        <>
                            <Card className="hover:shadow-lg transition-shadow cursor-pointer"
                                  onClick={() => window.location.href = '/borrowings/create'}>
                                <CardHeader>
                                    <CardTitle className="flex items-center space-x-2">
                                        <span>📝</span>
                                        <span>Ajukan Peminjaman</span>
                                    </CardTitle>
                                    <CardDescription>
                                        Buat pengajuan peminjaman arsip baru
                                    </CardDescription>
                                </CardHeader>
                            </Card>

                            <Card className="hover:shadow-lg transition-shadow cursor-pointer"
                                  onClick={() => window.location.href = '/borrowings'}>
                                <CardHeader>
                                    <CardTitle className="flex items-center space-x-2">
                                        <span>📜</span>
                                        <span>Riwayat Peminjaman</span>
                                    </CardTitle>
                                    <CardDescription>
                                        Lihat riwayat peminjaman Anda
                                    </CardDescription>
                                </CardHeader>
                            </Card>

                            <Card className="hover:shadow-lg transition-shadow cursor-pointer"
                                  onClick={() => window.location.href = '/archives'}>
                                <CardHeader>
                                    <CardTitle className="flex items-center space-x-2">
                                        <span>🔍</span>
                                        <span>Cari Arsip</span>
                                    </CardTitle>
                                    <CardDescription>
                                        Telusuri arsip yang tersedia
                                    </CardDescription>
                                </CardHeader>
                            </Card>
                        </>
                    )}
                </div>

                {/* Recent Activity or Notifications */}
                {(stats.pending_borrowings > 0 || stats.overdue_borrowings > 0) && (
                    <Card className="border-orange-200 bg-orange-50">
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2 text-orange-800">
                                <span>🔔</span>
                                <span>Notifikasi Penting</span>
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-2">
                            {stats.pending_borrowings > 0 && (
                                <p className="text-orange-700">
                                    ⏳ Ada {stats.pending_borrowings} peminjaman yang menunggu persetujuan
                                </p>
                            )}
                            {stats.overdue_borrowings > 0 && (
                                <p className="text-red-700">
                                    ⚠️ Ada {stats.overdue_borrowings} peminjaman yang terlambat dikembalikan
                                </p>
                            )}
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}