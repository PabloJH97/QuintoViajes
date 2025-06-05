import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useTranslations } from '@/hooks/use-translations';
import { router, usePage } from '@inertiajs/react';
import type { AnyFieldApi } from '@tanstack/react-form';
import { useForm } from '@tanstack/react-form';
import { useQueryClient } from '@tanstack/react-query';
import { Save, SquareMenu, X } from 'lucide-react';
import { toast } from 'sonner';

interface TicketFormProps {
    initialData?: {
        id: string;
        user: string;
        flight: string;
        seats: string;
    };
    page?: string;
    perPage?: string;
    pageTitle?: string;
    user?: string;
    flight?: string;
    flightCode?: string | null;
}

interface PageProps {
    auth: {
        user: any;
        permissions: string[];
    };
}

// Field error display component
function FieldInfo({ field }: { field: AnyFieldApi }) {
    return (
        <>
            {field.state.meta.isTouched && field.state.meta.errors.length ? (
                <p className="text-destructive mt-1 text-sm">{field.state.meta.errors.join(', ')}</p>
            ) : null}
            {field.state.meta.isValidating ? <p className="text-muted-foreground mt-1 text-sm">Validating...</p> : null}
        </>
    );
}
export function TicketForm({ initialData, page, perPage, pageTitle, user, flight, flightCode }: TicketFormProps) {
    const { t } = useTranslations();
    const queryClient = useQueryClient();
    const pageAuth = usePage<{ props: PageProps }>();
    const auth = pageAuth.props.auth;
    // TanStack Form setup
    const form = useForm({
        defaultValues: {
            user: flightCode ? auth.user.email : user ?? '',
            flight: flight ?? flightCode ?? '',
            seats: initialData?.seats ?? '',
        },
        onSubmit: async ({ value }) => {
            const options = {
                onSuccess: () => {
                    queryClient.invalidateQueries({ queryKey: ['tickets'] });

                    // Construct URL with page parameters
                    let url = '/tickets';
                    if (page) {
                        url += `?page=${page}`;
                        if (perPage) {
                            url += `&per_page=${perPage}`;
                        }
                    }

                    router.visit(url);
                },
                onError: (errors: Record<string, string>) => {
                    if (Object.keys(errors).length === 0) {
                        toast.error(initialData ? t('messages.tickets.error.update') : t('messages.tickets.error.create'));
                    }
                },
            };

            // Submit with Inertia
            if (initialData) {
                router.put(`/tickets/${initialData.id}`, value, options);
            } else {
                router.post('/tickets', value, options);
            }
        },
    });

    // Form submission handler
    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        e.stopPropagation();
        form.handleSubmit();
    };

    function TicketFormData() {
        return (
            <CardContent className={'bg-background h-full'}>
                <div>
                    <form.Field
                        name="user"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.tickets.fields.user').toLowerCase() })
                                    : !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
                                      ? t('ui.validation.email', { attribute: t('ui.tickets.fields.user').toLowerCase(), size: '1' })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.tickets.fields.user')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={field.state.value}
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.tickets.placeholders.user')}
                                    disabled={form.state.isSubmitting || flightCode}
                                    required={false}
                                    autoComplete="off"
                                />
                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>
                <br />
                <div>
                    <form.Field
                        name="flight"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.tickets.fields.flight').toLowerCase() })
                                    : value.length != 4
                                      ? t('ui.validation.size.string', { attribute: t('ui.tickets.fields.flight').toLowerCase(), size: '4' })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.tickets.fields.flight')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={field.state.value}
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.tickets.placeholders.flight')}
                                    disabled={form.state.isSubmitting||flightCode}
                                    required={false}
                                    autoComplete="off"
                                />
                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>
                <br />
                <div>
                    <form.Field
                        name="seats"
                        // validators={{
                        //     onChangeAsync: async ({ value }) => {
                        //         await new Promise((resolve) => setTimeout(resolve, 500));
                        //         return !value
                        //             ? t('ui.validation.required', { attribute: t('ui.flights.fields.seats.name').toLowerCase() })
                        //             : value.length != 4
                        //               ? t('ui.validation.size.string', { attribute: t('ui.flights.fields.seats.name').toLowerCase(), size: '4' })
                        //               : undefined;
                        //     },
                        // }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.flights.fields.seats.name')}</Label>
                                </div>
                                <div className="flex flex-row">
                                    <div className="flex flex-row p-2">
                                        <Input
                                            id={field.name}
                                            name={field.name}
                                            value={'1st'}
                                            type="radio"
                                            onBlur={field.handleBlur}
                                            placeholder={t('ui.flights.placeholders.price')}
                                            disabled={form.state.isSubmitting}
                                            required={false}
                                            autoComplete="off"
                                            className="w-auto"
                                        />
                                        <Label>{t('ui.flights.fields.seats.1st')}</Label>
                                    </div>
                                    <div className="flex flex-row p-2">
                                        <Input
                                            id={field.name}
                                            name={field.name}
                                            value={'2nd'}
                                            type="radio"
                                            onBlur={field.handleBlur}
                                            placeholder={t('ui.flights.placeholders.price')}
                                            disabled={form.state.isSubmitting}
                                            required={false}
                                            autoComplete="off"
                                            className="w-auto"
                                        />
                                        <Label>{t('ui.flights.fields.seats.2nd')}</Label>
                                    </div>
                                    <div className="flex flex-row p-2">
                                        <Input
                                            id={field.name}
                                            name={field.name}
                                            value={'tourist'}
                                            type="radio"
                                            onBlur={field.handleBlur}
                                            placeholder={t('ui.flights.placeholders.price')}
                                            disabled={form.state.isSubmitting}
                                            required={false}
                                            autoComplete="off"
                                            className="w-auto"
                                        />
                                        <Label>{t('ui.flights.fields.seats.tourist')}</Label>
                                    </div>
                                </div>

                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>
            </CardContent>
        );
    }

    function TicketFormView() {
        return (
            <form onSubmit={handleSubmit} className="space-y-4" noValidate>
                {/* Name field */}
                <Card className="bg-background">
                    <CardHeader>
                        <div className="flex flex-row">
                            <SquareMenu color="#155dfc"></SquareMenu>
                            <h1 className="font-bold">{pageTitle}</h1>
                        </div>
                        <div>
                            <p className="font-sans text-sm font-bold text-gray-400">
                                {'Ingresa la información para crear un nuevo piso en el sistema'}
                            </p>
                        </div>
                    </CardHeader>

                    <div>
                        <TicketFormData></TicketFormData>
                    </div>

                    {/* Form buttons */}
                    <CardFooter className="justify-center">
                        <div className="flex w-full flex-row justify-between gap-4">
                            <Button
                                type="button"
                                variant="outline"
                                onClick={() => {
                                    let url = '/tickets';
                                    if (page) {
                                        url += `?page=${page}`;
                                        if (perPage) {
                                            url += `&per_page=${perPage}`;
                                        }
                                    }
                                    router.visit(url);
                                }}
                                disabled={form.state.isSubmitting}
                            >
                                <X></X>
                                {t('ui.tickets.buttons.cancel')}
                            </Button>

                            <form.Subscribe selector={(state) => [state.canSubmit, state.isSubmitting]}>
                                {([canSubmit, isSubmitting]) => (
                                    <Button type="submit" disabled={!canSubmit} className="bg-blue-400">
                                        <Save></Save>
                                        {isSubmitting
                                            ? t('ui.tickets.buttons.saving')
                                            : initialData
                                              ? t('ui.tickets.buttons.update')
                                              : t('ui.tickets.buttons.save')}
                                    </Button>
                                )}
                            </form.Subscribe>
                        </div>
                    </CardFooter>
                </Card>
            </form>
        );
    }

    return <TicketFormView></TicketFormView>;
}
