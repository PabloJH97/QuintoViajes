import { Link } from '@inertiajs/react';

interface HeroProps {
    auth: {
        user: any;
    };
}

export default function Hero({ auth }: HeroProps) {
    return (
        <section className="relative overflow-hidden py-20 md:py-32">
            <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div className="grid items-center gap-12 md:grid-cols-2">
                    <div className="text-center md:text-left">
                        <h1 className="mb-6 text-4xl font-bold tracking-tight md:text-5xl lg:text-6xl">
                            <span className="text-primary dark:text-primary-foreground">Quintoviajes</span>
                        </h1>
                        <p className="mb-8 text-lg text-gray-600 dark:text-gray-300">
                            Una plataforma completa para administrar múltiples vuelos,
                            comprar y gestionar sus billetes.
                        </p>
                        <div className="flex flex-col space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0 md:justify-start">
                            <Link
                                href={auth.user ? route('dashboard') : route('register')}
                                className="rounded-md bg-primary px-6 py-3 text-base font-medium text-primary-foreground shadow-sm transition-colors hover:bg-primary/90 dark:bg-primary dark:text-primary-foreground dark:hover:bg-primary/90"
                            >
                                {auth.user ? 'Ir al Dashboard' : 'Comenzar Ahora'}
                            </Link>
                            <a
                                href="#features"
                                className="rounded-md border border-gray-300 bg-white px-6 py-3 text-base font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
                            >
                                Conocer Más
                            </a>
                        </div>
                    </div>
                    <div className="relative mx-auto h-64 w-full max-w-md md:h-auto md:max-w-none lg:h-[450px]">
                        <div className="absolute left-1/2 top-1/2 h-[300px] w-[300px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-primary/20 blur-3xl dark:bg-primary/10"></div>
                        <div className="relative mx-auto grid h-full w-full max-w-[300px] grid-cols-2 gap-4 sm:max-w-[350px] md:max-w-[400px]">
                            <div className="flex flex-col gap-4">
                                <div className="h-32 rounded-lg bg-white p-4 shadow-lg dark:bg-gray-800">
                                    <svg className="mb-2 h-8 w-8 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" >
                                        <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                                    </svg>
                                    <p className="text-sm font-medium">Gestión de vuelos</p>
                                </div>
                                <div className="h-40 rounded-lg bg-white p-4 shadow-lg dark:bg-gray-800">
                                    <svg className="mb-2 h-8 w-8 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                    <p className="text-sm font-medium">Gestión de Usuarios</p>
                                </div>
                            </div>
                            <div className="flex flex-col gap-4 pt-8">
                                <div className="h-40 rounded-lg bg-white p-4 shadow-lg dark:bg-gray-800">
                                    <svg className="mb-2 h-8 w-8 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                        <rect width="18" height="18" x="3" y="3" rx="2" />
                                        <path d="M3 9h18" />
                                        <path d="M9 21V9" />
                                    </svg>
                                    <p className="text-sm font-medium">Múltiples Sucursales</p>
                                </div>
                                <div className="h-32 rounded-lg bg-white p-4 shadow-lg dark:bg-gray-800">
                                    <svg className="mb-2 h-8 w-8 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                        <path d="M17 6.1H3" />
                                        <path d="M21 12.1H3" />
                                        <path d="M15.1 18H3" />
                                    </svg>
                                    <p className="text-sm font-medium">Compra de billetes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
