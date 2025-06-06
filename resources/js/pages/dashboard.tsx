import { DashboardCard } from '@/components/dashboard/DashboardCard';
import { Users, User, SquareMenu, Circle, LibraryBig, Book, Barcode, Archive } from 'lucide-react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import CardFlip from "@/components/ui/card-flip";
import { Icon } from '@/components/icon';
import { useTranslations } from '@/hooks/use-translations';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const { t } = useTranslations();
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="grid gap-4 p-4 md:grid-cols-2 lg:grid-cols-3">
                <DashboardCard
                    title={t('ui.users.title')}
                    description={t('ui.users.description')}
                    href="/users"
                    icon={Users}
                />

                <DashboardCard
                    title={t('ui.floors.title')}
                    description={t('ui.floors.description')}
                    href="/floors"
                    icon={SquareMenu}
                />
                <DashboardCard
                    title={t('ui.zones.title')}
                    description={t('ui.zones.description')}
                    href="/zones"
                    icon={Circle}
                />
                <DashboardCard
                    title={t('ui.bookshelves.title')}
                    description={t('ui.bookshelves.description')}
                    href="/bookshelves"
                    icon={LibraryBig}
                />
                <DashboardCard
                    title={t('ui.books.title')}
                    description={t('ui.books.description')}
                    href="/books"
                    icon={Book}
                />
                <DashboardCard
                    title={t('ui.loans.title')}
                    description={t('ui.loans.description')}
                    href="/loans"
                    icon={Barcode}
                />
                <DashboardCard
                    title={t('ui.reservations.title')}
                    description={t('ui.reservations.description')}
                    href="/reservations"
                    icon={Archive}
                />


                <CardFlip
                    contentFront={
                        <div className="flex items-center gap-4">
                            <div className="rounded-lg bg-primary/10 p-2">
                                <Icon iconNode={User} className="h-6 w-6 text-primary" />
                            </div>
                            <div>
                                <h3 className="font-semibold">Usuario 1</h3>
                                <p className="text-sm text-muted-foreground">descripcion de usuario</p>
                            </div>
                        </div>
                    }
                    contentBack={
                        <div className="flex w-full h-full items-center gap-4">
                            <div className="rounded-lg bg-primary/10 p-2">
                                <Icon iconNode={User} className="h-6 w-6 text-primary" />
                            </div>
                            <div>
                                <h3 className="font-semibold">cliente 2</h3>
                                <p className="text-sm text-muted-foreground">descripcion de cliente</p>

                            </div>
                        </div>
                    }
                />

            </div>
        </AppLayout>
    );
}
