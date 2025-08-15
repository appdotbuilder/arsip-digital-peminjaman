import React from 'react';
import { AppShell } from '@/components/app-shell';
import { AppHeader } from '@/components/app-header';
import { AppSidebar } from '@/components/app-sidebar';
import { AppContent } from '@/components/app-content';


interface AppLayoutProps {
    children: React.ReactNode;
    variant?: 'header' | 'sidebar';
}

export default function AppLayout({ children, variant = 'sidebar' }: AppLayoutProps) {
    if (variant === 'header') {
        return (
            <AppShell variant="header">
                <AppHeader />
                <main className="flex-1">{children}</main>
            </AppShell>
        );
    }

    return (
        <AppShell variant="sidebar">
            <AppSidebar />
            <AppContent variant="sidebar">
                {children}
            </AppContent>
        </AppShell>
    );
}