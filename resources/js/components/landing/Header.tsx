import { Link } from '@inertiajs/react';

interface HeaderProps {
    auth: {
        user: any;
    };
}

export default function Header({ auth }: HeaderProps) {
    return (
        <header className="border-b border-gray-200 bg-white/80 backdrop-blur-sm dark:border-gray-700 dark:bg-gray-900/80">
            <div className="mx-auto flex max-w-7xl items-center justify-between p-4">
                <div className="flex items-center space-x-2">
                    <svg className="mb-2 h-8 w-8 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" >
                        <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                    </svg>
                    <span className="text-xl font-semibold">Quintoviajes 2025</span>
                </div>
                <nav className="flex items-center space-x-4">
                    {auth.user ? (
                        <Link
                            href={route('dashboard')}
                            className="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90 dark:bg-primary dark:text-primary-foreground dark:hover:bg-primary/90"
                        >
                            Dashboard
                        </Link>
                    ) : (
                        <>
                            <Link
                                href={route('login')}
                                className="text-sm font-medium text-gray-700 transition-colors hover:text-primary dark:text-gray-300 dark:hover:text-primary-foreground"
                            >
                                Iniciar Sesión
                            </Link>
                            <Link
                                href={route('register')}
                                className="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90 dark:bg-primary dark:text-primary-foreground dark:hover:bg-primary/90"
                            >
                                Registrarse
                            </Link>
                        </>
                    )}
                </nav>
            </div>
        </header>
    );
}
