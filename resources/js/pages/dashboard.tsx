import { DashboardCard } from '@/components/dashboard/DashboardCard';
import { Users, User, SquareMenu, Circle, LibraryBig, Book, Barcode, Archive, Plane, TicketsPlane, Ticket } from 'lucide-react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import CardFlip from "@/components/ui/card-flip";
import { Icon } from '@/components/icon';
import { useTranslations } from '@/hooks/use-translations';
interface PageProps {
    auth: {
        user: any;
        permissions: string[];
    };
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const { t } = useTranslations();
    const page = usePage<{ props: PageProps }>();
    const auth = page.props.auth;
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="grid gap-4 p-4 md:grid-cols-2 lg:grid-cols-3">
            {auth.permissions.includes('users.view')&&
                <DashboardCard
                    title={t('ui.users.title')}
                    description={t('ui.users.description')}
                    href="/users"
                    icon={Users}
                />
            }
            {auth.permissions.includes('reports.view')&&
                <DashboardCard
                    title={t('ui.planes.title')}
                    description={t('ui.planes.description')}
                    href="/planes"
                    icon={Plane}
                />
            }
                <DashboardCard
                    title={t('ui.flights.title')}
                    description={t('ui.flights.description')}
                    href="/flights"
                    icon={TicketsPlane}
                />
                <DashboardCard
                    title={t('ui.tickets.title')}
                    description={t('ui.tickets.description')}
                    href="/tickets"
                    icon={Ticket}
                />

            </div>
        </AppLayout>
    );
}
